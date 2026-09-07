<?php

namespace Tests\Feature;

use App\Models\Coupon;
use App\Models\Theme;
use App\Models\User;
use App\Services\PaymentService;
use App\Services\ThemeOwnershipService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->member = User::factory()->create(['role' => 'member']);
    $this->theme = Theme::create([
        'name' => 'Royal Sapphire Wedding',
        'slug' => 'royal-sapphire-'.uniqid(),
        'category' => 'luxury',
        'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552',
        'view_path' => 'demo.rose-romance',
        'is_active' => true,
        'is_premium' => true,
        'price' => 149000.00,
    ]);
});

test('order detail page handles midtrans snap token generation using http client', function () {
    Config::set('services.midtrans.server_key', 'SB-Mid-server-test-12345');
    Config::set('services.midtrans.client_key', 'SB-Mid-client-test-12345');
    Config::set('services.midtrans.is_production', false);

    Http::fake([
        'https://app.sandbox.midtrans.com/snap/v1/transactions' => Http::response([
            'token' => 'mock-snap-token-xyz-98765',
            'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/mock-snap-token-xyz-98765',
        ], 201),
    ]);

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);

    $response = $this->actingAs($this->member)->get(route('orders.show', $order));

    $response->assertOk()
        ->assertSee('Detail Pembelian & Tagihan', false)
        ->assertSee('mock-snap-token-xyz-98765')
        ->assertSee('Bayar Sekarang via Midtrans')
        ->assertSee('https://app.sandbox.midtrans.com/snap/snap.js');

    $order->refresh();
    expect($order->snap_token)->toBe('mock-snap-token-xyz-98765');
});

test('applying and removing coupon resets snap_token for recalculation', function () {
    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);
    $order->update(['snap_token' => 'old-cached-token']);

    $coupon = Coupon::create([
        'code' => 'DISC20',
        'discount_type' => 'fixed',
        'discount_value' => 20000,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->member)->post(route('orders.coupon.apply', $order), [
        'code' => 'DISC20',
    ]);

    $response->assertRedirect();
    $order->refresh();
    expect($order->snap_token)->toBeNull()
        ->and((float) $order->discount)->toBe(20000.0)
        ->and((float) $order->total_amount)->toBe(129000.0);

    // Now set token again, and test remove coupon resets it
    $order->update(['snap_token' => 'discounted-cached-token']);

    $removeResponse = $this->actingAs($this->member)->delete(route('orders.coupon.remove', $order));
    $removeResponse->assertRedirect();

    $order->refresh();
    expect($order->snap_token)->toBeNull()
        ->and((float) $order->discount)->toBe(0.0)
        ->and((float) $order->total_amount)->toBe(149000.0);
});

test('midtrans webhook with valid signature activates order and unlocks theme', function () {
    $serverKey = 'SB-Mid-server-secret-key-xyz';
    Config::set('services.midtrans.server_key', $serverKey);
    Config::set('services.midtrans.client_key', 'SB-Mid-client-xyz');

    $paymentService = app(PaymentService::class);
    $ownershipService = app(ThemeOwnershipService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);

    $statusCode = '200';
    $grossAmount = number_format((float) $order->amount, 2, '.', '');
    $signature = hash('sha512', $order->order_code.$statusCode.$grossAmount.$serverKey);

    $payload = [
        'order_id' => $order->order_code,
        'status_code' => $statusCode,
        'gross_amount' => $grossAmount,
        'signature_key' => $signature,
        'transaction_status' => 'settlement',
        'transaction_id' => 'MIDTRANS-TRX-101010',
        'payment_type' => 'gopay',
    ];

    $response = $this->postJson(route('payment.webhook'), $payload);

    $response->assertOk()
        ->assertJson(['status' => 'success']);

    $order->refresh();
    expect($order->isPaid())->toBeTrue()
        ->and($ownershipService->canUseTheme($this->member, $this->theme))->toBeTrue();
});

test('midtrans webhook with invalid signature is rejected', function () {
    $serverKey = 'SB-Mid-server-secret-key-xyz';
    Config::set('services.midtrans.server_key', $serverKey);
    Config::set('services.midtrans.client_key', 'SB-Mid-client-xyz');

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);

    $payload = [
        'order_id' => $order->order_code,
        'status_code' => '200',
        'gross_amount' => '149000.00',
        'signature_key' => 'totally-wrong-signature',
        'transaction_status' => 'settlement',
    ];

    $response = $this->postJson(route('payment.webhook'), $payload);

    $response->assertStatus(403)
        ->assertJson(['status' => 'error', 'message' => 'Invalid signature key']);

    $order->refresh();
    expect($order->isPaid())->toBeFalse();
});

test('midtrans webhook with expired status marks order as failed', function () {
    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);

    $payload = [
        'order_id' => $order->order_code,
        'transaction_status' => 'expire',
    ];

    $response = $this->postJson(route('payment.webhook'), $payload);

    $response->assertOk()
        ->assertJson(['status' => 'success', 'message' => 'Order marked as failed']);

    $order->refresh();
    expect($order->status)->toBe('failed')
        ->and($order->payment_status)->toBe('failed');
});

test('midtrans webhook with pending status records pending payment and metadata', function () {
    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);

    $payload = [
        'order_id' => $order->order_code,
        'transaction_status' => 'pending',
        'transaction_id' => 'PND-MIDTRANS-445566',
        'payment_type' => 'bank_transfer',
        'va_numbers' => [
            ['bank' => 'bca', 'va_number' => '12345678901'],
        ],
    ];

    $response = $this->postJson(route('payment.webhook'), $payload);

    $response->assertOk()
        ->assertJson(['status' => 'success', 'message' => 'Pending payment recorded']);

    $order->refresh();
    expect($order->isPaid())->toBeFalse()
        ->and($order->payment_method)->toBe('bank_transfer')
        ->and($order->metadata)->toHaveKey('midtrans_pending')
        ->and($order->payments()->where('status', 'pending')->exists())->toBeTrue();
});

test('order route uses uuid instead of numeric id', function () {
    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($this->member, $this->theme);

    expect($order->uuid)->not->toBeNull()
        ->and(strlen($order->uuid))->toBe(36);

    $url = route('orders.show', $order);
    expect($url)->toContain('/orders/'.$order->uuid)
        ->and($url)->not->toContain('/orders/'.$order->id);

    // Can access via UUID
    $this->actingAs($this->member)
        ->get('/orders/'.$order->uuid)
        ->assertOk();

    // Backward-compatible access via numeric ID also resolves
    $this->actingAs($this->member)
        ->get('/orders/'.$order->id)
        ->assertOk();
});

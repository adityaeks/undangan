<?php

use App\Models\Setting;
use App\Models\Theme;
use App\Models\User;
use App\Services\PaymentService;
use Database\Seeders\ThemeSeeder;

beforeEach(function () {
    (new ThemeSeeder)->run();
    Setting::set('support_whatsapp_number', '081234567890');
});

test('member with paid assisted order views dedicated success page with whatsapp button', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'assisted');

    // Simulate payment
    $paymentService->processSuccessfulPayment($order, 'TRX-TEST-ASSISTED', 'midtrans');

    $response = $this->actingAs($member)->get(route('orders.success', $order));

    $response->assertOk()
        ->assertSee('Transaksi Berhasil & Akses Aktif!', false)
        ->assertSee('Layanan Diisikan Oleh Tim Kami', false)
        ->assertSee('Kirim Data via WhatsApp Admin', false)
        ->assertSee('https://wa.me/6281234567890', false)
        ->assertSee($order->order_code);
});

test('member with paid self-service order views dedicated success page with create invitation button', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, 'lifetime', 'self_service');

    // Simulate payment
    $paymentService->processSuccessfulPayment($order, 'TRX-TEST-SELF', 'midtrans');

    $response = $this->actingAs($member)->get(route('orders.success', $order));

    $response->assertOk()
        ->assertSee('Transaksi Berhasil & Akses Aktif!', false)
        ->assertSee('Template Siap Digunakan!', false)
        ->assertSee('Gunakan Template & Buat Undangan', false)
        ->assertDontSee('Kirim Data via WhatsApp Admin', false);
});

test('cart checkout page does not have send file to whatsapp button', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'assisted');

    $response = $this->actingAs($member)->get(route('orders.show', $order));

    $response->assertOk()
        ->assertSee('Layanan Diisikan Oleh Tim Kami', false)
        ->assertDontSee('Kirim Data via WhatsApp', false);
});

test('unpaid order is redirected from success page to checkout page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'self_service');

    $response = $this->actingAs($member)->get(route('orders.success', $order));

    $response->assertRedirect(route('orders.show', $order));
});

test('simulate payment redirects to dedicated success page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'assisted');

    $response = $this->actingAs($member)->post(route('orders.simulate', $order));

    $response->assertRedirect(route('orders.success', $order));
    expect($order->fresh()->isPaid())->toBeTrue();
});

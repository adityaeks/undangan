<?php

use App\Models\Coupon;
use App\Models\Theme;
use App\Models\User;
use App\Services\PaymentService;

beforeEach(function () {
    $this->user = User::factory()->create(['role' => 'member']);
    $this->theme = Theme::create([
        'name' => 'The Warm Minimalist',
        'slug' => 'warm-minimalist-'.uniqid(),
        'category' => 'minimalist',
        'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800',
        'view_path' => 'demo.minimalist',
        'price' => 50000,
        'is_active' => true,
        'is_premium' => true,
    ]);

    $paymentService = app(PaymentService::class);
    $this->order = $paymentService->createOrderForTheme($this->user, $this->theme);
});

test('member can apply percentage coupon successfully', function () {
    $coupon = Coupon::create([
        'code' => 'MOMENINDAH',
        'discount_type' => 'percent',
        'discount_value' => 30.00,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('orders.coupon.apply', $this->order), [
            'code' => 'momenindah', // test case-insensitivity
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->order->refresh();
    expect($this->order->coupon_id)->toBe($coupon->id)
        ->and((float) $this->order->discount)->toBe(15000.0)
        ->and((float) $this->order->total_amount)->toBe(35000.0);
});

test('member can apply fixed discount coupon successfully', function () {
    $coupon = Coupon::create([
        'code' => 'HEMAT20K',
        'discount_type' => 'fixed',
        'discount_value' => 20000.00,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('orders.coupon.apply', $this->order), [
            'code' => 'HEMAT20K',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->order->refresh();
    expect($this->order->coupon_id)->toBe($coupon->id)
        ->and((float) $this->order->discount)->toBe(20000.0)
        ->and((float) $this->order->total_amount)->toBe(30000.0);
});

test('rejects non-existent coupon', function () {
    $response = $this->actingAs($this->user)
        ->post(route('orders.coupon.apply', $this->order), [
            'code' => 'KODEPALSU',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('error');

    $this->order->refresh();
    expect($this->order->coupon_id)->toBeNull()
        ->and((float) $this->order->discount)->toBe(0.0);
});

test('rejects inactive or expired coupon', function () {
    $inactive = Coupon::create([
        'code' => 'NONAKTIF',
        'discount_type' => 'percent',
        'discount_value' => 10,
        'is_active' => false,
    ]);

    $expired = Coupon::create([
        'code' => 'KEDALUWARSA',
        'discount_type' => 'percent',
        'discount_value' => 10,
        'is_active' => true,
        'expires_at' => now()->subDay(),
    ]);

    $response1 = $this->actingAs($this->user)->post(route('orders.coupon.apply', $this->order), ['code' => 'NONAKTIF']);
    $response1->assertSessionHas('error');

    $response2 = $this->actingAs($this->user)->post(route('orders.coupon.apply', $this->order), ['code' => 'KEDALUWARSA']);
    $response2->assertSessionHas('error');
});

test('rejects coupon if min spend not met', function () {
    Coupon::create([
        'code' => 'MIN100K',
        'discount_type' => 'fixed',
        'discount_value' => 10000,
        'min_spend' => 100000,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('orders.coupon.apply', $this->order), [
            'code' => 'MIN100K',
        ]);

    $response->assertSessionHas('error');
});

test('member can remove applied coupon', function () {
    $coupon = Coupon::create([
        'code' => 'DISKON50',
        'discount_type' => 'percent',
        'discount_value' => 50.00,
        'is_active' => true,
    ]);

    $this->order->update([
        'coupon_id' => $coupon->id,
        'discount' => 25000,
        'total_amount' => 25000,
    ]);

    $response = $this->actingAs($this->user)
        ->delete(route('orders.coupon.remove', $this->order));

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->order->refresh();
    expect($this->order->coupon_id)->toBeNull()
        ->and((float) $this->order->discount)->toBe(0.0)
        ->and((float) $this->order->total_amount)->toBe(50000.0);
});

test('cannot apply coupon to paid order', function () {
    Coupon::create([
        'code' => 'MOMENINDAH',
        'discount_type' => 'percent',
        'discount_value' => 30.00,
        'is_active' => true,
    ]);

    $this->order->update(['status' => 'paid', 'payment_status' => 'paid']);

    $response = $this->actingAs($this->user)
        ->post(route('orders.coupon.apply', $this->order), [
            'code' => 'MOMENINDAH',
        ]);

    $response->assertSessionHas('error');
});

test('coupon used count increments on payment completion', function () {
    $coupon = Coupon::create([
        'code' => 'MOMENINDAH',
        'discount_type' => 'percent',
        'discount_value' => 30.00,
        'is_active' => true,
        'used_count' => 0,
    ]);

    $this->actingAs($this->user)->post(route('orders.coupon.apply', $this->order), ['code' => 'MOMENINDAH']);

    $paymentService = app(PaymentService::class);
    $this->order->refresh();
    $paymentService->processSuccessfulPayment($this->order, 'PAY-TEST-123', 'simulation');

    $coupon->refresh();
    expect($coupon->used_count)->toBe(1);
});

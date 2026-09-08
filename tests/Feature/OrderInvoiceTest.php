<?php

use App\Models\Theme;
use App\Models\User;
use App\Services\PaymentService;
use Database\Seeders\ThemeSeeder;

beforeEach(function () {
    (new ThemeSeeder)->run();
});

test('member with paid order views professional invoice card in dashboard view', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, 'lifetime', 'assisted');
    $paymentService->processSuccessfulPayment($order, 'TRX-INV-TEST', 'midtrans');

    $response = $this->actingAs($member)->get(route('orders.show', ['order' => $order, 'from' => 'dashboard']));

    $response->assertOk()
        ->assertSee('Invoice Pembayaran')
        ->assertSee('Download / Cetak Invoice')
        ->assertSee('INVOICE')
        ->assertSee('#INV-'.$order->order_code)
        ->assertSee('Ditagihkan Kepada (Billed To):')
        ->assertSee($member->name)
        ->assertSee($member->email)
        ->assertSee('PAID / LUNAS')
        ->assertSee('Template: '.$theme->name)
        ->assertSee('Masa Lisensi: Lifetime (Selamanya)')
        ->assertDontSee('Template: '.$theme->name.' (Lifetime (Selamanya))')
        ->assertSee('Layanan Diisikan Oleh Tim Kami');
});

test('member with paid order can access standalone printable invoice page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'self_service');
    $paymentService->processSuccessfulPayment($order, 'TRX-PRINT-TEST', 'midtrans');

    $response = $this->actingAs($member)->get(route('orders.invoice', ['order' => $order, 'print' => 1]));

    $response->assertOk()
        ->assertSee('Download / Cetak PDF')
        ->assertSee('INVOICE')
        ->assertSee('#INV-'.$order->order_code)
        ->assertSee($theme->name)
        ->assertSee($member->name);
});

test('unauthorized user cannot access another members invoice', function () {
    $member1 = User::factory()->create(['role' => 'member']);
    $member2 = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member1, $theme, '45_days', 'self_service');
    $paymentService->processSuccessfulPayment($order, 'TRX-AUTH-TEST', 'midtrans');

    $response = $this->actingAs($member2)->get(route('orders.invoice', $order));

    $response->assertForbidden();
});

test('super admin can access and download any members invoice', function () {
    $member = User::factory()->create(['role' => 'member']);
    $admin = User::factory()->create(['role' => 'super_admin']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'self_service');
    $paymentService->processSuccessfulPayment($order, 'TRX-ADMIN-TEST', 'midtrans');

    $response = $this->actingAs($admin)->get(route('orders.invoice', $order));

    $response->assertOk()
        ->assertSee('#INV-'.$order->order_code);
});

test('legacy order items with duration in raw name render clean theme title and license duration', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, 'lifetime', 'self_service');
    $paymentService->processSuccessfulPayment($order, 'TRX-LEGACY-TEST', 'midtrans');

    // Manually force legacy item_name in database
    $themeItem = $order->items()->where('item_type', 'theme')->first();
    DB::table('order_items')->where('id', $themeItem->id)->update([
        'item_name' => 'Template: '.$theme->name.' (Lifetime (Selamanya))',
    ]);

    $response = $this->actingAs($member)->get(route('orders.show', ['order' => $order, 'from' => 'dashboard']));

    $response->assertOk()
        ->assertSee('Template: '.$theme->name)
        ->assertSee('Masa Lisensi: Lifetime (Selamanya)')
        ->assertDontSee('Template: '.$theme->name.' (Lifetime (Selamanya))');
});

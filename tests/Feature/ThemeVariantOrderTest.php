<?php

use App\Models\Order;
use App\Models\Setting;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;
use App\Services\PaymentService;
use App\Services\ThemeOwnershipService;
use Database\Seeders\ThemeSeeder;

beforeEach(function () {
    (new ThemeSeeder)->run();
});

test('theme catalog array includes variant prices and assisted fee', function () {
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();
    expect($theme)->not->toBeNull();

    $catalogArray = $theme->toCatalogArray();

    expect($catalogArray)->toHaveKeys([
        'price_45_days',
        'raw_price_45_days',
        'price_lifetime',
        'raw_price_lifetime',
        'assisted_fee',
        'raw_assisted_fee',
    ]);

    expect($catalogArray['raw_price_45_days'])->toBe(49000.0)
        ->and($catalogArray['raw_price_lifetime'])->toBe(99000.0)
        ->and($catalogArray['raw_assisted_fee'])->toBe(25000.0);
});

test('member can checkout theme with 45 days duration and self service', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $response = $this->actingAs($member)->get(route('checkout.theme', [
        'theme' => $theme->id,
        'duration' => '45_days',
        'service_type' => 'self_service',
    ]));

    $order = Order::where('user_id', $member->id)->latest()->first();
    expect($order)->not->toBeNull();

    $response->assertRedirect(route('orders.show', $order));
    expect((float) $order->amount)->toBe(49000.0)
        ->and((float) $order->tax_amount)->toBe(5390.0)
        ->and((float) $order->total_amount)->toBe(54390.0)
        ->and($order->metadata['duration'])->toBe('45_days')
        ->and($order->metadata['service_type'])->toBe('self_service')
        ->and($order->items)->toHaveCount(1);
});

test('member can checkout theme with 45 days duration and assisted service', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $response = $this->actingAs($member)->get(route('checkout.theme', [
        'theme' => $theme->id,
        'duration' => '45_days',
        'service_type' => 'assisted',
    ]));

    $order = Order::where('user_id', $member->id)->latest()->first();
    expect($order)->not->toBeNull();

    $response->assertRedirect(route('orders.show', $order));
    // 49000 + 25000 = 74000, PPN 11% = 8140, total = 82140
    expect((float) $order->amount)->toBe(74000.0)
        ->and((float) $order->tax_amount)->toBe(8140.0)
        ->and((float) $order->total_amount)->toBe(82140.0)
        ->and($order->metadata['duration'])->toBe('45_days')
        ->and($order->metadata['service_type'])->toBe('assisted')
        ->and($order->items)->toHaveCount(2);

    $serviceItem = $order->items->where('item_type', 'service')->first();
    expect($serviceItem)->not->toBeNull()
        ->and((float) $serviceItem->price)->toBe(25000.0);
});

test('member can checkout theme with lifetime duration and assisted service', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $response = $this->actingAs($member)->get(route('checkout.theme', [
        'theme' => $theme->id,
        'duration' => 'lifetime',
        'service_type' => 'assisted',
    ]));

    $order = Order::where('user_id', $member->id)->latest()->first();
    expect($order)->not->toBeNull();

    $response->assertRedirect(route('orders.show', $order));
    // 99000 + 25000 = 124000, PPN 11% = 13640, total = 137640
    expect((float) $order->amount)->toBe(124000.0)
        ->and((float) $order->tax_amount)->toBe(13640.0)
        ->and((float) $order->total_amount)->toBe(137640.0)
        ->and($order->metadata['duration'])->toBe('lifetime')
        ->and($order->metadata['service_type'])->toBe('assisted');
});

test('admin can update global pricing settings for themes', function () {
    $admin = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($admin)->post(route('admin.themes.pricing-settings'), [
        'price_45_days' => 55000,
        'price_lifetime' => 115000,
        'assisted_fee' => 30000,
        'whatsapp_number' => '628999888777',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    expect((float) Setting::get('theme_price_45_days'))->toBe(55000.0)
        ->and((float) Setting::get('theme_price_lifetime'))->toBe(115000.0)
        ->and((float) Setting::get('theme_assisted_fee'))->toBe(30000.0)
        ->and(Setting::get('support_whatsapp_number'))->toBe('628999888777');
});

test('admin can update individual theme lifetime price override', function () {
    $admin = User::factory()->create(['role' => 'super_admin']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $response = $this->actingAs($admin)->patch(route('admin.themes.update-price', $theme), [
        'price' => 50000,
        'price_lifetime' => 120000,
        'is_premium' => true,
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    $theme->refresh();
    expect((float) $theme->price)->toBe(50000.0)
        ->and($theme->getLifetimePrice())->toBe(120000.0);
});

test('paying an order fulfills user_themes with expiration for 45 days', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme, '45_days', 'assisted');

    $paymentService->processSuccessfulPayment($order, 'PAY-TEST-123', 'simulation');

    $userTheme = UserTheme::where('user_id', $member->id)->where('theme_id', $theme->id)->first();
    expect($userTheme)->not->toBeNull()
        ->and($userTheme->duration_type)->toBe('45_days')
        ->and($userTheme->service_type)->toBe('assisted')
        ->and($userTheme->expires_at)->not->toBeNull()
        ->and($userTheme->isExpired())->toBeFalse();

    $ownershipService = app(ThemeOwnershipService::class);
    expect($ownershipService->canUseTheme($member, $theme))->toBeTrue();
});

test('expired theme cannot be used by member', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();

    UserTheme::create([
        'user_id' => $member->id,
        'theme_id' => $theme->id,
        'unlocked_at' => now()->subDays(50),
        'duration_type' => '45_days',
        'expires_at' => now()->subDays(5),
        'service_type' => 'self_service',
        'is_active' => true,
    ]);

    $ownershipService = app(ThemeOwnershipService::class);
    expect($ownershipService->canUseTheme($member, $theme))->toBeFalse();
});

test('super admin can render admin themes index page with variant pricing panel and themes', function () {
    $admin = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($admin)->get(route('themes.index'));

    $response->assertOk()
        ->assertSee('Pengaturan Varian Paket')
        ->assertSee('Harga Paket 45 Hari')
        ->assertSee('Harga Paket Lifetime')
        ->assertSee('Fee Jasa Diisikan Tim')
        ->assertSee('Atur Harga');
});

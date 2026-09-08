<?php

use App\Models\Order;
use App\Models\PartnerClient;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;
use App\Services\InvitationService;
use App\Services\PaymentService;
use App\Services\ThemeOwnershipService;
use Illuminate\Auth\Access\AuthorizationException;

test('super admin, partner, and member see role-appropriate dashboard', function () {
    $superAdmin = User::factory()->create(['role' => 'super_admin']);
    $partner = User::factory()->create(['role' => 'partner']);
    $member = User::factory()->create(['role' => 'member']);

    $this->actingAs($superAdmin)->get('/dashboard')
        ->assertOk()
        ->assertSee('Super Admin Dashboard');

    $this->actingAs($partner)->get('/dashboard')
        ->assertOk()
        ->assertSee('Dashboard Partner');

    $this->actingAs($member)->get('/dashboard')
        ->assertOk()
        ->assertSee('Portal Pengantin');
});

test('check role middleware restricts unauthorized role access', function () {
    $member = User::factory()->create(['role' => 'member']);
    $partner = User::factory()->create(['role' => 'partner']);

    // Member cannot access partner dashboard
    $this->actingAs($member)->get('/partner/dashboard')
        ->assertForbidden();

    // Partner can access partner dashboard
    $this->actingAs($partner)->get('/partner/dashboard')
        ->assertOk();
});

test('free themes are accessible but premium themes require ownership', function () {
    $user = User::factory()->create(['role' => 'member']);
    $ownershipService = app(ThemeOwnershipService::class);

    $freeTheme = Theme::create([
        'name' => 'Free Minimalist',
        'slug' => 'free-minimalist-test',
        'view_path' => 'demo.index',
        'price' => 0.00,
        'is_premium' => false,
        'is_active' => true,
    ]);

    $premiumTheme = Theme::create([
        'name' => 'Luxury Royal Gold',
        'slug' => 'luxury-royal-gold-test',
        'view_path' => 'demo.index',
        'price' => 99000.00,
        'is_premium' => true,
        'is_active' => true,
    ]);

    // Free theme should be permitted immediately
    expect($ownershipService->canUseTheme($user, $freeTheme))->toBeTrue();

    // Premium theme should be denied before purchase
    expect($ownershipService->canUseTheme($user, $premiumTheme))->toBeFalse();

    // Unlock theme
    $ownershipService->unlockThemeForUser($user, $premiumTheme);

    // After unlock, it should be permitted
    expect($ownershipService->canUseTheme($user, $premiumTheme))->toBeTrue();

    // When admin deactivates user theme, access is revoked
    UserTheme::where('user_id', $user->id)->where('theme_id', $premiumTheme->id)->update(['is_active' => false]);
    expect($ownershipService->canUseTheme($user, $premiumTheme))->toBeFalse();
    expect($ownershipService->getUserOwnedThemeIds($user))->not->toContain($premiumTheme->id);
});

test('purchasing premium theme and processing payment unlocks theme idempotently', function () {
    $user = User::factory()->create(['role' => 'member']);
    $paymentService = app(PaymentService::class);
    $ownershipService = app(ThemeOwnershipService::class);

    $premiumTheme = Theme::create([
        'name' => 'Premium Vintage Elegance',
        'slug' => 'premium-vintage-test',
        'view_path' => 'demo.index',
        'price' => 75000.00,
        'is_premium' => true,
        'is_active' => true,
    ]);

    // 1. Create order
    $order = $paymentService->createOrderForTheme($user, $premiumTheme);
    expect($order->isPaid())->toBeFalse();
    expect((float) $order->amount)->toBe(75000.00);
    expect((float) $order->tax_amount)->toBe(8250.00);
    expect((float) $order->total_amount)->toBe(83250.00);

    // 2. Process successful payment
    $payment = $paymentService->processSuccessfulPayment(
        $order,
        'PAY-TEST-001',
        'midtrans',
        ['status' => 'settlement']
    );

    $order->refresh();
    expect($order->isPaid())->toBeTrue();
    expect($ownershipService->canUseTheme($user, $premiumTheme))->toBeTrue();

    // 3. Process second time (idempotency check)
    $paymentSecond = $paymentService->processSuccessfulPayment(
        $order,
        'PAY-TEST-001',
        'midtrans'
    );

    expect(UserTheme::where('user_id', $user->id)->where('theme_id', $premiumTheme->id)->count())->toBe(1);
});

test('payment webhook processes settlement idempotently', function () {
    $user = User::factory()->create(['role' => 'member']);
    $paymentService = app(PaymentService::class);

    $theme = Theme::create([
        'name' => 'Webhook Test Theme',
        'slug' => 'webhook-test-theme',
        'view_path' => 'demo.index',
        'price' => 50000.00,
        'is_premium' => true,
        'is_active' => true,
    ]);

    $order = $paymentService->createOrderForTheme($user, $theme);

    $webhookPayload = [
        'order_id' => $order->order_code,
        'transaction_status' => 'settlement',
        'transaction_id' => 'TRX-MIDTRANS-998877',
        'payment_type' => 'qris',
    ];

    // First webhook call
    $response = $this->postJson(route('payment.webhook'), $webhookPayload);
    $response->assertOk()
        ->assertJson(['status' => 'success']);

    $order->refresh();
    expect($order->isPaid())->toBeTrue();

    // Second webhook call (idempotent replay)
    $responseReplay = $this->postJson(route('payment.webhook'), $webhookPayload);
    $responseReplay->assertOk()
        ->assertJson(['status' => 'success', 'message' => 'Order was already processed']);
});

test('invitation service creates aggregate with settings and couples', function () {
    $user = User::factory()->create(['role' => 'member']);
    $invitationService = app(InvitationService::class);

    $theme = Theme::create([
        'name' => 'Modular Base Theme',
        'slug' => 'modular-base-theme',
        'view_path' => 'demo.index',
        'price' => 0.00,
        'is_premium' => false,
        'is_active' => true,
    ]);

    $invitation = $invitationService->createInvitation($user, [
        'theme_id' => $theme->id,
        'title' => 'The Wedding of Kevin & Vania',
        'slug' => 'kevin-vania',
        'groom_name' => 'Kevin Sanjaya',
        'bride_name' => 'Valencia Tanoesoedibjo',
    ]);

    expect($invitation->id)->not->toBeNull();
    expect($invitation->owner_id)->toBe($user->id);
    expect($invitation->setting)->not->toBeNull();
    expect($invitation->couples()->count())->toBe(2);

    // Test publishing
    $invitationService->publishInvitation($invitation);
    $invitation->refresh();
    expect($invitation->is_published)->toBeTrue();
    expect($invitation->status)->toBe('published');
});

test('invitation service rejects creating invitation for unowned premium theme', function () {
    $user = User::factory()->create(['role' => 'member']);
    $invitationService = app(InvitationService::class);

    $premiumTheme = Theme::create([
        'name' => 'Unowned Premium Theme',
        'slug' => 'unowned-premium-theme',
        'view_path' => 'demo.index',
        'price' => 150000.00,
        'is_premium' => true,
        'is_active' => true,
    ]);

    $this->expectException(AuthorizationException::class);

    $invitationService->createInvitation($user, [
        'theme_id' => $premiumTheme->id,
        'title' => 'Attempted Wedding',
    ]);
});

test('partner can manage clients and create client invitations', function () {
    $partner = User::factory()->create(['role' => 'partner']);

    // Partner creates client via HTTP
    $clientResponse = $this->actingAs($partner)->post(route('partner.clients.store'), [
        'name' => 'Klien Andi & Bunga',
        'phone' => '08123456789',
        'email' => 'andi@example.com',
        'notes' => 'Resepsi adat Minang',
    ]);

    $clientResponse->assertRedirect();
    $client = PartnerClient::where('name', 'Klien Andi & Bunga')->first();
    expect($client)->not->toBeNull();
    expect($client->partner_id)->toBe($partner->id);

    // Partner creates invitation for client
    $theme = Theme::first() ?? Theme::create([
        'name' => 'Partner Test Theme',
        'slug' => 'partner-test-theme',
        'view_path' => 'demo.index',
        'price' => 0.00,
        'is_premium' => false,
        'is_active' => true,
    ]);
    $invitationResponse = $this->actingAs($partner)->post(route('partner.invitations.store'), [
        'client_id' => $client->id,
        'theme_id' => $theme->id,
        'title' => 'The Wedding of Andi & Bunga',
        'slug' => 'andi-bunga',
        'groom_name' => 'Andi',
        'bride_name' => 'Bunga',
    ]);

    $invitationResponse->assertRedirect(route('partner.invitations.index'));

    $this->assertDatabaseHas('invitations', [
        'slug' => 'andi-bunga',
        'partner_id' => $partner->id,
        'client_id' => $client->id,
    ]);
});

test('paid theme is displayed on member dashboard under owned themes section', function () {
    $user = User::factory()->create(['role' => 'member']);
    $paymentService = app(PaymentService::class);

    $theme = Theme::create([
        'name' => 'The Vogue Royal Edition',
        'slug' => 'the-vogue-royal-edition',
        'view_path' => 'demo.editorial',
        'price' => 49000.00,
        'is_premium' => true,
        'is_active' => true,
    ]);

    // Before payment: dashboard shows empty state for owned themes
    $this->actingAs($user)->get('/dashboard')
        ->assertOk()
        ->assertSee('Tema yang Telah Anda Miliki')
        ->assertSee('Belum Ada Tema yang Dibeli');

    // Create order and pay
    $order = $paymentService->createOrderForTheme($user, $theme);
    $paymentService->processSuccessfulPayment($order, 'PAY-SIM-123', 'qris');
    $user->unsetRelation('themes');

    // After payment: dashboard shows the paid theme
    $this->actingAs($user)->get('/dashboard')
        ->assertOk()
        ->assertSee('Tema yang Telah Anda Miliki')
        ->assertSee('The Vogue Royal Edition')
        ->assertSee('Lunas');
});

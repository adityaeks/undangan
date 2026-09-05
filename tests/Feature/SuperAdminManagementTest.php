<?php

use App\Models\Coupon;
use App\Models\Invitation;
use App\Models\Order;
use App\Models\Theme;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'super_admin']);
    $this->member = User::factory()->create(['role' => 'member']);
});

test('super admin can access dashboard with platform governance data', function () {
    $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

    $response->assertOk()
        ->assertSee('Super Admin Dashboard')
        ->assertSee('Kelola Pengguna')
        ->assertSee('Kupon & Diskon Promo', false)
        ->assertDontSee('Tambah Data Tamu');
});

test('super admin can list and search users', function () {
    $response = $this->actingAs($this->admin)->get(route('admin.users.index'));

    $response->assertOk()
        ->assertSee('Kelola Pengguna Platform')
        ->assertSee($this->admin->name)
        ->assertSee($this->member->name);
});

test('super admin can toggle user status between active and suspended', function () {
    expect($this->member->status)->toBe('active');

    $response = $this->actingAs($this->admin)
        ->patch(route('admin.users.toggle-status', $this->member));

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->member->refresh();
    expect($this->member->status)->toBe('suspended');

    // Toggle back
    $this->actingAs($this->admin)
        ->patch(route('admin.users.toggle-status', $this->member));
    $this->member->refresh();
    expect($this->member->status)->toBe('active');
});

test('super admin cannot suspend own account', function () {
    $response = $this->actingAs($this->admin)
        ->patch(route('admin.users.toggle-status', $this->admin));

    $response->assertSessionHas('error');
    $this->admin->refresh();
    expect($this->admin->status)->toBe('active');
});

test('super admin can update user role', function () {
    $response = $this->actingAs($this->admin)
        ->patch(route('admin.users.update-role', $this->member), [
            'role' => 'partner',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->member->refresh();
    expect($this->member->role)->toBe('partner');
});

test('super admin can create a new user with chosen role and status', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('admin.users.store'), [
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'password' => 'secret12345',
            'role' => 'partner',
            'status' => 'active',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'name' => 'Budi Santoso',
        'email' => 'budi.santoso@example.com',
        'role' => 'partner',
        'status' => 'active',
    ]);

    $newUser = User::where('email', 'budi.santoso@example.com')->first();
    expect(Hash::check('secret12345', $newUser->password))->toBeTrue()
        ->and($newUser->email_verified_at)->not->toBeNull();
});

test('super admin user creation validates email uniqueness and required fields', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('admin.users.store'), [
            'name' => '',
            'email' => $this->member->email, // duplicate email
            'password' => '123', // too short
            'role' => 'invalid_role',
        ]);

    $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);
});

test('super admin can manage coupons', function () {
    // List coupons
    $listResponse = $this->actingAs($this->admin)->get(route('admin.coupons.index'));
    $listResponse->assertOk()->assertSee('Kelola Kupon Promo');

    // Create coupon
    $storeResponse = $this->actingAs($this->admin)->post(route('admin.coupons.store'), [
        'code' => 'SUPERPROMO50',
        'discount_type' => 'percent',
        'discount_value' => 50,
        'min_spend' => 10000,
    ]);

    $storeResponse->assertRedirect();
    $storeResponse->assertSessionHas('success');

    $coupon = Coupon::where('code', 'SUPERPROMO50')->first();
    expect($coupon)->not->toBeNull()
        ->and((float) $coupon->discount_value)->toBe(50.0);

    // Toggle coupon active
    $this->actingAs($this->admin)->patch(route('admin.coupons.toggle', $coupon));
    $coupon->refresh();
    expect($coupon->is_active)->toBeFalse();

    // Delete coupon
    $this->actingAs($this->admin)->delete(route('admin.coupons.destroy', $coupon));
    expect(Coupon::where('code', 'SUPERPROMO50')->exists())->toBeFalse();
});

test('super admin can toggle invitation publish status for moderation', function () {
    $theme = Theme::first() ?? Theme::create([
        'name' => 'The Test Theme',
        'slug' => 'test-theme-'.uniqid(),
        'category' => 'minimalist',
        'thumbnail' => 'https://example.com/thumb.jpg',
        'view_path' => 'demo.minimalist',
        'price' => 50000,
        'is_active' => true,
    ]);

    $invitation = Invitation::create([
        'owner_id' => $this->member->id,
        'user_id' => $this->member->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Untuk Dimoderasi',
        'slug' => 'moderasi-test-'.uniqid(),
        'is_published' => true,
    ]);

    $response = $this->actingAs($this->admin)
        ->patch(route('admin.invitations.toggle', $invitation));

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $invitation->refresh();
    expect($invitation->is_published)->toBeFalse();
});

test('member cannot access super admin management routes', function () {
    $this->actingAs($this->member)->get(route('admin.users.index'))->assertForbidden();
    $this->actingAs($this->member)->get(route('admin.coupons.index'))->assertForbidden();
});

test('admin orders page displays coupon code and discounted total properly', function () {
    $coupon = Coupon::create([
        'code' => 'DISC30',
        'discount_type' => 'percent',
        'discount_value' => 30,
        'is_active' => true,
    ]);

    Order::create([
        'user_id' => $this->member->id,
        'coupon_id' => $coupon->id,
        'order_code' => 'ORD-TEST-CPN123',
        'package_type' => 'single_template',
        'amount' => 50000,
        'discount' => 15000,
        'total_amount' => 35000,
        'payment_status' => 'paid',
        'status' => 'paid',
    ]);

    $response = $this->actingAs($this->admin)->get(route('orders.index'));

    $response->assertOk()
        ->assertSee('ORD-TEST-CPN123')
        ->assertSee('DISC30')
        ->assertSee('35.000')
        ->assertSee('-Rp 15.000')
        ->assertSee('Omset: Rp 35.000');
});

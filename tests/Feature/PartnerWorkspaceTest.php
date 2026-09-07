<?php

use App\Models\Invitation;
use App\Models\Package;
use App\Models\Theme;
use App\Models\User;
use App\Services\PaymentService;

beforeEach(function () {
    $this->starterPackage = Package::firstOrCreate(
        ['slug' => 'partner-starter'],
        [
            'name' => 'Starter Partner',
            'target_role' => 'partner',
            'quota_invitations' => 10,
            'price' => 299000,
            'features' => ['10 Kuota Undangan', 'Akses Seluruh Katalog Tema'],
            'is_active' => true,
        ]
    );

    $this->proPackage = Package::firstOrCreate(
        ['slug' => 'partner-pro'],
        [
            'name' => 'Pro WO & Studio',
            'target_role' => 'partner',
            'quota_invitations' => 30,
            'price' => 599000,
            'features' => ['30 Kuota Undangan Aktif', '100% White-Label (Brand Anda)'],
            'is_active' => true,
        ]
    );

    $this->enterprisePackage = Package::firstOrCreate(
        ['slug' => 'partner-enterprise'],
        [
            'name' => 'Enterprise Partner',
            'target_role' => 'partner',
            'quota_invitations' => 100,
            'price' => 1499000,
            'features' => ['100+ Kuota Undangan', 'Dedicated Server'],
            'is_active' => true,
        ]
    );

    $this->partner = User::factory()->create(['role' => 'partner']);
    $this->member = User::factory()->create(['role' => 'member']);
    $this->admin = User::factory()->create(['role' => 'super_admin']);
    $this->theme = Theme::create([
        'name' => 'The Elegant Partner Theme',
        'slug' => 'partner-theme-'.uniqid(),
        'category' => 'modern',
        'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800',
        'view_path' => 'demo.rose-romance',
        'is_active' => true,
        'is_premium' => true,
        'is_for_partner' => true,
        'price' => 99000,
    ]);
});

test('partner can access dashboard with partner layout and navigation', function () {
    $response = $this->actingAs($this->partner)->get(route('partner.dashboard'));

    $response->assertOk()
        ->assertSee('Partner & WO Portal', false)
        ->assertSee('Kelola Klien WO')
        ->assertSee('Undangan Klien')
        ->assertDontSee('Kelola Pengguna')
        ->assertDontSee('Katalog & Harga Tema');
});

test('partner can access clients index with partner layout', function () {
    $response = $this->actingAs($this->partner)->get(route('partner.clients.index'));

    $response->assertOk()
        ->assertSee('Partner & WO Portal', false)
        ->assertSee('Kelola Klien WO');
});

test('member cannot access partner dashboard', function () {
    $response = $this->actingAs($this->member)->get(route('partner.dashboard'));

    $response->assertForbidden();
});

test('guest is redirected to login when accessing partner workspace', function () {
    $response = $this->get(route('partner.dashboard'));

    $response->assertRedirect(route('login'));
});

test('partner can access invitation creation and see super admin partner themes', function () {
    $response = $this->actingAs($this->partner)->get(route('partner.invitations.create'));

    $response->assertOk()
        ->assertSee('Buat Undangan Klien')
        ->assertSee($this->theme->name);
});

test('partner can create invitation directly using theme enabled for partners', function () {
    $response = $this->actingAs($this->partner)->post(route('partner.invitations.store'), [
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Partner Demo',
        'groom_name' => 'Dimas Pratama',
        'bride_name' => 'Siti Aisyah',
    ]);

    $response->assertRedirect(route('partner.invitations.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('invitations', [
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Partner Demo',
    ]);
});

test('super admin can toggle theme partner availability', function () {
    expect($this->theme->is_for_partner)->toBeTrue();

    $response = $this->actingAs($this->admin)
        ->patch(route('admin.themes.toggle-partner', $this->theme));

    $response->assertRedirect()
        ->assertSessionHas('success');

    $this->theme->refresh();
    expect($this->theme->is_for_partner)->toBeFalse();

    // Now partner cannot see this theme on create page
    $partnerResponse = $this->actingAs($this->partner)->get(route('partner.invitations.create'));
    $partnerResponse->assertDontSee($this->theme->name);
});

test('partner can access edit page and update their invitation', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Initial Title',
        'slug' => 'initial-title',
        'is_published' => false,
    ]);

    // Can see edit button on index
    $indexResponse = $this->actingAs($this->partner)->get(route('partner.invitations.index'));
    $indexResponse->assertOk()
        ->assertSee('Edit')
        ->assertSee(route('partner.invitations.edit', $invitation));

    // Can access edit page
    $editResponse = $this->actingAs($this->partner)->get(route('partner.invitations.edit', $invitation));
    $editResponse->assertOk()
        ->assertSee('Edit Undangan Klien')
        ->assertSee('Initial Title');

    // Can update invitation
    $updateResponse = $this->actingAs($this->partner)->put(route('partner.invitations.update', $invitation), [
        'theme_id' => $this->theme->id,
        'title' => 'Updated Wedding Title',
        'is_published' => '1',
        'groom_name' => 'Fikri Alamsyah',
        'bride_name' => 'Nadia Putri',
        'bank_1_name' => 'BCA',
        'bank_1_number' => '123456789',
        'bank_1_holder' => 'Fikri Alamsyah',
    ]);

    $updateResponse->assertRedirect(route('partner.invitations.index'))
        ->assertSessionHas('success');

    $invitation->refresh();
    expect($invitation->title)->toBe('Updated Wedding Title');
    expect($invitation->is_published)->toBeTrue();
    expect($invitation->couples()->where('role', 'groom')->first()?->full_name)->toBe('Fikri Alamsyah');
});

test('partner cannot edit another user invitation', function () {
    $otherPartner = User::factory()->create(['role' => 'partner']);
    $otherInvitation = Invitation::create([
        'user_id' => $otherPartner->id,
        'owner_id' => $otherPartner->id,
        'partner_id' => $otherPartner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Other Title',
        'slug' => 'other-title',
    ]);

    $response = $this->actingAs($this->partner)->get(route('partner.invitations.edit', $otherInvitation));
    $response->assertForbidden();
});

test('partner can delete their invitation', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'To Be Deleted',
        'slug' => 'to-be-deleted',
    ]);

    $response = $this->actingAs($this->partner)->delete(route('partner.invitations.destroy', $invitation));
    $response->assertRedirect(route('partner.invitations.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('invitations', [
        'id' => $invitation->id,
    ]);
});

test('partner can access guests index and manage guest recipient list', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Client A',
        'slug' => 'wedding-client-a',
    ]);

    $invitation->guests()->create([
        'name' => 'Bapak Budi Santoso',
        'slug' => 'bapak-budi-santoso',
        'phone' => '081234567890',
        'category' => 'Keluarga',
        'pax' => 2,
        'attendance_status' => 'pending',
        'is_invited' => true,
    ]);

    $response = $this->actingAs($this->partner)->get(route('partner.guests.index'));

    $response->assertOk()
        ->assertSee('Buku Tamu')
        ->assertSee('Bapak Budi Santoso')
        ->assertSee('081234567890');
});

test('partner can add new guest recipient to their invitation', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Client B',
        'slug' => 'wedding-client-b',
    ]);

    $response = $this->actingAs($this->partner)->post(route('partner.guests.store'), [
        'invitation_id' => $invitation->id,
        'name' => 'Ibu Siti Khadijah',
        'phone' => '08987654321',
        'category' => 'VIP',
        'pax' => 3,
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    $this->assertDatabaseHas('invitation_guests', [
        'invitation_id' => $invitation->id,
        'name' => 'Ibu Siti Khadijah',
        'phone' => '08987654321',
        'category' => 'VIP',
    ]);
});

test('partner can delete a guest recipient', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Client C',
        'slug' => 'wedding-client-c',
    ]);

    $guest = $invitation->guests()->create([
        'name' => 'Tamu Terhapus',
        'slug' => 'tamu-terhapus',
    ]);

    $response = $this->actingAs($this->partner)->delete(route('partner.guests.destroy', $guest));

    $response->assertRedirect()
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('invitation_guests', [
        'id' => $guest->id,
    ]);
});

test('partner can update whatsapp template via guest template route and see customized formatting', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Client Custom WA',
        'slug' => 'wedding-client-custom-wa',
    ]);

    $customTemplate = "Halo Kak [nama]!\nKami mengundang Kakak ke acara pernikahan:\n[link]\nMohon doa restunya ya Kak!";

    $response = $this->actingAs($this->partner)->post(route('partner.guests.template'), [
        'invitation_id' => $invitation->id,
        'whatsapp_template' => $customTemplate,
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    $invitation->refresh();
    expect($invitation->whatsapp_template)->toBe($customTemplate);

    $formatted = $invitation->formatWhatsappMessage('Budi Santoso', 'https://undangan.test/u/wedding-client-custom-wa?to=Budi+Santoso');
    expect($formatted)->toContain('Halo Kak Budi Santoso!')
        ->toContain('https://undangan.test/u/wedding-client-custom-wa?to=Budi+Santoso')
        ->toContain('Mohon doa restunya ya Kak!');
});

test('partner can update whatsapp template through invitation edit form', function () {
    $invitation = Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Form Template',
        'slug' => 'wedding-form-template',
    ]);

    $formTemplate = "Kepada [nama],\nUndangan pernikahan ada di [link]";

    $response = $this->actingAs($this->partner)->put(route('partner.invitations.update', $invitation), [
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Form Template Updated',
        'groom_name' => 'Dimas Pratama',
        'bride_name' => 'Siti Aisyah',
        'whatsapp_template' => $formTemplate,
    ]);

    $response->assertRedirect(route('partner.invitations.index'))
        ->assertSessionHas('success');

    $invitation->refresh();
    expect($invitation->whatsapp_template)->toBe($formTemplate);
});

test('super admin can view partner packages settings page and see packages and partners', function () {
    $response = $this->actingAs($this->admin)->get(route('partners.index'));

    $response->assertOk()
        ->assertSee('Pengaturan Paket Partner', false)
        ->assertSee('Starter Partner')
        ->assertSee('Pro WO')
        ->assertSee('Enterprise Partner')
        ->assertSee($this->partner->name);
});

test('super admin can update package price quota features and active status', function () {
    $package = Package::where('slug', 'partner-starter')->firstOrFail();

    $response = $this->actingAs($this->admin)->put(route('admin.partners.packages.update', $package), [
        'name' => 'Starter Partner Plus',
        'price' => 350000,
        'quota_invitations' => 15,
        'features' => "Fitur Baru 1\nFitur Baru 2",
        'is_active' => '1',
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    $package->refresh();
    expect($package->name)->toBe('Starter Partner Plus')
        ->and((float) $package->price)->toBe(350000.0)
        ->and($package->quota_invitations)->toBe(15)
        ->and($package->features)->toBe(['Fitur Baru 1', 'Fitur Baru 2'])
        ->and($package->is_active)->toBeTrue();
});

test('super admin can assign different package to partner', function () {
    $proPackage = Package::where('slug', 'partner-pro')->firstOrFail();

    $response = $this->actingAs($this->admin)->patch(route('admin.partners.users.package', $this->partner), [
        'package_id' => $proPackage->id,
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    $this->partner->refresh();
    expect($this->partner->package_id)->toBe($proPackage->id)
        ->and($this->partner->active_package->id)->toBe($proPackage->id)
        ->and($this->partner->invitation_quota)->toBe(30);
});

test('partner can view packages catalog page and see current package and quota', function () {
    $response = $this->actingAs($this->partner)->get(route('partner.packages.index'));

    $response->assertOk()
        ->assertSee('Paket Kemitraan')
        ->assertSee('Starter Partner')
        ->assertSee('Pro WO & Studio')
        ->assertSee('Enterprise Partner')
        ->assertSee('Paket Aktif');
});

test('partner cannot create invitation when quota limit is reached', function () {
    $starterPackage = Package::where('slug', 'partner-starter')->firstOrFail();
    $starterPackage->update(['quota_invitations' => 1]);

    $this->partner->update(['package_id' => $starterPackage->id]);

    // Create 1 invitation to exhaust quota
    Invitation::create([
        'user_id' => $this->partner->id,
        'owner_id' => $this->partner->id,
        'partner_id' => $this->partner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Invitation First',
        'slug' => 'invitation-first-'.uniqid(),
    ]);

    expect($this->partner->canCreateInvitation())->toBeFalse();

    // Try to access create page
    $createResponse = $this->actingAs($this->partner)->get(route('partner.invitations.create'));
    $createResponse->assertRedirect(route('partner.invitations.index'))
        ->assertSessionHas('error');

    // Try to post store invitation
    $storeResponse = $this->actingAs($this->partner)->post(route('partner.invitations.store'), [
        'theme_id' => $this->theme->id,
        'title' => 'Invitation Second Should Fail',
        'groom_name' => 'Dimas',
        'bride_name' => 'Aisyah',
    ]);

    $storeResponse->assertRedirect(route('partner.invitations.index'))
        ->assertSessionHas('error');

    $this->assertDatabaseMissing('invitations', [
        'title' => 'Invitation Second Should Fail',
    ]);
});

test('paying for package order updates partner package_id', function () {
    $proPackage = Package::where('slug', 'partner-pro')->firstOrFail();
    $paymentService = app(PaymentService::class);

    $order = $paymentService->createOrderForPackage($this->partner, $proPackage);

    expect($order->items()->first()->item_type)->toBe('package')
        ->and($order->items()->first()->item_id)->toBe($proPackage->id);

    $paymentService->processSuccessfulPayment($order, 'TEST-PAY-'.time(), 'simulation');

    $this->partner->refresh();
    expect($this->partner->package_id)->toBe($proPackage->id);
});

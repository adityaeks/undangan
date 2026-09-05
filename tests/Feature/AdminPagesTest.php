<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('authenticated user can view dashboard page with real metrics', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk()
        ->assertSee('Selamat Datang')
        ->assertSee('Admin Workspace');
});

test('authenticated member can view dedicated member dashboard with member layout', function () {
    $member = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($member)->get('/dashboard');

    $response->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Progres Kelengkapan Undangan')
        ->assertSee('Member Aktif');
});

test('newly registered member starts with empty invitations and shows empty onboarding state', function () {
    $member = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($member)->get('/dashboard');

    $response->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Undangan Belum Dibuat')
        ->assertSee('Mulai Buat Undangan Pertama Saya')
        ->assertDontSee('The Wedding of Raka & Arinda');

    $invitationResponse = $this->actingAs($member)->get('/member/invitations');
    $invitationResponse->assertOk()
        ->assertSee('Belum Ada Undangan');
});

test('member cannot access admin workspace routes and receives 403 forbidden', function () {
    $member = User::factory()->create(['role' => 'member']);

    $this->actingAs($member)->get('/admin/dashboard')->assertForbidden();
    $this->actingAs($member)->get('/admin/invitations')->assertForbidden();
    $this->actingAs($member)->get('/admin/themes')->assertForbidden();
    $this->actingAs($member)->get('/admin/guests')->assertForbidden();
    $this->actingAs($member)->get('/admin/wishes')->assertForbidden();
    $this->actingAs($member)->get('/admin/orders')->assertForbidden();
    $this->actingAs($member)->get('/admin/partners')->assertForbidden();
});

test('member can view and manage their dedicated member pages with portal pengantin layout', function () {
    $member = User::factory()->create(['role' => 'member']);

    // Invitations
    $this->actingAs($member)->get('/member/invitations')
        ->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Data Undangan Pernikahan');

    // Create Invitation
    $this->actingAs($member)->get('/member/invitations/create')
        ->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Form Pembuatan Undangan Baru');

    // Themes
    $this->actingAs($member)->get('/member/themes')
        ->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Pilihan Desain Tema Undangan');

    // Guests
    $this->actingAs($member)->get('/member/guests')
        ->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Daftar Tamu & Sebar Undangan WA');

    // Wishes
    $this->actingAs($member)->get('/member/wishes')
        ->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Buku Tamu & Doa Restu');

    // Orders
    $this->actingAs($member)->get('/member/orders')
        ->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Riwayat Transaksi & Pembayaran');
});

test('authenticated super admin can view admin invitations index and create pages', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/admin/invitations');
    $response->assertOk()
        ->assertSee('Daftar Undangan Terdaftar');

    $createResponse = $this->actingAs($user)->get('/admin/invitations/create');
    $createResponse->assertOk()
        ->assertSee('Form Pembuatan Undangan Baru');
});

test('authenticated member can store and save new invitation with couple events and wallets', function () {
    $user = User::factory()->create(['role' => 'member']);
    $theme = Theme::first() ?? Theme::create([
        'name' => 'The Monochrome Elegance',
        'slug' => 'monochrome-elegance',
        'category' => 'Minimalist Editorial',
        'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
        'view_path' => 'demo.index',
        'is_active' => true,
    ]);

    $payload = [
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Dimas & Anisa',
        'slug' => 'dimas-anisa',
        'groom_name' => 'Dimas Arya Pratama, S.T.',
        'groom_nickname' => 'Dimas',
        'groom_father' => 'Bpk. Hendra Pratama',
        'groom_mother' => 'Ibu Wulandari',
        'groom_instagram' => 'dimas.arya',
        'bride_name' => 'Anisa Putri Maharani, S.Ked',
        'bride_nickname' => 'Anisa',
        'bride_father' => 'Bpk. Tri Wahyudi',
        'bride_mother' => 'Ibu Siti Aminah',
        'bride_instagram' => 'anisa.maharani',
        'akad_date' => '2026-11-20',
        'akad_time' => '08.00 - 10.00 WIB',
        'akad_venue' => 'Masjid Raya Pondok Indah',
        'akad_address' => 'Jl. Iskandar Muda, Jakarta Selatan',
        'akad_maps_link' => 'https://maps.google.com/?q=Jakarta',
        'resepsi_date' => '2026-11-20',
        'resepsi_time' => '11.00 - 14.00 WIB',
        'resepsi_venue' => 'Ballroom Pondok Indah',
        'resepsi_address' => 'Jl. Iskandar Muda, Jakarta Selatan',
        'resepsi_maps_link' => 'https://maps.google.com/?q=Jakarta',
        'bank_1_name' => 'BCA',
        'bank_1_number' => '880199281',
        'bank_1_holder' => 'Dimas Arya',
    ];

    $response = $this->actingAs($user)->post('/member/invitations', $payload);

    $response->assertRedirect('/member/invitations');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('invitations', [
        'title' => 'Pernikahan Dimas & Anisa',
        'slug' => 'dimas-anisa',
    ]);

    $this->assertDatabaseHas('invitation_couples', [
        'nickname' => 'Dimas',
        'role' => 'groom',
    ]);

    $this->assertDatabaseHas('invitation_couples', [
        'nickname' => 'Anisa',
        'role' => 'bride',
    ]);

    $this->assertDatabaseHas('invitation_events', [
        'title' => 'Akad Nikah',
        'venue_name' => 'Masjid Raya Pondok Indah',
    ]);

    $this->assertDatabaseHas('invitation_gifts', [
        'bank_name' => 'BCA',
        'account_number' => '880199281',
    ]);
});

test('authenticated member can upload files for cover bride groom gallery and music', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'member']);
    $theme = Theme::first() ?? Theme::create([
        'name' => 'The Monochrome Elegance',
        'slug' => 'monochrome-elegance',
        'category' => 'Minimalist Editorial',
        'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
        'view_path' => 'demo.index',
        'is_active' => true,
    ]);

    $payload = [
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Upload Media',
        'slug' => 'upload-media',
        'cover_image_file' => UploadedFile::fake()->image('cover.jpg'),
        'groom_photo_file' => UploadedFile::fake()->image('groom.jpg'),
        'bride_photo_file' => UploadedFile::fake()->image('bride.jpg'),
        'gallery_files' => [
            UploadedFile::fake()->image('gallery1.jpg'),
            UploadedFile::fake()->image('gallery2.jpg'),
        ],
        'music_file' => UploadedFile::fake()->create('custom-song.mp3', 500, 'audio/mpeg'),
        'groom_name' => 'Reza Rahardian, S.Sn.',
        'groom_nickname' => 'Reza',
        'bride_name' => 'Maudy Ayunda, M.A.',
        'bride_nickname' => 'Maudy',
        'akad_date' => '2026-12-12',
        'akad_time' => '09.00 WIB',
        'akad_venue' => 'Plataran Dharmawangsa',
        'akad_address' => 'Jl. Dharmawangsa, Jakarta Selatan',
        'resepsi_date' => '2026-12-12',
        'resepsi_time' => '19.00 WIB',
        'resepsi_venue' => 'Plataran Dharmawangsa',
        'resepsi_address' => 'Jl. Dharmawangsa, Jakarta Selatan',
    ];

    $response = $this->actingAs($user)->post('/member/invitations', $payload);

    $response->assertRedirect('/member/invitations');
    $response->assertSessionHas('success');

    $invitation = Invitation::where('slug', 'upload-media')->first();
    expect($invitation)->not->toBeNull();
    expect($invitation->galleries()->count())->toBe(2);
});

test('authenticated member can delete an invitation', function () {
    $user = User::factory()->create(['role' => 'member']);
    $theme = Theme::first() ?? Theme::create([
        'name' => 'The Warm Minimalist',
        'slug' => 'minimalist',
        'category' => 'minimalist',
        'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    $invitation = Invitation::create([
        'owner_id' => $user->id,
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Sample Undangan Untuk Dihapus',
        'slug' => 'sample-hapus',
        'event_type' => 'Pernikahan',
        'event_date' => '2026-10-10',
        'is_published' => true,
    ]);

    $response = $this->actingAs($user)->delete("/member/invitations/{$invitation->id}");

    $response->assertRedirect('/member/invitations');
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('invitations', [
        'id' => $invitation->id,
    ]);
});

test('authenticated super admin can view themes catalog page', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/admin/themes');

    $response->assertOk()
        ->assertSee('Katalog Tema & Kustomisasi Gaya', false);
});

test('authenticated super admin can view guests page with WhatsApp helpers', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/admin/guests');

    $response->assertOk()
        ->assertSee('Daftar Tamu & Sebar WhatsApp', false);
});

test('authenticated super admin can view wishes moderation page', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/admin/wishes');

    $response->assertOk()
        ->assertSee('Ucapan Doa & Respon Kehadiran', false);
});

test('authenticated super admin can view partner WO management page', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/admin/partners');

    $response->assertOk()
        ->assertSee('Kemitraan Wedding Organizer', false);
});

test('authenticated super admin can view orders & billing transactions page', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)->get('/admin/orders');

    $response->assertOk()
        ->assertSee('Riwayat Transaksi', false);
});

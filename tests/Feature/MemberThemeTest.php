<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;
use App\Services\PaymentService;

function createTestTheme(array $attributes = []): Theme
{
    static $counter = 1;
    $slug = $attributes['slug'] ?? 'test-theme-'.$counter++;

    return Theme::create(array_merge([
        'name' => 'Theme '.ucfirst($slug),
        'slug' => $slug,
        'category' => 'modern',
        'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800',
        'view_path' => 'demo.editorial',
        'price' => 49000,
        'is_active' => true,
        'is_premium' => true,
    ], $attributes));
}

test('member with zero purchases sees empty state on member themes page', function () {
    $member = User::factory()->create(['role' => 'member']);

    $response = $this->actingAs($member)->get('/member/themes');

    $response->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Belum Ada Tema yang Dibeli')
        ->assertSee('Jelajahi Katalog Tema')
        ->assertSee(route('themes.catalog'))
        ->assertDontSee('Lunas & Aktif');
});

test('member with one purchased and active theme only sees that theme on member themes page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $editorial = createTestTheme([
        'name' => 'The Vogue Editorial Issue',
        'slug' => 'editorial-test-'.uniqid(),
        'is_active' => true,
        'is_premium' => true,
        'price' => 49000,
    ]);
    $botanical = createTestTheme([
        'name' => 'The Ethereal Botanical Glass',
        'slug' => 'botanical-test-'.uniqid(),
        'is_active' => true,
        'is_premium' => true,
        'price' => 49000,
    ]);

    UserTheme::create([
        'user_id' => $member->id,
        'theme_id' => $editorial->id,
        'is_active' => true,
        'unlocked_at' => now(),
    ]);

    $response = $this->actingAs($member)->get('/member/themes');

    $response->assertOk()
        ->assertSee('The Vogue Editorial Issue')
        ->assertSee('Aktif')
        ->assertSee('Lunas')
        ->assertSee(route('member.invitations.create', ['theme_id' => $editorial->id]))
        ->assertDontSee('The Ethereal Botanical Glass')
        ->assertDontSee('Belum Ada Tema yang Dibeli');
});

test('member with deactivated theme does not see it on member themes page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $classic = createTestTheme([
        'name' => 'The Timeless Classic Card Deactivated',
        'slug' => 'classic-test-'.uniqid(),
        'is_active' => true,
        'is_premium' => true,
        'price' => 49000,
    ]);

    UserTheme::create([
        'user_id' => $member->id,
        'theme_id' => $classic->id,
        'is_active' => false,
        'unlocked_at' => now(),
    ]);

    $response = $this->actingAs($member)->get('/member/themes');

    $response->assertOk()
        ->assertSee('Belum Ada Tema yang Dibeli')
        ->assertDontSee('The Timeless Classic Card Deactivated')
        ->assertDontSee('Aktif & Lunas');
});

test('super admin can see all active themes on member themes page', function () {
    $admin = User::factory()->create(['role' => 'super_admin']);
    $theme1 = createTestTheme(['name' => 'Theme Alfa Super', 'slug' => 'theme-alfa-'.uniqid()]);
    $theme2 = createTestTheme(['name' => 'Theme Beta Super', 'slug' => 'theme-beta-'.uniqid()]);

    $response = $this->actingAs($admin)->get('/member/themes');

    $response->assertOk()
        ->assertSee('Theme Alfa Super')
        ->assertSee('Theme Beta Super');
});

test('purchasing a theme unlocks it on member dashboard and member themes page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = createTestTheme([
        'name' => 'The Rose Romance Arch Luxury',
        'slug' => 'rose-romance-'.uniqid(),
        'is_active' => true,
        'is_premium' => true,
        'price' => 49000,
    ]);

    $paymentService = app(PaymentService::class);
    $order = $paymentService->createOrderForTheme($member, $theme);

    $paymentService->processSuccessfulPayment($order, 'SIM-'.uniqid(), 'manual_transfer');

    // Check member themes page
    $themeResponse = $this->actingAs($member)->get('/member/themes');
    $themeResponse->assertOk()
        ->assertSee('The Rose Romance Arch Luxury')
        ->assertSee('Aktif')
        ->assertSee('Lunas');

    // Check member dashboard page
    $dashboardResponse = $this->actingAs($member)->get('/dashboard');
    $dashboardResponse->assertOk()
        ->assertSee('Tema yang Telah Anda Miliki')
        ->assertSee('The Rose Romance Arch Luxury')
        ->assertSee('Lunas');
});

test('member with zero purchases visits invitation create page and sees empty theme warning and clean inputs', function () {
    $member = User::factory()->create(['role' => 'member']);

    $response = $this->actingAs($member)->get('/member/invitations/create');

    $response->assertOk()
        ->assertSee('Portal Pengantin')
        ->assertSee('Form Pembuatan Undangan Baru')
        ->assertSee('Anda Belum Memiliki Tema Aktif')
        ->assertSee(route('themes.catalog'))
        ->assertDontSee('Pernikahan Raka & Arinda')
        ->assertDontSee('Raka Pratama, S.T.')
        ->assertDontSee('Arinda Putri Larasati')
        ->assertDontSee('Masjid Agung Sunda Kelapa');
});

test('member with active purchased theme sees their theme and clean form on invitation create page', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = createTestTheme([
        'name' => 'The Celestial Gold Romance',
        'slug' => 'celestial-gold-'.uniqid(),
        'is_active' => true,
        'is_premium' => true,
        'price' => 49000,
    ]);

    UserTheme::create([
        'user_id' => $member->id,
        'theme_id' => $theme->id,
        'is_active' => true,
        'unlocked_at' => now(),
    ]);

    $response = $this->actingAs($member)->get('/member/invitations/create');

    $response->assertOk()
        ->assertSee('The Celestial Gold Romance')
        ->assertSee('Siap Pakai')
        ->assertSee('Kisah Perjalanan')
        ->assertSee('Langkah 4: Kisah Perjalanan (Love Story)')
        ->assertSee('Tambah Babak Kisah')
        ->assertDontSee('Anda Belum Memiliki Tema Aktif')
        ->assertDontSee('Pernikahan Raka & Arinda')
        ->assertDontSee('Raka Pratama, S.T.')
        ->assertDontSee('Arinda Putri Larasati');
});

test('member can submit invitation with stories timeline and persist to database', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = createTestTheme([
        'name' => 'Minimalist Story Theme',
        'slug' => 'minimalist-story-'.uniqid(),
        'is_active' => true,
        'is_premium' => true,
        'price' => 49000,
    ]);

    UserTheme::create([
        'user_id' => $member->id,
        'theme_id' => $theme->id,
        'is_active' => true,
        'unlocked_at' => now(),
    ]);

    $postData = [
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Dimas & Citra',
        'groom_name' => 'Dimas Anggara, S.Kom',
        'groom_nickname' => 'Dimas',
        'bride_name' => 'Citra Kirana, S.Ds',
        'bride_nickname' => 'Citra',
        'akad_date' => '2026-10-10',
        'akad_time' => '08:00 - 10:00 WIB',
        'akad_venue' => 'Masjid Al-Ikhlas',
        'akad_address' => 'Jl. Kebahagiaan No. 12',
        'resepsi_date' => '2026-10-10',
        'resepsi_time' => '11:00 - 14:00 WIB',
        'resepsi_venue' => 'Grand Ballroom Hotel Indah',
        'resepsi_address' => 'Jl. Mawar Melati No. 99',
        'stories' => [
            [
                'title' => 'Pertama Berjumpa',
                'date' => '2020',
                'story' => 'Bertemu di perpustakaan kampus secara tidak sengaja.',
            ],
            [
                'title' => 'Mengikat Janji Lamaran',
                'date' => '2025',
                'story' => 'Keluarga besar berkumpul melangsungkan prosesi lamaran.',
            ],
        ],
    ];

    $response = $this->actingAs($member)->post('/member/invitations', $postData);

    $response->assertRedirect(route('member.invitations.index'));

    $this->assertDatabaseHas('invitations', [
        'user_id' => $member->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Dimas & Citra',
    ]);

    $invitation = Invitation::where('user_id', $member->id)->first();
    expect($invitation)->not->toBeNull();
    expect($invitation->stories)->toHaveCount(2);

    $this->assertDatabaseHas('invitation_stories', [
        'invitation_id' => $invitation->id,
        'title' => 'Pertama Berjumpa',
        'date' => '2020',
        'order' => 1,
    ]);

    $this->assertDatabaseHas('invitation_stories', [
        'invitation_id' => $invitation->id,
        'title' => 'Mengikat Janji Lamaran',
        'date' => '2025',
        'order' => 2,
    ]);
});

test('member can submit complete custom couple, gallery, and physical gift address and see on public invitation', function () {
    $member = User::factory()->create(['role' => 'member']);
    $theme = createTestTheme([
        'name' => 'The Warm Minimalist Custom',
        'slug' => 'minimalist-custom-test-'.uniqid(),
        'view_path' => 'demo.minimalist',
        'price' => 0,
        'is_premium' => false,
    ]);

    $postData = [
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Rangga & Cinta',
        'groom_name' => 'Rangga Perkasa, S.T.',
        'groom_nickname' => 'Rangga',
        'groom_child_order' => 'Putra Sulung',
        'groom_father' => 'Bpk. Herman Perkasa',
        'groom_mother' => 'Ibu Rina Sugiarti',
        'groom_instagram' => '@ranggaprk',
        'groom_photo_url' => 'https://cdn.example.com/photos/rangga.jpg',

        'bride_name' => 'Cinta Permata, S.Psi.',
        'bride_nickname' => 'Cinta',
        'bride_child_order' => 'Putri Kedua',
        'bride_father' => 'Bpk. Surya Permata',
        'bride_mother' => 'Ibu Eni Marlina',
        'bride_instagram' => '@cintaprm',
        'bride_photo_url' => 'https://cdn.example.com/photos/cinta.jpg',

        'akad_date' => '2026-12-10',
        'akad_time' => '08.00 - 10.00 WIB',
        'akad_venue' => 'Masjid Raya Bogor',
        'akad_address' => 'Jl. Pajajaran No. 10, Bogor',

        'resepsi_date' => '2026-12-10',
        'resepsi_time' => '11.00 - 14.00 WIB',
        'resepsi_venue' => 'Bogor Grand Ballroom',
        'resepsi_address' => 'Jl. Pajajaran No. 12, Bogor',

        'bank_1_name' => 'Bank Central Asia (BCA)',
        'bank_1_number' => '1234567890',
        'bank_1_holder' => 'Rangga Perkasa',

        'quote_text' => 'Kasih itu sabar; kasih itu murah hati; ia tidak cemburu.',
        'quote_source' => '1 Korintus 13:4',

        'gift_address' => 'Perumahan Baranangsiang Indah Blok C No. 15, Bogor',

        'gallery_urls' => [
            'https://cdn.example.com/galleries/photo1.jpg',
            'https://cdn.example.com/galleries/photo2.jpg',
        ],
    ];

    // Verify form renders quote fields and preset choices
    $createResponse = $this->actingAs($member)->get(route('member.invitations.create', ['theme_id' => $theme->id]));
    $createResponse->assertOk()
        ->assertSee('name="quote_text"', false)
        ->assertSee('name="quote_source"', false)
        ->assertSee('Kutipan Ayat / Doa / Kata Mutiara (Quotes)')
        ->assertSee('QS. Ar-Rum: 21 (Islami)')
        ->assertSee('1 Korintus 13:4-7 (Kristiani)')
        ->assertSee('Kahlil Gibran (Puitis)');

    $response = $this->actingAs($member)->post('/member/invitations', $postData);
    $response->assertRedirect(route('member.invitations.index'));

    $invitation = Invitation::where('user_id', $member->id)->latest()->first();
    expect($invitation)->not->toBeNull();
    expect($invitation->quote_text)->toBe('Kasih itu sabar; kasih itu murah hati; ia tidak cemburu.');
    expect($invitation->quote_source)->toBe('1 Korintus 13:4');

    // Check couple data in DB
    $groom = $invitation->couples()->where('role', 'groom')->first();
    expect($groom->child_number)->toBe('Putra Sulung');
    expect($groom->instagram)->toBe('ranggaprk');
    expect($groom->photo_url)->toBe('https://cdn.example.com/photos/rangga.jpg');

    $bride = $invitation->couples()->where('role', 'bride')->first();
    expect($bride->child_number)->toBe('Putri Kedua');
    expect($bride->instagram)->toBe('cintaprm');
    expect($bride->photo_url)->toBe('https://cdn.example.com/photos/cinta.jpg');

    // Check physical gift
    $this->assertDatabaseHas('invitation_gifts', [
        'invitation_id' => $invitation->id,
        'gift_type' => 'physical_gift',
        'recipient_address' => 'Perumahan Baranangsiang Indah Blok C No. 15, Bogor',
    ]);

    // Check public page renders custom data
    $publicResponse = $this->get("/u/{$invitation->slug}");
    $publicResponse->assertOk()
        ->assertSee('Rangga Perkasa, S.T.')
        ->assertSee('Cinta Permata, S.Psi.')
        ->assertSee('Putra Sulung')
        ->assertSee('Putri Kedua')
        ->assertSee('Bpk. Herman Perkasa')
        ->assertSee('Bpk. Surya Permata')
        ->assertSee('@ranggaprk')
        ->assertSee('@cintaprm')
        ->assertSee('https://cdn.example.com/photos/rangga.jpg')
        ->assertSee('https://cdn.example.com/photos/cinta.jpg')
        ->assertSee('https://cdn.example.com/galleries/photo1.jpg')
        ->assertSee('Perumahan Baranangsiang Indah Blok C No. 15, Bogor')
        ->assertSee('Kasih itu sabar; kasih itu murah hati; ia tidak cemburu.')
        ->assertSee('1 Korintus 13:4');
});

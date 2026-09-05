<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;

test('public user can view authentic digital invitation by slug with real input data', function () {
    $user = User::factory()->create();
    $theme = Theme::first() ?? Theme::create([
        'name' => 'The Warm Minimalist',
        'slug' => 'minimalist',
        'category' => 'minimalist',
        'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    $invitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Farhan & Nabila',
        'slug' => 'farhan-nabila',
        'event_type' => 'Pernikahan',
        'event_date' => '2026-12-25',
        'cover_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552',
        'is_published' => true,
    ]);

    $invitation->couples()->create([
        'role' => 'groom',
        'full_name' => 'Farhan Alatas, S.Kom.',
        'nickname' => 'Farhan',
        'order' => 1,
    ]);

    $invitation->couples()->create([
        'role' => 'bride',
        'full_name' => 'Nabila Syakieb, B.A.',
        'nickname' => 'Nabila',
        'order' => 2,
    ]);

    $invitation->events()->create([
        'title' => 'Akad Nikah',
        'date' => '2026-12-25',
        'start_time' => '08.00 WIB',
        'venue_name' => 'Masjid Istiqlal Jakarta',
        'address' => 'Jakarta Pusat',
    ]);

    $response = $this->get("/u/{$invitation->slug}?to=Bapak+Joko+Widodo");

    $response->assertOk()
        ->assertSee('Farhan')
        ->assertSee('Nabila')
        ->assertSee('Bapak Joko Widodo')
        ->assertSee('Masjid Istiqlal Jakarta');
});

test('public guest can submit wish and RSVP message on invitation', function () {
    $user = User::factory()->create();
    $theme = Theme::first() ?? Theme::create([
        'name' => 'The Monochrome Elegance',
        'slug' => 'monochrome-elegance',
        'category' => 'Minimalist Editorial',
        'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
        'view_path' => 'demo.index',
        'is_active' => true,
    ]);

    $invitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Farhan & Nabila',
        'slug' => 'farhan-nabila-wishes',
        'event_type' => 'Pernikahan',
        'event_date' => '2026-12-25',
        'is_published' => true,
    ]);

    $response = $this->postJson("/u/{$invitation->slug}/wishes", [
        'guest_name' => 'Keluarga Besar Bpk. Anton',
        'attendance' => 'Hadir (2 Orang)',
        'message' => 'Selamat untuk Farhan dan Nabila! Semoga langgeng hingga kakek nenek.',
    ]);

    $response->assertOk()
        ->assertJson([
            'success' => true,
        ]);

    $this->assertDatabaseHas('invitation_wishes', [
        'invitation_id' => $invitation->id,
        'guest_name' => 'Keluarga Besar Bpk. Anton',
    ]);
});

test('invitation without stories does not display love story section in templates', function () {
    $user = User::factory()->create();
    $themes = [
        'minimalist' => 'demo.minimalist',
        'editorial' => 'demo.editorial',
        'classic' => 'demo.classic',
        'botanical' => 'demo.botanical',
        'rose-romance' => 'demo.rose-romance',
    ];

    foreach ($themes as $slug => $viewPath) {
        $theme = Theme::create([
            'name' => 'Theme '.$slug,
            'slug' => 'test-theme-'.$slug.'-'.uniqid(),
            'category' => 'modern',
            'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
            'view_path' => $viewPath,
            'is_active' => true,
        ]);

        $invitation = Invitation::create([
            'user_id' => $user->id,
            'theme_id' => $theme->id,
            'title' => 'Pernikahan Tanpa Cerita '.$slug,
            'slug' => 'no-stories-'.$slug.'-'.uniqid(),
            'event_type' => 'Pernikahan',
            'event_date' => '2026-12-25',
            'is_published' => true,
        ]);

        $invitation->couples()->create([
            'role' => 'groom',
            'full_name' => 'Budi Pratama',
            'nickname' => 'Budi',
            'order' => 1,
        ]);

        $invitation->couples()->create([
            'role' => 'bride',
            'full_name' => 'Siti Aminah',
            'nickname' => 'Siti',
            'order' => 2,
        ]);

        $response = $this->get("/u/{$invitation->slug}");
        $response->assertOk();

        // Ensure stories sections and story titles are NOT rendered
        $response->assertDontSee('data-preview="story-title-1"', false)
            ->assertDontSee('Perjalanan Kisah Kami')
            ->assertDontSee('Timeline Of Love')
            ->assertDontSee('Kisah Cinta Kami')
            ->assertDontSee('Our Love Story');
    }
});

test('invitation with stories displays love story section in templates', function () {
    $user = User::factory()->create();
    $theme = Theme::create([
        'name' => 'Theme Minimalist With Stories',
        'slug' => 'theme-with-stories-'.uniqid(),
        'category' => 'modern',
        'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    $invitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Ada Cerita',
        'slug' => 'with-stories-'.uniqid(),
        'event_type' => 'Pernikahan',
        'event_date' => '2026-12-25',
        'is_published' => true,
    ]);

    $invitation->couples()->create([
        'role' => 'groom',
        'full_name' => 'Budi Pratama',
        'nickname' => 'Budi',
        'order' => 1,
    ]);

    $invitation->couples()->create([
        'role' => 'bride',
        'full_name' => 'Siti Aminah',
        'nickname' => 'Siti',
        'order' => 2,
    ]);

    $invitation->stories()->create([
        'title' => 'Awal Bertemu di Kampus',
        'date' => '2021',
        'story' => 'Momen tak terlupakan saat pertama kali berkenalan.',
        'order' => 1,
    ]);

    $response = $this->get("/u/{$invitation->slug}");
    $response->assertOk();
    $response->assertSee('Perjalanan Kisah Kami')
        ->assertSee('Awal Bertemu di Kampus')
        ->assertSee('2021');
});

test('each invitation template dynamically renders complete custom user data without dummy overrides', function () {
    $user = User::factory()->create();
    $templates = [
        'minimalist' => 'demo.minimalist',
        'editorial' => 'demo.editorial',
        'classic' => 'demo.classic',
        'botanical' => 'demo.botanical',
        'rose-romance' => 'demo.rose-romance',
    ];

    foreach ($templates as $themeName => $viewPath) {
        $theme = Theme::create([
            'name' => 'Theme '.$themeName.' Test',
            'slug' => 'test-'.$themeName.'-'.uniqid(),
            'category' => 'elegant',
            'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc',
            'view_path' => $viewPath,
            'is_active' => true,
        ]);

        $invitation = Invitation::create([
            'user_id' => $user->id,
            'theme_id' => $theme->id,
            'title' => 'The Wedding of Aditya & Sabrina '.$themeName,
            'slug' => 'aditya-sabrina-'.$themeName.'-'.uniqid(),
            'event_type' => 'Pernikahan',
            'event_date' => '2026-11-20',
            'cover_image' => 'https://cdn.example.com/custom-cover-'.$themeName.'.jpg',
            'quote_text' => 'Janji suci di hadapan Sang Maha Kuasa.',
            'quote_source' => 'Surat Cinta 2026',
            'is_published' => true,
        ]);

        $invitation->couples()->create([
            'role' => 'groom',
            'full_name' => 'Aditya Pratama Putra, S.T.',
            'nickname' => 'Aditya',
            'child_number' => 'Putra Pertama',
            'father_name' => 'Bpk. Bambang Wijaya',
            'mother_name' => 'Ibu Ratna Dewi',
            'instagram' => 'aditya_custom_ig',
            'photo_url' => 'https://cdn.example.com/aditya-portrait.jpg',
            'order' => 1,
        ]);

        $invitation->couples()->create([
            'role' => 'bride',
            'full_name' => 'Sabrina Larasati, M.Psi.',
            'nickname' => 'Sabrina',
            'child_number' => 'Putri Tunggal',
            'father_name' => 'Bpk. Hendra Kusuma',
            'mother_name' => 'Ibu Maya Anggraini',
            'instagram' => 'sabrina_custom_ig',
            'photo_url' => 'https://cdn.example.com/sabrina-portrait.jpg',
            'order' => 2,
        ]);

        $invitation->events()->create([
            'title' => 'Akad Nikah',
            'date' => '2026-11-20',
            'start_time' => '09.00 - 11.00 WIB',
            'venue_name' => 'Masjid Al-Ikhlas Mega Kuningan',
            'address' => 'Jl. Kuningan Barat No. 88, Jakarta Selatan',
            'order' => 1,
        ]);

        $invitation->media()->create([
            'media_type' => 'photo',
            'url' => 'https://cdn.example.com/gallery-prewed-1.jpg',
            'order' => 1,
        ]);
        $invitation->media()->create([
            'media_type' => 'photo',
            'url' => 'https://cdn.example.com/gallery-prewed-2.jpg',
            'order' => 2,
        ]);

        $invitation->stories()->create([
            'title' => 'Pertemuan di Perpustakaan',
            'date' => '2022',
            'story' => 'Takdir mempertemukan kami saat mencari buku referensi tesis.',
            'image_url' => 'https://cdn.example.com/story-moment-1.jpg',
            'order' => 1,
        ]);

        $invitation->gifts()->create([
            'gift_type' => 'bank_transfer',
            'bank_name' => 'Bank Syariah Indonesia (BSI)',
            'account_number' => '7123456789',
            'account_name' => 'Aditya Pratama',
            'order' => 1,
        ]);

        $invitation->gifts()->create([
            'gift_type' => 'physical_gift',
            'recipient_address' => 'Cluster Cempaka Indah No. 45, Bintaro Jaya',
            'order' => 2,
        ]);

        $response = $this->get("/u/{$invitation->slug}");
        $response->assertOk();

        // 1. Check custom couple profile photos
        $response->assertSee('https://cdn.example.com/aditya-portrait.jpg')
            ->assertSee('https://cdn.example.com/sabrina-portrait.jpg');

        // 2. Check custom Instagram handles (with @ prefix as expected)
        $response->assertSee('@aditya_custom_ig')
            ->assertSee('@sabrina_custom_ig')
            ->assertSee('instagram.com/aditya_custom_ig')
            ->assertSee('instagram.com/sabrina_custom_ig');

        // 3. Check custom names and parent info
        $response->assertSee('Aditya Pratama Putra, S.T.')
            ->assertSee('Sabrina Larasati, M.Psi.')
            ->assertSee('Bpk. Bambang Wijaya')
            ->assertSee('Ibu Ratna Dewi')
            ->assertSee('Bpk. Hendra Kusuma')
            ->assertSee('Ibu Maya Anggraini')
            ->assertSee('Putra Pertama')
            ->assertSee('Putri Tunggal');

        // 4. Check gallery photos
        $response->assertSee('https://cdn.example.com/gallery-prewed-1.jpg')
            ->assertSee('https://cdn.example.com/gallery-prewed-2.jpg');

        // 5. Check love story and image
        $response->assertSee('Pertemuan di Perpustakaan')
            ->assertSee('2022')
            ->assertSee('https://cdn.example.com/story-moment-1.jpg');

        // 6. Check bank account and physical gift address
        $response->assertSee('Bank Syariah Indonesia (BSI)')
            ->assertSee('7123456789')
            ->assertSee('Cluster Cempaka Indah No. 45, Bintaro Jaya');
    }
});

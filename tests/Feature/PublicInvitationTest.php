<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;

test('public user can view authentic digital invitation by slug with real input data', function () {
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
        'slug' => 'farhan-nabila',
        'event_type' => 'Pernikahan',
        'event_date' => '2026-12-25',
        'cover_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552',
        'is_published' => true,
    ]);

    $invitation->couple()->create([
        'groom_name' => 'Farhan Alatas, S.Kom.',
        'groom_nickname' => 'Farhan',
        'bride_name' => 'Nabila Syakieb, B.A.',
        'bride_nickname' => 'Nabila',
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

    $this->assertDatabaseHas('wishes', [
        'invitation_id' => $invitation->id,
        'guest_name' => 'Keluarga Besar Bpk. Anton',
    ]);
});

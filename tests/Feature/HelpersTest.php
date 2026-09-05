<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Database\Seeders\ThemeSeeder;

test('format_phone correctly normalizes phone numbers to standard 62 prefix', function () {
    expect(format_phone('08123456789'))->toBe('628123456789')
        ->and(format_phone('+62 812-3456-789'))->toBe('628123456789')
        ->and(format_phone('628123456789'))->toBe('628123456789')
        ->and(format_phone(''))->toBe('');
});

test('whatsapp_url generates standard whatsapp chat and share urls', function () {
    $urlWithPhone = whatsapp_url('081234567890', 'Halo apa kabar?');
    expect($urlWithPhone)->toContain('phone=6281234567890')
        ->and($urlWithPhone)->toContain('text=Halo+apa+kabar%3F');

    $urlWithoutPhone = whatsapp_url(null, 'Share message');
    expect($urlWithoutPhone)->toBe('https://api.whatsapp.com/send?text=Share+message');
});

test('format_rupiah formats numeric values to indonesian rupiah representation', function () {
    expect(format_rupiah(49000))->toBe('Rp 49.000')
        ->and(format_rupiah('150000'))->toBe('Rp 150.000')
        ->and(format_rupiah(0))->toBe('Rp 0');
});

test('invitation generateUniqueSlug resolves slug collisions cleanly', function () {
    $user = User::factory()->create();
    $theme = Theme::first() ?? Theme::create([
        'name' => 'Test Theme',
        'slug' => 'test-theme',
        'view_path' => 'demo.index',
        'is_active' => true,
    ]);

    Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Raka & Arinda',
        'slug' => 'raka-arinda',
    ]);

    $newSlug = Invitation::generateUniqueSlug('raka-arinda');
    expect($newSlug)->toBe('raka-arinda-1');
});

test('theme seeder seeds exactly the 5 canonical themes and prunes the rest', function () {
    $this->seed(ThemeSeeder::class);

    $themes = Theme::all();
    expect($themes->count())->toBe(5)
        ->and($themes->pluck('slug')->sort()->values()->toArray())->toBe([
            'botanical',
            'classic',
            'editorial',
            'minimalist',
            'rose-romance',
        ]);

    $editorial = Theme::where('slug', 'editorial')->first();
    expect($editorial->metadata)->toBeArray()
        ->and($editorial->metadata['typography'])->toBe('Cinzel + Cormorant Garamond')
        ->and($editorial->metadata['colors'])->toBeArray()
        ->and($editorial->metadata['colors'][0]['hex'])->toBe('#0A0C13');
});

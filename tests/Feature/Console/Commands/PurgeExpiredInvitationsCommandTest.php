<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;
use Illuminate\Support\Facades\Storage;

test('invitations:purge-expired dry-run identifies expired data without deleting anything', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'member']);
    $theme = Theme::first() ?? Theme::create([
        'name' => 'Minimalist',
        'slug' => 'minimalist',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    Storage::disk('public')->put('invitations/covers/expired-cover.webp', 'expired cover content');

    $invitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Undangan Kedaluwarsa',
        'slug' => 'expired-slug-dryrun',
        'cover_image' => Storage::url('invitations/covers/expired-cover.webp'),
        'is_published' => true,
        'expires_at' => now()->subDay(),
    ]);

    $this->artisan('invitations:purge-expired', ['--dry-run' => true])
        ->expectsOutputToContain('DRY RUN')
        ->expectsOutputToContain('Ditemukan 1 undangan kedaluwarsa')
        ->assertSuccessful();

    // In dry run, records and files MUST still exist
    expect(Invitation::find($invitation->id))->not->toBeNull();
    expect(Storage::disk('public')->exists('invitations/covers/expired-cover.webp'))->toBeTrue();
});

test('invitations:purge-expired purges expired invitations, user themes, and removes all storage files', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'member']);
    $theme = Theme::first() ?? Theme::create([
        'name' => 'Minimalist',
        'slug' => 'minimalist',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    // 1. Setup Active Invitation (must NOT be deleted)
    Storage::disk('public')->put('invitations/covers/active-cover.webp', 'active cover');
    $activeInvitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Undangan Masih Aktif',
        'slug' => 'undangan-aktif',
        'cover_image' => Storage::url('invitations/covers/active-cover.webp'),
        'is_published' => true,
        'expires_at' => now()->addDays(30),
    ]);

    // 2. Setup Expired Invitation linked to expired UserTheme (must BE deleted)
    Storage::disk('public')->put('invitations/covers/expired-cover.webp', 'expired cover');
    Storage::disk('public')->put('invitations/couples/expired-groom.webp', 'expired groom');
    Storage::disk('public')->put('invitations/galleries/expired-gallery.webp', 'expired gallery');
    Storage::disk('public')->put('invitations/stories/expired-story.webp', 'expired story');

    $expiredInvitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Undangan Sudah Habis',
        'slug' => 'undangan-habis',
        'cover_image' => Storage::url('invitations/covers/expired-cover.webp'),
        'is_published' => true,
        'expires_at' => now()->subDays(2),
    ]);

    $expiredInvitation->couples()->create([
        'role' => 'groom',
        'full_name' => 'Groom Name',
        'photo_url' => Storage::url('invitations/couples/expired-groom.webp'),
        'order' => 1,
    ]);

    $expiredInvitation->media()->create([
        'media_type' => 'photo',
        'url' => Storage::url('invitations/galleries/expired-gallery.webp'),
        'order' => 1,
    ]);

    $expiredInvitation->stories()->create([
        'title' => 'Kisah Kedaluwarsa',
        'story' => 'Cerita momen lama',
        'image_url' => Storage::url('invitations/stories/expired-story.webp'),
        'order' => 1,
    ]);

    $expiredUserTheme = UserTheme::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'invitation_id' => $expiredInvitation->id,
        'unlocked_at' => now()->subDays(47),
        'duration_type' => '45_days',
        'expires_at' => now()->subDays(2),
        'is_active' => true,
    ]);

    // Pre-assertions
    expect(Storage::disk('public')->exists('invitations/covers/expired-cover.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/couples/expired-groom.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/galleries/expired-gallery.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/stories/expired-story.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/covers/active-cover.webp'))->toBeTrue();

    // Run the cron command
    $this->artisan('invitations:purge-expired')
        ->expectsOutputToContain('Ditemukan 1 undangan kedaluwarsa')
        ->assertSuccessful();

    // Post-assertions: Expired items must be purged completely
    expect(Invitation::find($expiredInvitation->id))->toBeNull();
    expect(UserTheme::find($expiredUserTheme->id))->toBeNull();
    expect(Storage::disk('public')->exists('invitations/covers/expired-cover.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/couples/expired-groom.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/galleries/expired-gallery.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/stories/expired-story.webp'))->toBeFalse();

    // Post-assertions: Active items must remain untouched
    expect(Invitation::find($activeInvitation->id))->not->toBeNull();
    expect(Storage::disk('public')->exists('invitations/covers/active-cover.webp'))->toBeTrue();
});

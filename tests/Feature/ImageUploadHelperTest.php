<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('upload_as_webp converts JPG image to webp and stores in public disk', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('prewedding.jpg', 1200, 800);
    $storedPath = upload_as_webp($file, 'invitations/covers');

    expect($storedPath)->toEndWith('.webp');
    expect(Storage::disk('public')->exists($storedPath))->toBeTrue();
});

test('upload_as_webp converts PNG image with transparency to webp', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('couple.png', 800, 800);
    $storedPath = upload_as_webp($file, 'invitations/couples');

    expect($storedPath)->toEndWith('.webp');
    expect(Storage::disk('public')->exists($storedPath))->toBeTrue();
});

test('upload_as_webp preserves already webp file without re-compression error', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('already.webp', 100, 'image/webp');
    $storedPath = upload_as_webp($file, 'invitations/gallery');

    expect($storedPath)->toEndWith('.webp');
    expect(Storage::disk('public')->exists($storedPath))->toBeTrue();
});

test('upload_as_webp downscales oversized images above maxWidth', function () {
    Storage::fake('public');

    // Create a 2400x1600 image
    $file = UploadedFile::fake()->image('large-cover.jpg', 2400, 1600);
    $storedPath = upload_as_webp($file, 'invitations/covers', 80, 1920);

    expect($storedPath)->toEndWith('.webp');
    expect(Storage::disk('public')->exists($storedPath))->toBeTrue();

    // Verify stored image dimensions
    $rawContent = Storage::disk('public')->get($storedPath);
    $imageInfo = getimagesizefromstring($rawContent);
    expect($imageInfo[0])->toBeLessThanOrEqual(1920);
});

test('delete_storage_file successfully deletes local public storage files', function () {
    Storage::fake('public');

    // Create a mock file
    $filePath = 'invitations/covers/test-cover.webp';
    Storage::disk('public')->put($filePath, 'fake content');
    expect(Storage::disk('public')->exists($filePath))->toBeTrue();

    // 1. Delete by full storage URL
    $url = '/storage/invitations/covers/test-cover.webp';
    $result = delete_storage_file($url);
    expect($result)->toBeTrue();
    expect(Storage::disk('public')->exists($filePath))->toBeFalse();

    // 2. Delete non-existent returns false
    expect(delete_storage_file('/storage/non-existent.webp'))->toBeFalse();

    // 3. Ignore external URL safely
    expect(delete_storage_file('https://images.unsplash.com/photo-12345'))->toBeFalse();
    expect(delete_storage_file(''))->toBeFalse();
    expect(delete_storage_file(null))->toBeFalse();
});

test('deleting an invitation cascades and deletes its physical files', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $theme = Theme::first() ?? Theme::create([
        'name' => 'Minimalist',
        'slug' => 'minimalist',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    // Put mock files in storage
    Storage::disk('public')->put('invitations/covers/old-cover.webp', 'cover content');
    Storage::disk('public')->put('invitations/couples/groom.webp', 'groom content');
    Storage::disk('public')->put('invitations/galleries/photo1.webp', 'gallery content');
    Storage::disk('public')->put('invitations/stories/story1.webp', 'story content');

    $invitation = Invitation::create([
        'user_id' => $user->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Hapus File',
        'slug' => 'hapus-file',
        'cover_image' => Storage::url('invitations/covers/old-cover.webp'),
        'is_published' => true,
    ]);

    $invitation->couples()->create([
        'role' => 'groom',
        'full_name' => 'Groom Name',
        'photo_url' => Storage::url('invitations/couples/groom.webp'),
        'order' => 1,
    ]);

    $invitation->media()->create([
        'media_type' => 'photo',
        'url' => Storage::url('invitations/galleries/photo1.webp'),
        'order' => 1,
    ]);

    $invitation->stories()->create([
        'title' => 'Kisah Kita',
        'story' => 'Cerita cinta kami dimulai di sini.',
        'image_url' => Storage::url('invitations/stories/story1.webp'),
        'order' => 1,
    ]);

    expect(Storage::disk('public')->exists('invitations/covers/old-cover.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/couples/groom.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/galleries/photo1.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/stories/story1.webp'))->toBeTrue();

    // Delete the invitation
    $invitation->delete();

    // All physical files must now be deleted from disk
    expect(Storage::disk('public')->exists('invitations/covers/old-cover.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/couples/groom.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/galleries/photo1.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/stories/story1.webp'))->toBeFalse();
});

test('updating an invitation with a new cover image deletes the old cover file from disk', function () {
    Storage::fake('public');

    $partner = User::factory()->create(['role' => 'partner']);
    $theme = Theme::first() ?? Theme::create([
        'name' => 'Minimalist',
        'slug' => 'minimalist',
        'view_path' => 'demo.minimalist',
        'is_active' => true,
    ]);

    Storage::disk('public')->put('invitations/covers/previous-cover.webp', 'old cover data');
    Storage::disk('public')->put('invitations/galleries/to-delete.webp', 'old gallery data');

    $invitation = Invitation::create([
        'user_id' => $partner->id,
        'partner_id' => $partner->id,
        'theme_id' => $theme->id,
        'title' => 'Pernikahan Partner Test',
        'slug' => 'partner-update-test',
        'cover_image' => Storage::url('invitations/covers/previous-cover.webp'),
        'is_published' => true,
    ]);

    $mediaToDelete = $invitation->media()->create([
        'media_type' => 'photo',
        'url' => Storage::url('invitations/galleries/to-delete.webp'),
        'order' => 1,
    ]);

    expect(Storage::disk('public')->exists('invitations/covers/previous-cover.webp'))->toBeTrue();
    expect(Storage::disk('public')->exists('invitations/galleries/to-delete.webp'))->toBeTrue();

    $newCover = UploadedFile::fake()->image('brand-new-cover.jpg', 800, 600);

    $response = $this->actingAs($partner)->put(route('partner.invitations.update', $invitation), [
        'title' => 'Pernikahan Partner Updated',
        'theme_id' => $theme->id,
        'groom_name' => 'Andika Pratama',
        'bride_name' => 'Putri Cantika',
        'cover_image_file' => $newCover,
        'delete_media_ids' => [$mediaToDelete->id],
    ]);

    $response->assertRedirect(route('partner.invitations.index'));

    // Old cover and deleted media must be removed from disk
    expect(Storage::disk('public')->exists('invitations/covers/previous-cover.webp'))->toBeFalse();
    expect(Storage::disk('public')->exists('invitations/galleries/to-delete.webp'))->toBeFalse();

    // New cover exists and is webp
    $invitation->refresh();
    $newRelativePath = preg_replace('#^/?storage/#', '', ltrim($invitation->cover_image, '/'));
    expect($newRelativePath)->toEndWith('.webp');
    expect(Storage::disk('public')->exists($newRelativePath))->toBeTrue();
});

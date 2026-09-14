<?php

use Illuminate\Support\Facades\File;

test('theme 3d-motion-05 renders with local assets and without remote invisimple links', function () {
    $response = $this->get(route('demo.show', ['slug' => '3d-motion-05']));

    $response->assertStatus(200);
    $content = $response->getContent();

    expect($content)->toContain('/themes/3d-motion-05/')
        ->not->toContain('https://the.invisimple.id/wp-content/')
        ->not->toContain('https://namabrand.invisimple.id/wp-content/');
});

test('theme 3d-motion-01 renders with local assets and without remote invisimple links', function () {
    $response = $this->get(route('demo.show', ['slug' => '3d-motion-01']));

    $response->assertStatus(200);
    $content = $response->getContent();

    expect($content)->toContain('/themes/3d-motion-01/')
        ->not->toContain('https://the.invisimple.id/wp-content/')
        ->not->toContain('https://namabrand.invisimple.id/wp-content/');
});

test('downloaded local assets exist on public disk for both 3d-motion themes', function () {
    expect(File::exists(public_path('themes/3d-motion-05/uploads/2024/10/Garden-05-Overlay.jpg')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-05/uploads/elementor/css/post-8021.css')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-05/uploads/useanyfont/3646InvitajaFont.woff')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/webfonts/fa-solid-900.woff2')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-05/plugins/elementor/assets/lib/dialog/dialog.js')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-05/uploads/2025/10/05.-FOUNTAIN-GARDEN-15S.mp4')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-01/uploads/2024/10/Garden-01-Overlay-1.jpg')))->toBeTrue()
        ->and(File::exists(public_path('themes/3d-motion-01/uploads/elementor/css/post-7749.css')))->toBeTrue();
});

test('wordpress compatibility routes return success for ajax and fonts', function () {
    $this->post('/themes/3d-motion-05/wp-admin/admin-ajax.php')
        ->assertStatus(200)
        ->assertJson(['success' => true]);

    $this->get('/wp-content/uploads/useanyfont/3646InvitajaFont.woff')
        ->assertStatus(200);
});

test('theme luxury-01 renders with local assets and without remote invisimple links', function () {
    $response = $this->get(route('demo.show', ['slug' => 'luxury-01']));

    $response->assertStatus(200);
    $content = $response->getContent();

    expect($content)->toContain('/themes/luxury-01/')
        ->not->toContain('https://the.invisimple.id/wp-content/')
        ->not->toContain('https://namabrand.invisimple.id/wp-content/');
});

test('supports l01 alias and renders dynamic luxury-01 preview', function () {
    $response = $this->get('/demo/l01?to=Bpk.+Joko+Widodo&groom_nickname=Ryan&bride_nickname=Vanya');

    $response->assertStatus(200)
        ->assertSee('Ryan')
        ->assertSee('Vanya')
        ->assertSee('Bpk. Joko Widodo');
});

test('downloaded local assets exist on public disk for luxury-01 theme', function () {
    expect(File::exists(public_path('themes/luxury-01/uploads/elementor/css/post-22504.css')))->toBeTrue()
        ->and(File::exists(public_path('themes/luxury-01/uploads/2025/02/thumbnail-luxury-01-1.jpg')))->toBeTrue()
        ->and(File::exists(public_path('themes/luxury-01/uploads/2024/06/McBride-My-Valentine-Martina.mp3')))->toBeTrue();
});

test('new themes render with local assets and without remote invisimple links', function (string $slug, string $alias) {
    // 1. Canonical route
    $response = $this->get(route('demo.show', ['slug' => $slug]));
    $response->assertStatus(200);
    $content = $response->getContent();

    expect($content)->toContain("/themes/{$slug}/")
        ->not->toContain('https://the.invisimple.id/wp-content/')
        ->not->toContain('https://namabrand.invisimple.id/wp-content/');

    // 2. Alias route with dynamic query
    $aliasResponse = $this->get("/demo/{$alias}?to=Bpk.+Joko+Widodo&groom_nickname=Ryan&bride_nickname=Vanya");
    $aliasResponse->assertStatus(200)
        ->assertSee('Ryan')
        ->assertSee('Vanya')
        ->assertSee('Bpk. Joko Widodo');
})->with([
    ['luxury-02', 'l02'],
    ['luxury-07', 'l07'],
    ['3d-motion-07', 'm07'],
    ['3d-motion-10', 'm10'],
    ['3d-motion-27', 'm27'],
    ['3d-motion-47', 'm47'],
    ['3d-motion-49', 'm49'],
    ['3d-motion-55', 'm55'],
]);

test('local disk assets exist for all new themes', function (string $slug, string $sampleFile) {
    expect(File::exists(public_path("themes/{$slug}/uploads/{$sampleFile}")))->toBeTrue();
})->with([
    ['luxury-02', '2025/02/thumbnail-luxury-02-1.jpg'],
    ['luxury-07', '2026/06/thumbnail-luxury-07-rev.jpg'],
    ['3d-motion-07', '2026/01/preview-m07-reseller.jpg'],
    ['3d-motion-10', '2026/01/preview-m10-reseller.jpg'],
    ['3d-motion-27', '2026/01/preview-m27-reseller.jpg'],
    ['3d-motion-47', '2026/03/preview-m47-reseller-new.jpg'],
    ['3d-motion-49', '2026/03/preview-m49-reseller-new.jpg'],
    ['3d-motion-55', '2026/06/preview-m55-reseller.jpg'],
]);

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

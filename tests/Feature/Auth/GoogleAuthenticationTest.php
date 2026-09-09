<?php

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\User as SocialiteUser;

test('redirects to google oauth provider', function () {
    $redirectResponse = new RedirectResponse('https://accounts.google.com/o/oauth2/auth');

    $provider = Mockery::mock(GoogleProvider::class);
    $provider->shouldReceive('redirect')->once()->andReturn($redirectResponse);

    Socialite::shouldReceive('driver')->with('google')->once()->andReturn($provider);

    $response = $this->get(route('auth.google.redirect'));

    $response->assertRedirect('https://accounts.google.com/o/oauth2/auth');
});

test('registers and authenticates new user via google callback', function () {
    $googleUser = Mockery::mock(SocialiteUser::class);
    $googleUser->shouldReceive('getId')->andReturn('google-unique-id-123');
    $googleUser->shouldReceive('getName')->andReturn('Aditya Eko');
    $googleUser->shouldReceive('getNickname')->andReturn('aditya');
    $googleUser->shouldReceive('getEmail')->andReturn('aditya.new@example.com');
    $googleUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/photo.jpg');

    $provider = Mockery::mock(GoogleProvider::class);
    $provider->shouldReceive('user')->once()->andReturn($googleUser);

    Socialite::shouldReceive('driver')->with('google')->once()->andReturn($provider);

    $response = $this->get(route('auth.google.callback'));

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));

    $this->assertDatabaseHas('users', [
        'email' => 'aditya.new@example.com',
        'name' => 'Aditya Eko',
        'google_id' => 'google-unique-id-123',
        'avatar' => 'https://lh3.googleusercontent.com/photo.jpg',
        'role' => 'user',
        'status' => 'active',
    ]);
});

test('authenticates existing user with google_id via callback', function () {
    $existingUser = User::factory()->create([
        'email' => 'existing.google@example.com',
        'google_id' => 'google-existing-999',
        'status' => 'active',
    ]);

    $googleUser = Mockery::mock(SocialiteUser::class);
    $googleUser->shouldReceive('getId')->andReturn('google-existing-999');
    $googleUser->shouldReceive('getEmail')->andReturn('existing.google@example.com');
    $googleUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/newavatar.jpg');

    $provider = Mockery::mock(GoogleProvider::class);
    $provider->shouldReceive('user')->once()->andReturn($googleUser);

    Socialite::shouldReceive('driver')->with('google')->once()->andReturn($provider);

    $response = $this->get(route('auth.google.callback'));

    $this->assertAuthenticatedAs($existingUser);
    $response->assertRedirect(route('dashboard', absolute: false));

    expect(User::where('email', 'existing.google@example.com')->count())->toBe(1);
});

test('links google_id to existing user who registered with email and password', function () {
    $user = User::factory()->create([
        'email' => 'manual.registered@example.com',
        'google_id' => null,
        'status' => 'active',
    ]);

    $googleUser = Mockery::mock(SocialiteUser::class);
    $googleUser->shouldReceive('getId')->andReturn('google-link-777');
    $googleUser->shouldReceive('getEmail')->andReturn('manual.registered@example.com');
    $googleUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/avatar.jpg');

    $provider = Mockery::mock(GoogleProvider::class);
    $provider->shouldReceive('user')->once()->andReturn($googleUser);

    Socialite::shouldReceive('driver')->with('google')->once()->andReturn($provider);

    $response = $this->get(route('auth.google.callback'));

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect(route('dashboard', absolute: false));

    expect($user->fresh()->google_id)->toBe('google-link-777');
});

test('blocks suspended user from logging in via google callback', function () {
    $suspendedUser = User::factory()->create([
        'email' => 'suspended@example.com',
        'google_id' => 'google-suspended-000',
        'status' => 'suspended',
    ]);

    $googleUser = Mockery::mock(SocialiteUser::class);
    $googleUser->shouldReceive('getId')->andReturn('google-suspended-000');
    $googleUser->shouldReceive('getEmail')->andReturn('suspended@example.com');
    $googleUser->shouldReceive('getAvatar')->andReturn(null);

    $provider = Mockery::mock(GoogleProvider::class);
    $provider->shouldReceive('user')->once()->andReturn($googleUser);

    Socialite::shouldReceive('driver')->with('google')->once()->andReturn($provider);

    $response = $this->get(route('auth.google.callback'));

    $this->assertGuest();
    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors('email');
});

test('handles google oauth exception gracefully', function () {
    $provider = Mockery::mock(GoogleProvider::class);
    $provider->shouldReceive('user')->once()->andThrow(new Exception('OAuth access denied'));

    Socialite::shouldReceive('driver')->with('google')->once()->andReturn($provider);

    $response = $this->get(route('auth.google.callback'));

    $this->assertGuest();
    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors('email');
});

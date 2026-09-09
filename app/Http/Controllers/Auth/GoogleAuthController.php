<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and authenticate.
     */
    public function callback(): RedirectResponse
    {
        try {
            /** @var \Laravel\Socialite\Contracts\User $googleUser */
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            Log::warning('Google OAuth callback failed: '.$e->getMessage());

            return redirect()->route('login')->withErrors([
                'email' => 'Gagal masuk menggunakan Google. Silakan coba kembali atau gunakan login email.',
            ]);
        }

        $email = $googleUser->getEmail();
        $googleId = $googleUser->getId();

        if (! $email || ! $googleId) {
            return redirect()->route('login')->withErrors([
                'email' => 'Informasi email atau akun Google tidak valid.',
            ]);
        }

        // 1. Check if user exists by google_id
        $user = User::where('google_id', $googleId)->first();

        if (! $user) {
            // 2. Check if user exists with the same email
            $user = User::where('email', $email)->first();

            if ($user) {
                // Link Google account to existing user
                $user->google_id = $googleId;
                if (! $user->avatar && $googleUser->getAvatar()) {
                    $user->avatar = $googleUser->getAvatar();
                }
                if (! $user->email_verified_at) {
                    $user->email_verified_at = now();
                }
                $user->save();
            } else {
                // 3. Create a new user
                $name = $googleUser->getName() ?: ($googleUser->getNickname() ?: explode('@', $email)[0]);

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'google_id' => $googleId,
                    'avatar' => $googleUser->getAvatar(),
                    'password' => null,
                    'role' => 'user',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]);

                event(new Registered($user));
            }
        } else {
            // Refresh avatar if not set yet
            if (! $user->avatar && $googleUser->getAvatar()) {
                $user->avatar = $googleUser->getAvatar();
                $user->save();
            }
        }

        // Verify that user account is active
        if (! $user->isActive()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda sedang dinonaktifkan atau ditangguhkan. Silakan hubungi admin.',
            ]);
        }

        Auth::login($user, remember: true);
        request()->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}

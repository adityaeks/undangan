<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\WishController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicInvitationController;
use App\Http\Controllers\ThemeCatalogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome', [
        'themes' => ThemeCatalogController::getMasterThemes(),
    ]);
})->name('home');

// Official Dynamic Public Invitation Website
Route::get('/u/{slug}', [PublicInvitationController::class, 'show'])->name('invitation.show');
Route::post('/u/{slug}/wishes', [PublicInvitationController::class, 'storeWish'])->name('invitation.wish.store');

// Public Themes / Templates Catalog
Route::get('/tema', [ThemeCatalogController::class, 'index'])->name('themes.catalog');
Route::get('/templates', [ThemeCatalogController::class, 'index'])->name('templates.index');

Route::get('/demo', [DemoController::class, 'index'])->name('demo.index');
Route::get('/demo/{slug}', [DemoController::class, 'show'])->name('demo.show');

/*
|--------------------------------------------------------------------------
| Authenticated Admin & User Workspace Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/member/dashboard', [DashboardController::class, 'index'])->name('member.dashboard');

    // Invitations
    Route::get('/admin/invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::get('/admin/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/admin/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::delete('/admin/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');

    // Themes
    Route::get('/admin/themes', [ThemeController::class, 'index'])->name('themes.index');

    // Guests & RSVP
    Route::get('/admin/guests', [GuestController::class, 'index'])->name('guests.index');

    // Wishes / Guestbook
    Route::get('/admin/wishes', [WishController::class, 'index'])->name('wishes.index');

    // Partners / WO
    Route::get('/admin/partners', [PartnerController::class, 'index'])->name('partners.index');

    // Orders & Billing
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

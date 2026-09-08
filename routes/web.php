<?php

use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WishController;
use App\Http\Controllers\DashboardDispatcherController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\GuestController as MemberGuestController;
use App\Http\Controllers\Member\InvitationController as MemberInvitationController;
use App\Http\Controllers\Member\OrderController as MemberOrderController;
use App\Http\Controllers\Member\ThemeController as MemberThemeController;
use App\Http\Controllers\Member\WishController as MemberWishController;
use App\Http\Controllers\Order\CheckoutController;
use App\Http\Controllers\Partner\ClientController as PartnerClientController;
use App\Http\Controllers\Partner\DashboardController as PartnerDashboardController;
use App\Http\Controllers\Partner\GuestController as PartnerGuestController;
use App\Http\Controllers\Partner\InvitationController as PartnerInvitationController;
use App\Http\Controllers\Partner\PackageController as PartnerPackageController;
use App\Http\Controllers\Payment\WebhookController;
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

// Payment Webhook (Idempotent Notification Receiver)
Route::match(['GET', 'POST'], '/payment/webhook', [WebhookController::class, 'handle'])->name('payment.webhook');
Route::match(['GET', 'POST'], '/api/webhooks/midtrans', [WebhookController::class, 'handle'])->name('midtrans.webhook');
Route::match(['GET', 'POST'], '/api/webhook/midtrans', [WebhookController::class, 'handle']);

/*
|--------------------------------------------------------------------------
| Central Dashboard Dispatcher
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardDispatcherController::class)->name('dashboard');

    // Shared Orders & Checkout
    Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/success', [CheckoutController::class, 'success'])->name('orders.success');
    Route::get('/orders/{order}/invoice', [CheckoutController::class, 'invoice'])->name('orders.invoice');
    Route::post('/orders/{order}/coupon', [CheckoutController::class, 'applyCoupon'])->name('orders.coupon.apply');
    Route::delete('/orders/{order}/coupon', [CheckoutController::class, 'removeCoupon'])->name('orders.coupon.remove');
    Route::post('/orders/{order}/simulate', [CheckoutController::class, 'simulatePayment'])->name('orders.simulate');
    Route::get('/checkout/theme/{theme}', [CheckoutController::class, 'checkoutTheme'])->name('checkout.theme');
    Route::get('/checkout/package/{package}', [CheckoutController::class, 'checkoutPackage'])->name('checkout.package');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Member Workspace Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:member,user'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

    // Member Invitations
    Route::get('/invitations', [MemberInvitationController::class, 'index'])->name('invitations.index');
    Route::get('/invitations/create', [MemberInvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [MemberInvitationController::class, 'store'])->name('invitations.store');
    Route::delete('/invitations/{invitation}', [MemberInvitationController::class, 'destroy'])->name('invitations.destroy');

    // Member Themes
    Route::get('/themes', [MemberThemeController::class, 'index'])->name('themes.index');

    // Member Guests & WhatsApp
    Route::get('/guests', [MemberGuestController::class, 'index'])->name('guests.index');
    Route::post('/guests', [MemberGuestController::class, 'store'])->name('guests.store');
    Route::post('/guests/template', [MemberGuestController::class, 'updateTemplate'])->name('guests.template');
    Route::delete('/guests/{guest}', [MemberGuestController::class, 'destroy'])->name('guests.destroy');

    // Member Wishes / Guestbook
    Route::get('/wishes', [MemberWishController::class, 'index'])->name('wishes.index');

    // Member Orders / Billing
    Route::get('/orders', [MemberOrderController::class, 'index'])->name('orders.index');
});

/*
|--------------------------------------------------------------------------
| Partner Workspace Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:partner'])->prefix('partner')->name('partner.')->group(function () {
    Route::get('/dashboard', [PartnerDashboardController::class, 'index'])->name('dashboard');

    // Partner Clients
    Route::get('/clients', [PartnerClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [PartnerClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{client}', [PartnerClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [PartnerClientController::class, 'destroy'])->name('clients.destroy');

    // Partner Invitations
    Route::get('/invitations', [PartnerInvitationController::class, 'index'])->name('invitations.index');
    Route::get('/invitations/create', [PartnerInvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [PartnerInvitationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{invitation}/edit', [PartnerInvitationController::class, 'edit'])->name('invitations.edit');
    Route::put('/invitations/{invitation}', [PartnerInvitationController::class, 'update'])->name('invitations.update');
    Route::delete('/invitations/{invitation}', [PartnerInvitationController::class, 'destroy'])->name('invitations.destroy');

    // Partner Guests & WhatsApp Distribution
    Route::get('/guests', [PartnerGuestController::class, 'index'])->name('guests.index');
    Route::post('/guests', [PartnerGuestController::class, 'store'])->name('guests.store');
    Route::post('/guests/template', [PartnerGuestController::class, 'updateTemplate'])->name('guests.template');
    Route::delete('/guests/{guest}', [PartnerGuestController::class, 'destroy'])->name('guests.destroy');

    // Partner Packages & Quota
    Route::get('/packages', [PartnerPackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/{package}/select', [PartnerPackageController::class, 'select'])->name('packages.select');
});

/*
|--------------------------------------------------------------------------
| Admin Workspace Routes (Strictly Restricted to Super Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:super_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('admin.users.update-role');

    // Invitations Moderation
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::patch('/invitations/{invitation}/toggle', [InvitationController::class, 'togglePublish'])->name('admin.invitations.toggle');
    Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::delete('/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');

    // Coupons Management
    Route::get('/coupons', [AdminCouponController::class, 'index'])->name('admin.coupons.index');
    Route::post('/coupons', [AdminCouponController::class, 'store'])->name('admin.coupons.store');
    Route::patch('/coupons/{coupon}/toggle', [AdminCouponController::class, 'toggleActive'])->name('admin.coupons.toggle');
    Route::delete('/coupons/{coupon}', [AdminCouponController::class, 'destroy'])->name('admin.coupons.destroy');

    // Themes
    Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::post('/themes/pricing-settings', [ThemeController::class, 'updateGlobalPricing'])->name('admin.themes.pricing-settings');
    Route::patch('/themes/{theme}/toggle', [ThemeController::class, 'toggleActive'])->name('admin.themes.toggle');
    Route::patch('/themes/{theme}/toggle-partner', [ThemeController::class, 'togglePartner'])->name('admin.themes.toggle-partner');
    Route::patch('/themes/{theme}/price', [ThemeController::class, 'updatePrice'])->name('admin.themes.update-price');

    // Guests & RSVP (Lookup)
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');

    // Wishes / Guestbook Moderation
    Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::patch('/wishes/{wish}/toggle', [WishController::class, 'toggleApproval'])->name('admin.wishes.toggle');
    Route::delete('/wishes/{wish}', [WishController::class, 'destroy'])->name('admin.wishes.destroy');

    // Partners / WO & Package Management
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::put('/partners/packages/{package}', [PartnerController::class, 'updatePackage'])->name('admin.partners.packages.update');
    Route::patch('/partners/users/{user}/package', [PartnerController::class, 'updateUserPackage'])->name('admin.partners.users.package');

    // Orders & Billing
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';

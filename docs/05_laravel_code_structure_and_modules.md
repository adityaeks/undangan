# 05. Struktur Kode Laravel & Pembagian Modul (Code Structure & Modules)

Dokumen ini menjelaskan arsitektur kode aplikasi Laravel, pembagian namespace Controller berdasarkan peran dan domain, definisi 16 Model Eloquent dengan relasi lengkap, struktur Service Layer, Form Request, serta tata letak rute (*route organization*).

---

## 1. Daftar 16 Model Eloquent & Relasi Lengkap

Sistem dibangun di atas 16 Model yang modular tanpa menumpuk tanggung jawab pada satu model tertentu:

```
app/Models/
├── User.php
├── Package.php
├── Theme.php
├── Order.php
├── OrderItem.php
├── Payment.php
├── UserTheme.php
├── PartnerClient.php
├── Invitation.php               <-- Aggregate Root Model
├── InvitationSetting.php
├── InvitationCouple.php
├── InvitationEvent.php
├── InvitationStory.php
├── InvitationMedia.php
├── InvitationGift.php
├── InvitationGuest.php
└── InvitationWish.php
```

### Ringkasan Relasi Eloquent

```php
// 1. User.php
public function invitations(): HasMany { return $this->hasMany(Invitation::class, 'owner_id'); }
public function managedInvitations(): HasMany { return $this->hasMany(Invitation::class, 'partner_id'); }
public function orders(): HasMany { return $this->hasMany(Order::class); }
public function partnerClients(): HasMany { return $this->hasMany(PartnerClient::class, 'partner_id'); }
public function userThemes(): HasMany { return $this->hasMany(UserTheme::class); }
public function themes(): BelongsToMany { return $this->belongsToMany(Theme::class, 'user_themes')->withPivot(['purchased_price', 'acquired_at']); }

// 2. PartnerClient.php
public function partner(): BelongsTo { return $this->belongsTo(User::class, 'partner_id'); }
public function invitations(): HasMany { return $this->hasMany(Invitation::class, 'client_id'); }

// 3. Theme.php
public function invitations(): HasMany { return $this->hasMany(Invitation::class); }
public function userThemes(): HasMany { return $this->hasMany(UserTheme::class); }
public function orderItems(): HasMany { return $this->hasMany(OrderItem::class); }

// 4. UserTheme.php
public function user(): BelongsTo { return $this->belongsTo(User::class); }
public function theme(): BelongsTo { return $this->belongsTo(Theme::class); }
public function order(): BelongsTo { return $this->belongsTo(Order::class); }

// 5. Order.php
public function user(): BelongsTo { return $this->belongsTo(User::class); }
public function items(): HasMany { return $this->hasMany(OrderItem::class); }
public function payments(): HasMany { return $this->hasMany(Payment::class); }
public function userThemes(): HasMany { return $this->hasMany(UserTheme::class); }

// 6. OrderItem.php
public function order(): BelongsTo { return $this->belongsTo(Order::class); }
public function theme(): BelongsTo { return $this->belongsTo(Theme::class); }
public function package(): BelongsTo { return $this->belongsTo(Package::class); }

// 7. Payment.php
public function order(): BelongsTo { return $this->belongsTo(Order::class); }

// 8. Invitation.php (Aggregate Root)
public function owner(): BelongsTo { return $this->belongsTo(User::class, 'owner_id'); }
public function partner(): BelongsTo { return $this->belongsTo(User::class, 'partner_id'); }
public function client(): BelongsTo { return $this->belongsTo(PartnerClient::class, 'client_id'); }
public function theme(): BelongsTo { return $this->belongsTo(Theme::class); }
public function setting(): HasOne { return $this->hasOne(InvitationSetting::class); }
public function couple(): HasOne { return $this->hasOne(InvitationCouple::class); }
public function events(): HasMany { return $this->hasMany(InvitationEvent::class)->orderBy('date'); }
public function stories(): HasMany { return $this->hasMany(InvitationStory::class)->orderBy('sort_order'); }
public function media(): HasMany { return $this->hasMany(InvitationMedia::class)->orderBy('sort_order'); }
public function gifts(): HasMany { return $this->hasMany(InvitationGift::class); }
public function guests(): HasMany { return $this->hasMany(InvitationGuest::class); }
public function wishes(): HasMany { return $this->hasMany(InvitationWish::class)->latest(); }

// 9 - 16. Sub-Komponen Undangan (Invitation* Models)
// Masing-masing memiliki relasi balik:
public function invitation(): BelongsTo { return $this->belongsTo(Invitation::class); }
```

---

## 2. Pemisahan Namespace Controller (Anti-God Controller)

Untuk menghindari file `InvitationController` yang memuat ribuan baris kode (*monolithic controller*), pengontrol dibagi secara ketat berdasarkan domain peran (*Role*) dan sub-modul undangan (*Component Controllers*):

```
app/Http/Controllers/
├── Admin/                          # Khusus hak akses super_admin
│   ├── DashboardController.php
│   ├── ThemeController.php         # Manajemen template master & harga
│   ├── PackageController.php       # Manajemen paket layanan
│   ├── OrderController.php         # Audit transaksi platform
│   └── UserController.php          # Audit akun pengguna
│
├── Partner/                        # Khusus hak akses partner (WO / Agency)
│   ├── DashboardController.php
│   ├── ClientController.php        # CRUD klien pengantin (partner_clients)
│   ├── InvitationController.php    # Kelola undangan atas nama klien
│   └── OrderController.php         # Pembelian lisensi paket/tema partner
│
├── Member/                         # Khusus hak akses member (Calon Pengantin)
│   ├── DashboardController.php     # Portal mandiri pengantin & countdown
│   └── OrderController.php         # Riwayat pembelian lisensi tema member
│
├── Invitation/                     # Sub-controller modular per komponen undangan
│   ├── InvitationController.php    # Lifecycle (index, create, store, publish, archive)
│   ├── InvitationCoupleController.php  # Update data mempelai pria/wanita
│   ├── InvitationEventController.php   # CRUD sesi acara (Akad, Resepsi)
│   ├── InvitationStoryController.php   # CRUD linimasa cerita cinta
│   ├── InvitationMediaController.php   # Upload & kelola galeri foto/video
│   ├── InvitationGiftController.php    # Kelola rekening & QRIS amplop digital
│   ├── InvitationGuestController.php   # Kelola tamu & sebar pesan WhatsApp
│   └── InvitationWishController.php    # Moderasi ucapan selamat & doa
│
├── Order/
│   └── CheckoutController.php      # Form checkout & pembuatan invoice
│
├── Payment/
│   └── PaymentWebhookController.php # Webhook receiver (idempotent listener)
│
└── PublicInvitationController.php  # Rendering tampilan publik (/u/{slug})
```

---

## 3. Lapisan Layanan (Service Layer Architecture)

Operasi bisnis yang kompleks dipisahkan dari Controller ke Service Classes agar *reusable*, mudah diuji (*testable*), dan menjaga controller tetap ramping:

1. **`App\Services\InvitationService`**:
   - Menangani pembuatan undangan lengkap beserta default setting.
   - Pengecekan slug unik otomatis.
   - Publikasi dan pengarsipan undangan.
2. **`App\Services\ThemeOwnershipService`**:
   - Verifikasi hak akses tema pengguna (`canUseTheme()`).
   - Pemberian lisensi tema secara idempoten saat pesanan berstatus lunas (`grantThemeOwnershipFromOrder()`).
   - Penanganan klaim tema gratis.
3. **`App\Services\PaymentService`**:
   - Inisiasi transaksi ke Payment Gateway (Midtrans Snap).
   - Verifikasi checksum / signature callback webhook.
   - Sinkronisasi status order dan mutasi payment.

---

## 4. Validasi Data Terpusat (Form Requests)

Setiap request divalidasi dengan Form Request terpisah di `app/Http/Requests/`:

- `StoreInvitationRequest`: Memvalidasi judul, tipe acara, dan hak akses tema.
- `UpdateInvitationCoupleRequest`: Memvalidasi nama, gelar, akun Instagram, dan format file foto.
- `StoreInvitationEventRequest`: Memvalidasi tanggal acara, jam mulai/selesai, serta tautan Google Maps.
- `StoreInvitationGuestRequest`: Memvalidasi nomor telepon dan keunikan slug personal tamu.
- `CheckoutThemeRequest`: Memvalidasi ketersediaan tema aktif dan kesesuaian harga beli.

---

## 5. Tata Letak Rute Bersih (*Route Structure*)

Rute aplikasi dikelompokkan secara deklaratif berdasarkan peran dan prefix URL:

```php
// Rute Publik (Frontend & Undangan Digital)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tema', [PublicThemeController::class, 'index'])->name('themes.catalog');
Route::get('/u/{slug}', [PublicInvitationController::class, 'show'])->name('invitation.show');
Route::post('/u/{slug}/wishes', [PublicInvitationController::class, 'storeWish'])->name('invitation.wish.store');

// Webhook Pembayaran (Bebas CSRF)
Route::post('/webhook/payment', [PaymentWebhookController::class, 'handle'])->name('webhook.payment');

// Workspace Terotentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirect cerdas /dashboard sesuai role pengguna
    Route::get('/dashboard', [DashboardDispatcherController::class, 'index'])->name('dashboard');

    // Domain Super Admin
    Route::middleware('role:super_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('themes', Admin\ThemeController::class);
        Route::resource('packages', Admin\PackageController::class);
        Route::resource('orders', Admin\OrderController::class)->only(['index', 'show']);
        Route::resource('users', Admin\UserController::class);
    });

    // Domain Partner (Wedding Organizer)
    Route::middleware('role:partner')->prefix('partner')->name('partner.')->group(function () {
        Route::get('/dashboard', [Partner\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('clients', Partner\ClientController::class);
        Route::resource('invitations', Partner\InvitationController::class);
    });

    // Domain Member (Calon Pengantin)
    Route::middleware('role:member')->prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [Member\DashboardController::class, 'index'])->name('dashboard');
    });

    // Domain Modul Detail Undangan (Bisa diakses Member pemilik & Partner pengelola)
    Route::prefix('invitations/{invitation}')->name('invitations.')->group(function () {
        Route::resource('couple', Invitation\InvitationCoupleController::class)->only(['edit', 'update']);
        Route::resource('events', Invitation\InvitationEventController::class);
        Route::resource('stories', Invitation\InvitationStoryController::class);
        Route::resource('media', Invitation\InvitationMediaController::class);
        Route::resource('gifts', Invitation\InvitationGiftController::class);
        Route::resource('guests', Invitation\InvitationGuestController::class);
        Route::resource('wishes', Invitation\InvitationWishController::class)->only(['index', 'update', 'destroy']);
    });
});
```

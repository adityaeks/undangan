# 03. Pemetaan Data Lama ke Baru & Strategi Migrasi Aman

Dokumen ini berisi analisis mendalam mengenai struktur database eksisting, pemetaan field lama ke struktur baru (*schema mapping*), identifikasi risiko kehilangan data (*data loss risk*), serta rencana eksekusi migrasi bertahap tanpa downtime (*zero-downtime & zero-data-loss phased migration plan*).

---

## 1. Matriks Pemetaan Tabel (Legacy vs Restructured)

| Tabel Lama (Eksisting) | Tabel Baru (Restrukturisasi) | Tipe Transformasi | Keterangan & Rincian |
|---|---|:---:|---|
| `users` | `users` | **Modifikasi Kolom** | Tambah kolom `status`, update nilai enum role `'user'` menjadi `'member'`. |
| `themes` | `themes` | **Modifikasi Kolom** | Tambah kolom `price` (default 0.00). |
| *(Belum ada)* | `packages` | **Tabel Baru** | Paket layanan/kuota (Free, Premium, Partner Pro). |
| `orders` | `orders`, `order_items`, `payments` | **Normalisasi / Dekomposisi 1:N** | Pisahkan header order, rincian barang (`order_items`), dan pembayaran (`payments`). |
| *(Belum ada)* | `user_themes` | **Tabel Baru (Inventory)** | Wajib diisi (*backfill*) untuk seluruh pemilik undangan aktif agar hak akses tema tidak hilang. |
| *(Belum ada)* | `partner_clients` | **Tabel Baru** | Entitas klien di bawah pengelolaan Partner WO. |
| `invitations` | `invitations` + `invitation_settings` | **Dekomposisi 1:1** | `user_id` menjadi `owner_id`, `is_published` menjadi `status`, field media/quote dipindah ke `invitation_settings`. |
| `couples` | `invitation_couples` | **Rename & Standardisasi** | Nama tabel diseragamkan dengan prefix `invitation_`. |
| `events` | `invitation_events` | **Rename & Standardisasi** | Nama tabel diseragamkan dengan prefix `invitation_`. |
| `stories` | `invitation_stories` | **Rename & Transformasi Kolom** | `year_or_date` -> `display_date`, `order_position` -> `sort_order`. |
| `galleries` | `invitation_media` | **Rename & Transformasi Kolom** | `file_url` -> `url`, `order_position` -> `sort_order`, tambah `type`. |
| `wallets` | `invitation_gifts` | **Rename & Transformasi Kolom** | Tambah kolom `type` (`bank`, `qris`, `physical_gift`). |
| `guests` | `invitation_guests` | **Rename & Transformasi Kolom** | `phone_number` -> `phone`, `slug_url` -> `personal_slug`. |
| `wishes` | `invitation_wishes` | **Rename & Relasi Baru** | Tambah `guest_id` (nullable) untuk relasi ke data tamu. |

---

## 2. Pemetaan Lapangan Kolom per Kolom (Field-by-Field Mapping)

### 2.1. Tabel `users`
| Kolom Lama | Kolom Baru | Tipe Data Baru | Transformasi / Logika Migrasi |
|---|---|---|---|
| `id` | `id` | BIGINT UNSIGNED | Dipertahankan. |
| `name` | `name` | VARCHAR(255) | Dipertahankan. |
| `email` | `email` | VARCHAR(255) | Dipertahankan. |
| `password` | `password` | VARCHAR(255) | Dipertahankan. |
| `role` | `role` | VARCHAR(50) | Jika `role == 'user'`, ubah menjadi `'member'`. `super_admin` & `partner` dipertahankan. |
| *(Baru)* | `status` | VARCHAR(50) | Nilai default `'active'`. |
| `email_verified_at`| `email_verified_at`| TIMESTAMP | Dipertahankan. |
| `remember_token` | `remember_token` | VARCHAR(100) | Dipertahankan. |

---

### 2.2. Tabel `invitations` & `invitation_settings`
| Kolom Sumber (`invitations` lama) | Tabel & Kolom Tujuan | Transformasi Data |
|---|---|---|
| `id` | `invitations.id` | Dipertahankan. |
| `user_id` | `invitations.owner_id` | Rename kolom menjadi `owner_id`. |
| *(Baru)* | `invitations.partner_id` | Default `NULL`. |
| *(Baru)* | `invitations.client_id` | Default `NULL`. |
| `theme_id` | `invitations.theme_id` | Dipertahankan. |
| `title` | `invitations.title` | Dipertahankan. |
| `slug` | `invitations.slug` | Dipertahankan. |
| `event_type` | `invitations.event_type` | Dipertahankan. |
| `is_published` | `invitations.status` | Jika `is_published == 1` -> `'published'`, jika `0` -> `'draft'`. |
| *(Baru)* | `invitations.published_at` | Jika `is_published == 1`, isi dengan `created_at`. |
| `background_music` | `invitation_settings.music_url` | Dipindahkan ke tabel 1:1 `invitation_settings`. |
| `quote_text` | `invitation_settings.quote_text` | Dipindahkan ke tabel 1:1 `invitation_settings`. |
| `quote_source` | `invitation_settings.quote_source` | Dipindahkan ke tabel 1:1 `invitation_settings`. |
| `cover_image` | `invitation_settings.cover_image` | Dipindahkan ke tabel 1:1 `invitation_settings`. |
| `passcode` | `invitation_settings.passcode` | Dipindahkan ke tabel 1:1 `invitation_settings`. |
| *(Baru)* | `invitation_settings.is_private`| Jika `passcode != NULL` -> `true`, selain itu `false`. |

---

### 2.3. Transaksi: `orders` Lama -> `orders`, `order_items`, `payments`
| Kolom `orders` Lama | Tabel & Kolom Tujuan | Transformasi Data |
|---|---|---|
| `id` | `orders.id` | Dipertahankan. |
| `user_id` | `orders.user_id` | Dipertahankan. |
| `order_code` | `orders.order_number` | Rename kolom menjadi `order_number`. |
| `amount` | `orders.subtotal`, `orders.total` | `subtotal = amount`, `discount = 0.00`, `total = amount`. |
| `payment_status` | `orders.status` | Nilai status: `pending`, `paid`, `failed`, `expired`. |
| *(Ekstraksi Item)* | `order_items` | Buat 1 baris item baru: `item_type = 'package'`, `item_name = package_type`, `price = amount`, `quantity = 1`, `subtotal = amount`. |
| *(Ekstraksi Payment)* | `payments` | Jika terdapat riwayat pembayaran, buat baris pada `payments`: `amount = amount`, `method = payment_method`, `status = payment_status`, `paid_at = paid_at`. |

---

### 2.4. `couples` -> `invitation_couples`
- Seluruh kolom (`invitation_id`, `groom_*`, `bride_*`) dipindahkan 1-to-1 ke `invitation_couples`.

### 2.5. `events` -> `invitation_events`
- Seluruh kolom (`invitation_id`, `title`, `date`, `start_time`, `end_time`, `timezone`, `venue_name`, `address`, `google_maps_url`, `calendar_url` -> `google_calendar_url`) dipetakan 1-to-1.

### 2.6. `stories` -> `invitation_stories`
- `year_or_date` -> `display_date`
- `title` -> `title`
- `description` -> `description`
- `image` -> `image`
- `order_position` -> `sort_order`

### 2.7. `galleries` -> `invitation_media`
- `media_type` -> `type` (`image` atau `video`)
- `file_url` -> `url`
- `caption` -> `caption`
- `order_position` -> `sort_order`

### 2.8. `wallets` -> `invitation_gifts`
- `bank_name` -> `bank_name`
- `account_number` -> `account_number`
- `account_name` -> `account_name`
- `qris_image` -> `qris_image`
- `gift_address` -> `gift_address`
- Kolom baru `type`: diisi otomatis berdasarkan keberadaan data (`'qris'` jika ada `qris_image`, `'physical_gift'` jika ada `gift_address`, sisanya `'bank'`).

### 2.9. `guests` -> `invitation_guests`
- `phone_number` -> `phone`
- `slug_url` -> `personal_slug`
- Field lainnya (`name`, `group`, `attendance_status`, `pax_confirmed`) dipetakan 1-to-1.

### 2.10. `wishes` -> `invitation_wishes`
- Kolom baru `guest_id`: Diisi `NULL` untuk data lama (atau dicari berdasarkan kesamaan nama tamu jika diperlukan).
- Field lainnya (`guest_name`, `attendance`, `message`, `is_hidden`) dipetakan 1-to-1.

---

## 3. Identifikasi Risiko & Mitigasi Kehilangan Data

| Potensi Risiko | Tingkat Keparahan | Skenario Masalah | Tindakan Mitigasi yang Diambil |
|---|:---:|---|---|
| **Akses Tema Terkunci untuk User Eksisting** | **KRITIS** | Sistem baru mewajibkan `user_themes`. Jika data lama belum ada di `user_themes`, user lama tidak bisa mengedit atau melihat undangannya. | **Backfill Otomatis**: Buat record `user_themes` untuk semua kombinasi `(invitations.user_id, invitations.theme_id)` yang sudah ada di database saat migrasi berjalan. |
| **Foreign Key Constraint Failure** | **TINGGI** | Menghapus atau me-rename tabel lama saat proses query sedang berlangsung dapat menyebabkan *fatal error*. | **Metode Non-Destruktif**: Buat tabel-tabel baru terlebih dahulu, salin data, verifikasi kecocokan baris, baru alihkan kode Laravel. Tabel lama jangan di-*drop* langsung. |
| **Slug Duplikasi / Tabrakan** | **SEDANG** | Nilai `slug` publik berubah atau bentrok sehingga tautan undangan yang sudah disebar menjadi 404. | Kolom `slug` disalin tanpa manipulasi nilai string, dan indeks `UNIQUE` tetap dipertahankan. |
| **Perubahan Enum Role (`user` -> `member`)** | **SEDANG** | Middleware atau controller yang masih memeriksa `$user->role === 'user'` akan gagal otorisasi. | Sediakan accessor backward-compatible di model `User`: `public function isUser(): bool { return in_array($this->role, ['user', 'member']); }`. |

---

## 4. Rencana Migrasi 4 Fase (Phased Execution Plan)

### Fase 1: Pembuatan Skema Baru (Additive Only)
1. Buat migration file baru untuk tabel:
   - `packages`
   - `user_themes`
   - `partner_clients`
   - `invitation_settings`
   - `invitation_couples`
   - `invitation_events`
   - `invitation_stories`
   - `invitation_media`
   - `invitation_gifts`
   - `invitation_guests`
   - `invitation_wishes`
   - Penyesuaian kolom pada `users` (`status`) dan `themes` (`price`).
2. *PENTING*: Tabel lama (`couples`, `events`, `stories`, `galleries`, `wallets`, `guests`, `wishes`) **TETAP ADA** dan tidak disentuh pada fase ini.

### Fase 2: Skrip ETL & Data Migration (Artisan Command)
Buat command Artisan khusus: `php artisan app:migrate-to-modular-schema`:
```php
// Cuplikan Logika Migrasi Data Aman:
DB::transaction(function () {
    // 1. Update role user 'user' -> 'member'
    User::where('role', 'user')->update(['role' => 'member', 'status' => 'active']);

    // 2. Salin data invitations -> invitations baru & invitation_settings
    // 3. Salin couples -> invitation_couples
    // 4. Salin events -> invitation_events
    // 5. Salin stories -> invitation_stories
    // 6. Salin galleries -> invitation_media
    // 7. Salin wallets -> invitation_gifts
    // 8. Salin guests -> invitation_guests
    // 9. Salin wishes -> invitation_wishes

    // 10. Backfill user_themes untuk seluruh undangan eksisting (Krusial!)
    $invitations = DB::table('invitations')->get();
    foreach ($invitations as $inv) {
        DB::table('user_themes')->updateOrInsert(
            ['user_id' => $inv->user_id, 'theme_id' => $inv->theme_id],
            ['purchased_price' => 0.00, 'acquired_at' => now(), 'created_at' => now(), 'updated_at' => now()]
        );
    }
});
```

### Fase 3: Pembaruan Model Eloquent & Controller
1. Buat model modular baru (`InvitationCouple`, `InvitationEvent`, dll.).
2. Update relasi pada model `Invitation` dan `User`.
3. Jalankan automated test suite untuk memastikan seluruh rute dan assertion lulus 100%.

### Fase 4: Pembersihan Tabel Warisan (Legacy Cleanup)
Setelah seluruh fitur teruji, terverifikasi di browser, dan berjalan normal:
1. Buat migration penutupan untuk melepaskan foreign key lama.
2. Hapus tabel lama: `couples`, `events`, `stories`, `galleries`, `wallets`, `guests`, `wishes`.

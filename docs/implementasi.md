# Rencana & Status Implementasi Proyek KalaUndangan (Platform Undangan Digital)

Dokumen ini mencatat ringkasan status pengerjaan sistem, analisis fitur yang masih kurang (gap analysis), serta peta jalan (roadmap) langkah-langkah pengembangan yang akan dikerjakan selanjutnya.

---

## 📌 1. Status Pengerjaan Saat Ini (Current Progress)

| Modul / Komponen | Status | Keterangan |
| :--- | :---: | :--- |
| **Landing / Welcome Page** | ✅ Selesai | Desain minimalis & stylist, hero section interaktif, filter galeri tema, simulasi kustom nama tamu, kalkulator penghematan, paket harga, testimoni, FAQ, dan modal live preview. |
| **Desain & Aset Visual** | ✅ Selesai | Menggunakan Google Fonts (*Playfair Display*, *Cormorant Garamond*, *Plus Jakarta Sans*), Lucide Icons, dan Alpine.js untuk micro-interactions. |
| **Autentikasi Pengguna** | ⚠️ Dasar (Breeze) | Route login, register, dan dashboard dasar Laravel sudah tersedia. |
| **Struktur Database Awal** | ⚠️ Standar | Migrasi dasar `users`, `cache`, dan `jobs` sudah berjalan. |

---

## 🔍 2. Fitur & Komponen yang Masih Kurang (Gap Analysis)

Untuk menjadikan aplikasi ini sebagai platform penyedia website undangan digital (SaaS) yang berfungsi penuh (end-to-end), berikut adalah daftar komponen penting yang **masih perlu dibuat**:

### A. Skema Database & Model Eloquent (Backend)
- [ ] **Tabel `themes` / Template**: Menyimpan metadata tema (nama, slug, thumbnail, warna aksen, kategori, file view template blade).
- [ ] **Tabel `invitations`**: Menyimpan data utama undangan (user_id, theme_id, slug, judul, tipe_acara: pernikahan/khitanan/ultah, status_publikasi, password_undangan, tanggal_kadaluarsa).
- [ ] **Tabel `couples` / Mempelai**: Data pria & wanita (nama lengkap, panggilan, nama orang tua, akun IG, foto).
- [ ] **Tabel `events` / Rangkaian Acara**: Data akad/pemberkatan & resepsi (nama acara, tanggal, jam mulai-selesai, zona waktu, nama lokasi/gedung, alamat lengkap, link Google Maps).
- [ ] **Tabel `guests` / Buku Tamu & RSVP**: Daftar tamu khusus (nama_tamu, no_wa, slug_tamu, status_kehadiran: hadir/tidak/ragu, jumlah_kehadiran, ucapan_doa, status_terkirim).
- [ ] **Tabel `galleries` & `stories`**: Foto prewedding, video youtube/vimeo, dan timeline perjalanan cinta (*love story*).
- [ ] **Tabel `wallets` / Amplop Digital**: Nomor rekening bank (BCA, Mandiri, BRI, BNI), QRIS image, alamat penerima kado fisik.
- [ ] **Tabel `musics`**: Pilihan file musik latar (audio URL / title / artist).
- [ ] **Tabel `orders` / Transaksi**: Data pembelian paket (Silver, Gold, Platinum), status pembayaran (unpaid, paid, expired), bukti transfer/integrasi Midtrans.

---

### B. Halaman Dashboard Pengguna (User Dashboard & Builder)
- [ ] **Manajemen Undangan (CRUD)**:
  - Form Wizard Multi-Step pembuatan undangan (Pilih Tema ➡️ Data Mempelai ➡️ Detail Acara ➡️ Galeri & Musik ➡️ Amplop Digital ➡️ Review & Publish).
- [ ] **Manajemen Daftar Tamu & WhatsApp Generator**:
  - Fitur tambah nama tamu (satuan atau impor file Excel/CSV).
  - Generator teks undangan personal WhatsApp beserta tombol 1-klik kirim ke WA tamu (`https://api.whatsapp.com/send?phone=...&text=...`).
- [ ] **Buku Tamu & Rekap RSVP Real-time**:
  - Tabel rekapitulasi konfirmasi kehadiran (Hadir, Tidak Hadir, Belum Konfirmasi) untuk estimasi porsi catering.
  - Moderasi ucapan & doa restu (bisa menyembunyikan ucapan spam).
- [ ] **Pengaturan Akun & Profil**:
  - Ganti password, kelola nomor WhatsApp notifikasi, dan histori transaksi.

---

### C. Halaman Publik Undangan Digital (`/u/{slug}`)
- [ ] **Sistem Routing Template Dinamis**:
  - Route: `Route::get('/u/{slug}', [PublicInvitationController::class, 'show'])`
  - Dukungan parameter tamu: `/u/{slug}?to=Nama+Tamu`
- [ ] **Komponen Interaktif di Undangan Tamu**:
  - Tombol **"Buka Undangan"** dengan efek transisi cover & autoplay musik.
  - Floating Music Controller (Play / Pause).
  - Floating Bottom Navigation Bar (Cover, Mempelai, Acara, Galeri, Kisah Cinta, Ucapan/RSVP, Amplop).
  - Form RSVP & Kirim Ucapan Doa langsung simpan ke database tanpa refresh page (AJAX / Livewire / Fetch API).
  - Fitur Salin Nomor Rekening (Clipboard Copy) & Popup QRIS Amplop.
  - Tombol Tambahkan ke Google Calendar.
  - Navigasi Google Maps terintegrasi.
  - Countdown Timer dinamis sesuai tanggal akad/resepsi.

---

### D. Panel Admin / Master Pengelola (Superadmin)
- [ ] Manajemen User & Undangan Aktif.
- [ ] Manajemen Tema & Template Baru.
- [ ] Konfirmasi Pembayaran Manual / Verifikasi Paket.
- [ ] Pengaturan Pengumuman & Kode Promo / Diskon.

---

## 🚀 3. Rencana Pengerjaan Besok (Action Plan: Next Steps)

Berikut adalah urutan langkah pengembangan terstruktur yang direkomendasikan untuk dikerjakan besok:

### 🎯 Tahap 1: Pembuatan Database & Model (Fondasi Backend)
1. Membuat file migrasi database:
   - `create_themes_table`
   - `create_invitations_table`
   - `create_couples_table`
   - `create_events_table`
   - `create_guests_table`
   - `create_galleries_table`
   - `create_wallets_table`
   - `create_wishes_table` (Ucapan & RSVP)
2. Membuat Model Eloquent dan mendefinisikan relasi (`hasOne`, `hasMany`, `belongsTo`).
3. Membuat Seeder Tema Dasar (`ThemeSeeder`) untuk memasukkan data template awal.

### 🎯 Tahap 2: Halaman Undangan Publik (Public Invitation Renderer)
1. Membuat `PublicInvitationController` untuk menangani slug undangan dan pembacaan nama tamu dari URL (`?to=...`).
2. Membuat minimal **1 Master Template Undangan Lengkap** (misal: `resources/views/templates/monochrome-luxury.blade.php` atau `sage-botanical.blade.php`).
3. Mengimplementasikan interaktivitas:
   - Tombol buka undangan & trigger audio autoplay.
   - Form submit RSVP & ucapan doa (simpan ke database).
   - Salin nomor rekening & navigasi peta.

### 🎯 Tahap 3: Halaman Dashboard & Form Buat Undangan (User Builder)
1. Mempercantik tampilan `dashboard.blade.php` dengan tema minimalis konsisten.
2. Membuat Form Wizard Pengisian Undangan:
   - Tab 1: Pilih Tema & Judul Undangan.
   - Tab 2: Data Mempelai Pria & Wanita.
   - Tab 3: Rangkaian Acara (Akad & Resepsi) + Lokasi Maps.
   - Tab 4: Galeri Foto & Musik.
   - Tab 5: Data Rekening Amplop Digital.
3. Halaman Kelola Tamu Undangan (Generate link undangan WhatsApp personal).

### 🎯 Tahap 4: Integrasi & Pengujian Alur Penuh
1. Uji coba pembuatan undangan dari akun baru hingga menghasilkan URL publik.
2. Uji coba kirim RSVP dari smartphone & pastikan data masuk ke dashboard secara real-time.

---

## 🛠️ 4. Panduan Struktur File yang Direncanakan

```text
undangan/
├── app/
│   ├── Http/Controllers/
│   │   ├── InvitationController.php      # Controller Dashboard User
│   │   ├── GuestController.php           # Controller Buku Tamu & RSVP
│   │   └── PublicInvitationController.php# Controller Halaman Tamu Publik
│   └── Models/
│       ├── Invitation.php
│       ├── Couple.php
│       ├── Event.php
│       ├── Guest.php
│       ├── Gallery.php
│       ├── Wallet.php
│       └── Wish.php
├── database/
│   ├── migrations/                       # File skema database lengkap
│   └── seeders/
│       └── ThemeSeeder.php
├── resources/views/
│   ├── welcome.blade.php                 # Landing page (Sudah selesai)
│   ├── dashboard.blade.php               # Dashboard ringkasan user
│   ├── invitations/
│   │   ├── index.blade.php               # Daftar undangan milik user
│   │   ├── create.blade.php              # Form wizard pembuatan undangan
│   │   ├── edit.blade.php                # Form edit detail undangan
│   │   └── guests.blade.php              # Manajemen tamu & WhatsApp blaster
│   └── templates/
│       ├── layouts/invitation.blade.php  # Base layout undangan mobile
│       ├── monochrome-elegance.blade.php # Template 1
│       └── sage-botanical.blade.php      # Template 2
└── docs/
    ├── implementasi.md                   # Dokumen status & rencana ini
    └── database_schema.md                # Detail relasi tabel
```

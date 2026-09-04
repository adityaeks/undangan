# Rencana & Status Implementasi Proyek KalaUndangan (Platform Undangan Digital)

Dokumen ini mencatat ringkasan status pengerjaan sistem, analisis fitur, skema database backend yang telah selesai, serta peta jalan (roadmap) langkah-langkah pengembangan yang sedang dan akan dikerjakan.

---

## 📌 1. Status Pengerjaan Saat Ini (Current Progress)

| Modul / Komponen | Status | Keterangan |
| :--- | :---: | :--- |
| **Public Dynamic Invitation Website (`/u/{slug}`)** | ✅ Selesai | **Render Data 100% Dinamis & Otentik**: Website undangan publik kini langsung mengambil data asli dari database (`invitations`, `couples`, `events`, `galleries`, `wallets`, `wishes`). Menampilkan nama mempelai asli, foto profil, foto cover, musik latar kustom, rangkaian acara akad & resepsi, nomor rekening amplop transfer, dan formulir RSVP/Doa Restu interaktif dengan API AJAX `POST /u/{slug}/wishes`. |
| **Landing / Welcome Page** | ✅ Selesai | Desain minimalis & stylist, showcase 3 seri tema desain utama (*Vogue Editorial, Botanical Glassmorphism, Timeless Classic Card*), alur personal (pilih & beli template Rp 49k), section Kemitraan Join Partner (WO / Vendor), testimoni, FAQ. |
| **Multi-Theme & Multi-Layout Engine (`/demo`)** | ✅ Selesai | Menyediakan **3 Seri Arsitektur Layout & Desain Berbeda**:<br>1. **The Vogue Editorial Issue (`/demo?layout=editorial`)**: Layout cover majalah mode mewah, Bento Grid rangkaian acara & panduan dress code, horizontal story timeline card deck, masonry gallery, dan Floating Dynamic Island audio controller.<br>2. **The Ethereal Botanical Glass (`/demo?layout=botanical`)**: Layout bingkai lengkung arsitektural (*arch geometry*), kartu kaca buram transparan (*frosted glass*), piringan hitam audio vinyl, dan ornamen daun alami.<br>3. **The Timeless Classic Card (`/demo?layout=classic`)**: Layout kartu vertikal simetris, countdown timer card, amplop pop-up, dan floating bottom navigation dock.<br>Semua tema mendukung kustomisasi preset visual (*Minimalist, Botanical, Luxury, Romantic, Nusantara, Modern Dark*). |
| **Admin Katalog Tema Terpadu (`/admin/themes`)** | ✅ Selesai | Halaman katalog tema menampilkan **3 Seri Master Theme Cards** dengan **Interactive Style & Color Customizer** pada setiap kartu (palet warna, tipografi, serta tombol preview & buat undangan reaktif). |
| **Form Wizard & Unggah Media Undangan (`/admin/invitations/create`)** | ✅ Selesai | **Formulir 5 Langkah Terpadu**: Dilengkapi unggah foto cover utama, foto profil mempelai pria & wanita, **multi-upload album galeri foto prewedding** dengan live image previews, **pilihan lagu instrumen romantis siap pakai** + **unggah berkas MP3 kustom sendiri**, serta **fitur tes putar lagu (*audio preview player*)** interaktif di dalam form. Data tersimpan ke storage publik dan tabel `invitations`, `couples`, `events`, `galleries`, `wallets`, dan `guests`. |
| **Autentikasi Pengguna & Role** | ✅ Selesai | Layout Split-Screen Editorial (`login`, `register`, `forgot-password`, `reset-password`, dll.), migrasi role pengguna (`super_admin`, `partner`, `user`), akun default Super Admin (`admin@kalaundangan.com`), dan artisan command `php artisan make:super-admin`. |
| **Layout Modular (Guest & Admin)** | ✅ Selesai | `layouts/guest/` (app, navbar, footer) & `layouts/admin/` (app, sidebar, navbar, footer) terpisah rapi dengan dukungan responsive mobile drawer. |
| **Dashboard Admin Workspace** | ✅ Selesai | Banner sambutan pengguna, 4 kartu metrik utama, tabel monitoring undangan, quick actions grid, dan live feed ucapan tamu. |
| **Struktur Database & Model Backend** | ✅ Selesai | 11 tabel migrasi, model Eloquent lengkap dengan relasi, serta database seeders (`ThemeSeeder`, `InvitationSeeder`, `SuperAdminSeeder`). |
| **Halaman-Halaman Sidebar Admin** | ✅ Selesai | Rute & view lengkap untuk Daftar Undangan (`/admin/invitations`), Form Buat Undangan (`/admin/invitations/create`), Katalog Tema & Konsep Gaya (`/admin/themes`), Buku Tamu & WhatsApp Blaster (`/admin/guests`), Moderasi Doa Restu (`/admin/wishes`), Kemitraan WO (`/admin/partners`), dan Riwayat Transaksi (`/admin/orders`). |

---

## 🗄️ 2. Skema Entitas & Model Backend yang Telah Aktif

Semua tabel migrasi dan model Eloquent telah berhasil dibuat dan terintegrasi di database:

1. **`Theme` (`themes`)**: Master tema & konfigurasi gaya template (Monochrome, Botanical, Luxury, Romance, Nusantara, Midnight).
2. **`Invitation` (`invitations`)**: Record master undangan digital (slug, tema/gaya, layout, tanggal, musik, kutipan doa, status publikasi).
3. **`Couple` (`couples`)**: Data lengkap mempelai pria & wanita (nama, panggilan, orang tua, instagram, foto).
4. **`Event` (`events`)**: Rangkaian agenda acara (Akad Nikah, Resepsi, Pemberkatan, lokasi Google Maps, kalender). Kolom `start_time` dan `end_time` fleksibel bertipe string (`VARCHAR`).
5. **`Story` (`stories`)**: Milestones timeline perjalanan cinta (*love story*).
6. **`Gallery` (`galleries`)**: Album foto prewedding dan video sinematik.
7. **`Wallet` (`wallets`)**: Nomor rekening amplop digital (BCA, Mandiri, BRI, QRIS) dan alamat kado fisik.
8. **`Guest` (`guests`)**: Daftar tamu terundang, grup (VIP/Keluarga), custom slug URL, status kehadiran, dan pax konfirmasi.
9. **`Wish` (`wishes`)**: Buku tamu, ucapan selamat, doa restu, dan status kehadiran real-time.
10. **`Order` (`orders`)**: Transaksi pembelian template personal dan paket kemitraan reseller WO.

---

## 🚀 3. Peta Jalan Pengembangan Berikutnya (Next Roadmap)

### 🎯 Tahap 4: Modul Kemitraan Wedding Organizer & Pembayaran
- [ ] Manajemen kuota undangan reseller bagi akun partner WO.
- [ ] Pengaturan White-Label (kustom subdomain dan logo WO).
- [ ] Integrasi Payment Gateway / Konfirmasi Pembayaran otomatis.

# Dokumentasi Arsitektur & Refaktor Platform KlikMomen

Selamat datang di repositori dokumentasi resmi perancangan ulang (*system refactoring & modular restructuring*) platform undangan digital **KlikMomen**. 

Dokumen ini disusun sebagai cetak biru teknis (*technical blueprint*) sebelum eksekusi migrasi kode dan database dilakukan, guna memastikan sistem baru bersifat **modular, scalable, mudah di-maintenance**, dan memiliki **zero-data-loss guarantee**.

---

## 📑 Daftar Dokumen Arsitektur & Spesifikasi Teknis

Berikut adalah struktur dokumen lengkap yang tersedia di folder `docs/`:

| File Dokumen | Topik & Cakupan Teknis |
|---|---|
| **[01. Arsitektur Sistem & Peran Pengguna](01_system_architecture_and_roles.md)** | • Konsep `Invitation` sebagai Aggregate Root utama.<br>• 3 Role pengguna: `super_admin`, `partner`, dan `member`.<br>• Matriks hak akses (*Access Control Matrix*) & batasan domain. |
| **[02. Spesifikasi Skema Database & ERD](02_database_schema_and_erd.md)** | • Diagram ERD visual (Mermaid).<br>• Definisi 17 tabel lengkap (tipe data, nullable, default, foreign key).<br>• Standardisasi prefix `invitation_*` & indeks performa tinggi. |
| **[03. Pemetaan Data & Strategi Migrasi Aman](03_data_mapping_and_migration_strategy.md)** | • Analisis skema eksisting vs skema baru (*field-by-field mapping*).<br>• Identifikasi risiko kehilangan data (*data loss mitigation*).<br>• Rencana migrasi bertahap 4 fase & skrip backfill `user_themes`. |
| **[04. Alur Transaksi, Pembayaran & Kepemilikan Tema](04_theme_commerce_and_ownership_flow.md)** | • Pemisahan tanggung jawab: `orders`, `order_items`, `payments`, dan `user_themes`.<br>• Mekanisme *price snapshotting* pada `order_items.price`.<br>• Alur webhook pembayaran yang idempoten (anti-duplikasi).<br>• Mekanisme tema gratis & validasi hak akses saat memilih tema. |
| **[05. Struktur Kode Laravel & Pembagian Modul](05_laravel_code_structure_and_modules.md)** | • 16 Model Eloquent modular beserta definisi relasi lengkap.<br>• Dekomposisi Controller per domain peran (`Admin/*`, `Partner/*`, `Member/*`) dan per komponen (`Invitation/*`).<br>• Lapisan Service Layer, Form Request terpisah, dan arsitektur rute deklaratif. |

---

## 🏛️ Ringkasan Inti Restrukturisasi

1. **Pemisahan Transaksi & Inventori**:
   - `orders` = Kontrak transaksi bisnis.
   - `order_items` = Snapshot harga dan produk yang dibeli.
   - `payments` = Mutasi pembayaran finansial / gateway.
   - `user_themes` = **Satu-satunya sumber kebenaran** penentu apakah pengguna berhak menggunakan tema tertentu.

2. **Invitation sebagai Aggregate Root**:
   - Menghapus beban dari model `Invitation` raksasa dengan membagi detail acara ke tabel mandiri: `invitation_settings`, `invitation_couples`, `invitation_events`, `invitation_stories`, `invitation_media`, `invitation_gifts`, `invitation_guests`, dan `invitation_wishes`.
   - Mengganti status boolean `is_published` dengan enum yang lebih ekspresif: `draft`, `published`, dan `archived`.

3. **Multi-Role & Partner Agency Support**:
   - Memfasilitasi Wedding Organizer (`partner`) untuk mengelola banyak klien (`partner_clients`) menggunakan tema inventori yang dimilikinya.

---

> [!NOTE]
> Seluruh perancangan dalam folder `docs/` ini telah diverifikasi terhadap kebutuhan bisnis dan siap dijadikan acuan implementasi bertahap pada codebase Laravel.

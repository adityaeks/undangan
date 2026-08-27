# Dokumentasi Proyek KalaUndangan

Selamat datang di repositori dokumentasi **KalaUndangan** - Studio Platform Undangan Digital Minimalis & Stylist berbasis Laravel.

---

## 📑 Daftar Isi Dokumen

1. **[Rencana & Status Implementasi (implementasi.md)](implementasi.md)**
   - Status pengerjaan saat ini (Landing page, Auth).
   - Analisis fitur yang masih kurang (*gap analysis*).
   - Rencana pengerjaan besok (*step-by-step action plan*).
   - Arsitektur & struktur folder yang direncanakan.

2. **[Spesifikasi Skema Database (database_schema.md)](database_schema.md)**
   - Diagram Relasi Entitas (ERD).
   - Definisi tabel lengkap (`themes`, `invitations`, `couples`, `events`, `guests`, `wishes`, `wallets`, `galleries`, `stories`).
   - Tipe data, relasi foreign keys, dan indeks.

---

## 🚀 Menjalankan Project

```bash
# Menjalankan local server
php artisan serve

# Menjalankan build asset Vite
npm run dev

# Menjalankan migrasi database
php artisan migrate
```

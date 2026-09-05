# 01. Arsitektur Sistem & Peran Pengguna (Roles & Permissions)

Dokumen ini menjelaskan arsitektur tingkat tinggi platform undangan digital **KlikMomen**, pembagian peran (*user roles*), batasan domain, serta penerapan pola **Aggregate Root** pada entitas `Invitation`.

---

## 1. Konsep Arsitektur Utama: Invitation sebagai Aggregate Root

Dalam perancangan ulang sistem ini, **`Invitation`** diposisikan sebagai **Aggregate Root** (entitas sentral). Seluruh informasi terkait pernikahan atau acara tidak berdiri sendiri, melainkan terikat langsung dengan siklus hidup (*lifecycle*) dari sebuah `Invitation`:

```
                    ┌─────────────────────────┐
                    │          USER           │
                    │ (owner / partner / adm) │
                    └────────────┬────────────┘
                                 │ 1:N
                                 ▼
                    ┌─────────────────────────┐
                    │       INVITATION        │ ◄── [AGGREGATE ROOT]
                    │  (status, slug, theme)  │
                    └────────────┬────────────┘
       ┌──────────────┬──────────┼──────────┬──────────────┐
       ▼              ▼          ▼          ▼              ▼
┌──────────────┐┌──────────┐┌──────────┐┌──────────┐┌──────────────┐
│   Settings   ││  Couple  ││  Events  ││ Stories  ││ Media/Gallery│
└──────────────┘└──────────┘└──────────┘└──────────┘└──────────────┘
       ▼              ▼          ▼
┌──────────────┐┌──────────┐┌──────────┐
│    Gifts     ││  Guests  ││  Wishes  │
└──────────────┘└──────────┘└──────────┘
```

### Prinsip Desain Aggregate Root:
1. **Integritas Data Terpusat**: Operasi modifikasi data acara (profil mempelai, agenda akad/resepsi, galeri foto, rekening kado, tamu RSVP) selalu divalidasi terhadap hak kepemilikan `invitations.owner_id` atau hak kelola `invitations.partner_id`.
2. **Kemandirian Modul**: Setiap aspek undangan dipisahkan ke dalam tabel ber-prefix `invitation_*` agar konteks domain jelas dan tabel utama `invitations` tetap ringkas serta berperforma tinggi.
3. **Cascading Lifecycle**: Penghapusan atau pengarsipan undangan (`status = archived`) secara otomatis memengaruhi seluruh entitas anak di bawahnya secara konsisten melalui *foreign key cascade*.

---

## 2. Definisi & Batasan 3 Peran Utama (Roles)

Sistem membedakan hak akses dan alur kerja ke dalam 3 peran (*roles*):

| Role | Identifikasi (`users.role`) | Lingkup Akses & Wewenang |
|---|---|---|
| **Super Admin** | `super_admin` | Mengontrol seluruh platform, manajemen template katalog tema (`themes`), pengelolaan paket (`packages`), monitoring seluruh transaksi (`orders`, `payments`), audit user, dan moderasi global. |
| **Partner** | `partner` | Wedding Organizer (WO), agency, atau reseller. Dapat mengelola banyak klien (`partner_clients`), membeli lisensi tema/paket, membuat dan mengelola undangan atas nama klien, serta memantau status pembayaran kliennya. |
| **Member** | `member` | Pengguna akhir (calon pengantin). Membeli tema secara mandiri, mengelola undangan miliknya sendiri (`owner_id`), input tamu undangan, menyebarkan tautan via WhatsApp, dan memantau RSVP & ucapan tamu. |

---

## 3. Matriks Hak Akses (Access Control Matrix)

| Modul / Fitur | Super Admin | Partner | Member |
|---|:---:|:---:|:---:|
| **Manajemen Katalog Tema (`themes`)** | Full (CRUD) | Read-Only | Read-Only |
| **Manajemen Paket Layanan (`packages`)** | Full (CRUD) | Read-Only | Read-Only |
| **Beli Lisensi Tema (`orders`, `payments`)** | Audit / View All | Beli (Untuk Akun Sendiri / Klien) | Beli (Untuk Diri Sendiri) |
| **Inventory Tema (`user_themes`)** | View All | Akses Tema Milik Partner | Akses Tema Milik Member |
| **Manajemen Klien (`partner_clients`)** | View All | Full CRUD (Klien Milik Partner) | Tidak Memiliki Akses |
| **Buat Undangan Baru (`invitations`)** | Unlimited | Terikat Kuota/Tema Partner | Memerlukan Akses Tema Aktif |
| **Kelola Detail Undangan (`invitation_*`)** | All Access | Undangan Kelolaan Partner | Undangan Milik Sendiri |
| **Moderasi Ucapan & RSVP Tamu** | Global | Undangan Partner | Undangan Member |
| **Laporan Transaksi & Keuangan** | Global Revenue | Riwayat Belanja Partner | Riwayat Belanja Member |

---

## 4. Hirarki Kepemilikan Undangan (Multi-Tenancy Sederhana)

Sebuah `Invitation` dapat dimiliki melalui dua skenario utama:

### Skenario A: Undangan Mandiri (Direct Member)
- `invitations.owner_id`: ID dari akun Member.
- `invitations.partner_id`: `NULL`.
- `invitations.client_id`: `NULL`.
- Member membeli tema sendiri, lalu memilih tema tersebut saat membuat undangan.

### Skenario B: Undangan Kelolaan Partner (Wedding Organizer)
- `invitations.owner_id`: ID akun Partner (atau akun Member jika akun klien dibuatkan).
- `invitations.partner_id`: ID akun Partner yang mengelola.
- `invitations.client_id`: ID dari tabel `partner_clients`.
- Partner menggunakan tema dari inventori `user_themes` milik partner untuk membuatkan undangan atas nama kliennya.

---

## 5. Domain Boundaries & Prinsip Modularitas

Untuk menjaga agar kode tetap bersih dan mudah dipelihara seiring pertumbuhan aplikasi, batasan domain diatur sebagai berikut:

```
app/
├── Models/                     # 16 Model Eloquent Representatif
├── Http/
│   ├── Controllers/
│   │   ├── Admin/             # Pengelolaan master data & sistem
│   │   ├── Partner/           # Dashboard & manajemen klien WO
│   │   ├── Member/            # Dashboard & portal mandiri pengantin
│   │   ├── Invitation/        # Sub-controller modular per komponen undangan
│   │   ├── Order/             # Checkout & transaksi
│   │   ├── Payment/           # Gateway callback & verifikasi
│   │   └── Theme/             # Katalog publik & preview tema
│   ├── Requests/              # Validasi Form Request terpisah
│   └── Middleware/            # Role check (EnsureRole:super_admin,partner,member)
└── Services/
    ├── InvitationService.php   # Orkestrasi pembuatan & publikasi undangan
    ├── ThemeOwnershipService.php # Pengecekan & pemberian lisensi user_themes
    └── PaymentService.php      # State machine status order & payment webhook
```

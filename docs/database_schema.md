# Detail Desain Skema Database (Database Schema Reference)

Dokumen ini berisi rancangan detail skema tabel database untuk platform **KalaUndangan**, termasuk tipe data, relasi antar tabel (Foreign Keys), dan indeks untuk performa optimal.

---

## 📊 Diagram Relasi Entitas (ERD)

```text
users
  │ (1:N)
  └── invitations
        ├── (1:1) ── couples (Data Mempelai)
        ├── (1:N) ── events (Akad, Resepsi, dll)
        ├── (1:N) ── guests (Daftar Tamu & Link Khusus)
        ├── (1:N) ── wishes (Buku Tamu & RSVP Doa)
        ├── (1:N) ── galleries (Foto & Video Prewedding)
        ├── (1:N) ── stories (Kisah Cinta / Timeline)
        ├── (1:N) ── wallets (Amplop Digital & QRIS)
        └── (N:1) ── themes (Template yang Dipilih)
```

---

## 🗄️ Spesifikasi Tabel & Kolom

### 1. Tabel `themes` (Template Undangan)
Menyimpan katalog tema yang tersedia di sistem.
```sql
CREATE TABLE themes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    category ENUM('minimalist', 'luxury', 'botanical', 'traditional', 'modern') DEFAULT 'minimalist',
    thumbnail VARCHAR(255) NULL,
    view_path VARCHAR(100) NOT NULL, -- contoh: templates.monochrome-elegance
    is_active BOOLEAN DEFAULT TRUE,
    is_premium BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

### 2. Tabel `invitations` (Undangan Utama)
Menyimpan informasi inti website undangan setiap pengguna.
```sql
CREATE TABLE invitations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    theme_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(150) NOT NULL, -- Contoh: "The Wedding of Raka & Arinda"
    slug VARCHAR(100) UNIQUE NOT NULL, -- Contoh: "raka-arinda"
    event_type ENUM('wedding', 'khitan', 'birthday', 'engagement', 'other') DEFAULT 'wedding',
    background_music VARCHAR(255) NULL,
    quote_text TEXT NULL,
    quote_source VARCHAR(100) NULL, -- Contoh: "Q.S. Ar-Rum: 21"
    cover_image VARCHAR(255) NULL,
    is_published BOOLEAN DEFAULT TRUE,
    password VARCHAR(50) NULL, -- Optional jika undangan diproteksi
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (theme_id) REFERENCES themes(id) ON DELETE RESTRICT
);
```

---

### 3. Tabel `couples` (Data Mempelai)
Menyimpan data kedua mempelai / orang yang berhajat.
```sql
CREATE TABLE couples (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    -- Mempelai Pria
    groom_name VARCHAR(150) NOT NULL,
    groom_nickname VARCHAR(50) NOT NULL,
    groom_father VARCHAR(150) NULL,
    groom_mother VARCHAR(150) NULL,
    groom_instagram VARCHAR(100) NULL,
    groom_photo VARCHAR(255) NULL,
    groom_bio TEXT NULL,
    -- Mempelai Wanita
    bride_name VARCHAR(150) NOT NULL,
    bride_nickname VARCHAR(50) NOT NULL,
    bride_father VARCHAR(150) NULL,
    bride_mother VARCHAR(150) NULL,
    bride_instagram VARCHAR(100) NULL,
    bride_photo VARCHAR(255) NULL,
    bride_bio TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE
);
```

---

### 4. Tabel `events` (Rangkaian Acara)
Menyimpan detail satu atau lebih sesi acara (Akad, Resepsi, Unduh Mantu).
```sql
CREATE TABLE events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL, -- Contoh: "Akad Nikah", "Resepsi Pernikahan"
    date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NULL,
    is_until_end BOOLEAN DEFAULT FALSE, -- Jika acara "Selesai s/d selesai"
    timezone VARCHAR(10) DEFAULT 'WIB', -- WIB / WITA / WIT
    location_name VARCHAR(200) NOT NULL, -- Nama Gedung / Masjid
    address TEXT NOT NULL,
    gmaps_url VARCHAR(500) NULL,
    calendar_title VARCHAR(200) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE
);
```

---

### 5. Tabel `guests` (Daftar Tamu & Link Personal)
Menyimpan data tamu untuk pembuatan tautan personal WhatsApp.
```sql
CREATE TABLE guests (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL, -- Untuk URL parameter ?to=...
    phone_number VARCHAR(25) NULL, -- Untuk WhatsApp Blaster
    seat_count INT DEFAULT 1,
    is_vip BOOLEAN DEFAULT FALSE,
    qr_code VARCHAR(100) NULL, -- Untuk check-in tamu
    has_opened BOOLEAN DEFAULT FALSE,
    opened_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE
);
```

---

### 6. Tabel `wishes` (Buku Tamu & RSVP Online)
Menyimpan ucapan doa restu dan konfirmasi kehadiran dari tamu.
```sql
CREATE TABLE wishes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    guest_id BIGINT UNSIGNED NULL, -- Opsional jika tamu terhubung ke data guests
    name VARCHAR(150) NOT NULL,
    attendance_status ENUM('present', 'absent', 'tentative') DEFAULT 'present',
    pax_count INT DEFAULT 1, -- Jumlah orang yang hadir
    message TEXT NOT NULL,
    is_visible BOOLEAN DEFAULT TRUE, -- Untuk moderasi spam
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE,
    FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE SET NULL
);
```

---

### 7. Tabel `wallets` (Amplop Digital & QRIS)
Menyimpan rekening transfer bank dan scan QRIS.
```sql
CREATE TABLE wallets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    bank_name VARCHAR(50) NOT NULL, -- BCA, Mandiri, BRI, BNI, GoPay, OVO, QRIS
    account_number VARCHAR(100) NOT NULL,
    account_holder VARCHAR(150) NOT NULL, -- Nama pemilik rekening
    qris_image VARCHAR(255) NULL,
    gift_address TEXT NULL, -- Alamat kirim kado fisik
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE
);
```

---

### 8. Tabel `galleries` & `stories` (Foto, Video & Timeline)
```sql
CREATE TABLE galleries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    caption VARCHAR(255) NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE
);

CREATE TABLE stories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invitation_id BIGINT UNSIGNED NOT NULL,
    year_or_date VARCHAR(50) NOT NULL, -- Contoh: "Juni 2021"
    title VARCHAR(150) NOT NULL, -- Contoh: "Pertama Kali Bertemu"
    description TEXT NOT NULL,
    image_path VARCHAR(255) NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (invitation_id) REFERENCES invitations(id) ON DELETE CASCADE
);
```

# Laravel_PemesananHotel

> Sistem manajemen hotel berbasis web — Laravel REST API + CMS Dashboard

![Status](https://img.shields.io/badge/status-in%20progress-yellow)
![Laravel](https://img.shields.io/badge/backend-Laravel%2012-red)
![Next.js](https://img.shields.io/badge/frontend-Next.js%2014-black)
![MySQL](https://img.shields.io/badge/database-MySQL-blue)
![PHP](https://img.shields.io/badge/PHP-8.2-purple)

---

## Daftar Isi

1. [Deskripsi Proyek](#1-deskripsi-proyek)
2. [Arsitektur Sistem](#2-arsitektur-sistem)
3. [Fitur per Role](#3-fitur-per-role)
4. [Struktur Database](#4-struktur-database)
5. [Roadmap Pengerjaan](#5-roadmap-pengerjaan)
6. [Cara Install & Jalankan](#6-cara-install--jalankan)
7. [Daftar API Endpoint](#7-daftar-api-endpoint)
8. [Catatan Penting Dev](#8-catatan-penting-dev)
9. [Progress & Checklist](#9-progress--checklist)

---

## 1. Deskripsi Proyek

Sistem manajemen hotel **The Redison Blue** yang dibangun untuk keperluan Ujian Kompetensi Kejuruan (UKK). Sistem ini mencakup halaman publik untuk tamu hotel dan panel dashboard untuk staf internal (admin dan resepsionis).

**Fitur utama:**
- REST API untuk dikonsumsi Next.js frontend & Flutter mobile
- Panel resepsionis: CRUD kamar, fasilitas, galeri, dan pesanan
- Panel admin: semua akses resepsionis + manajemen artikel, banner, users, absensi karyawan, dan laporan
- Banner slider mendukung gambar (JPG/PNG/WEBP), GIF, dan video (MP4/WEBM/OGG)

**Repo terkait:**
- Frontend publik: [Frontend_NextJS_Hotel](https://github.com/rulifcode/Frontend_NextJS_Hotel)

---

## 2. Arsitektur Sistem

```
┌─────────────────────┐         ┌─────────────────────┐
│   Next.js (Frontend)│ ◄─────► │  Laravel (Backend)  │
│   Port: 3000        │  REST   │  Port: 8000         │
│                     │  API    │                     │
│  - Halaman Publik   │         │  - API Controllers  │
│  - Hero Slider      │         │  - CMS Dashboard    │
│                     │         │  - File Storage     │
└─────────────────────┘         └──────────┬──────────┘
                                            │
                                 ┌──────────▼──────────┐
                                 │   MySQL Database    │
                                 │                     │
                                 │  - users            │
                                 │  - kamar            │
                                 │  - fasilitas_kamar  │
                                 │  - galeri           │
                                 │  - pesanan          │
                                 │  - artikel          │
                                 │  - banner           │
                                 │  - absensi_karyawan │
                                 └─────────────────────┘
```

### Struktur Folder

```
app_ujikom_2022/
├── app/Http/Controllers/
│   ├── Admin/
│   │   ├── ArtikelController.php
│   │   ├── BannerController.php     ← support image/gif/video
│   │   ├── UserController.php
│   │   ├── AbsensiController.php
│   │   └── LaporanController.php
│   ├── Api/                         ← REST API untuk Next.js
│   │   ├── BannerController.php
│   │   ├── KamarController.php
│   │   ├── GaleriController.php
│   │   ├── ArtikelController.php
│   │   └── PesananController.php
│   ├── AuthController.php
│   ├── KamarController.php
│   ├── GaleriController.php
│   ├── PesananController.php
│   └── FasilitasKamarController.php
├── app/Http/Middleware/
│   └── CheckRole.php
├── app/Models/
│   ├── User.php
│   ├── Kamar.php
│   ├── FasilitasKamar.php
│   ├── Galeri.php
│   ├── Pesanan.php
│   ├── Artikel.php
│   ├── Banner.php                   ← isVideo(), isGif(), isImage()
│   └── AbsensiKaryawan.php
├── config/
│   └── cors.php                     ← allow localhost:3000
├── database/migrations/
├── routes/
│   ├── web.php                      ← 64 routes CMS
│   └── api.php                      ← REST API publik
├── public/img/
│   ├── banner/                      ← upload media banner
│   └── ...
└── resources/views/
    ├── layouts/app.blade.php
    ├── auth/login.blade.php
    ├── kamar/
    ├── fasilitas-kamar/
    ├── galeri/
    ├── pesanan/
    └── admin/
        ├── artikel/
        ├── banner/
        ├── users/
        ├── absensi/
        └── laporan/
```

---

## 3. Fitur per Role

| Fitur | Resepsionis | Admin |
|---|:---:|:---:|
| CRUD Kamar | ✅ | ✅ |
| CRUD Fasilitas Kamar | ✅ | ✅ |
| CRUD Galeri | ✅ | ✅ |
| CRUD Pesanan | ✅ | ✅ |
| Update Status Pesanan | ✅ | ✅ |
| Absensi (diri sendiri) | ✅ | ✅ |
| CRUD Artikel / Blog | ❌ | ✅ |
| CRUD Banner / Slider | ❌ | ✅ |
| Manajemen Users | ❌ | ✅ |
| Rekap Absensi Karyawan | ❌ | ✅ |
| Laporan & Statistik | ❌ | ✅ |

---

## 4. Struktur Database

#### `users`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| name | varchar | |
| email | varchar | unique |
| password | varchar | hashed |
| role | enum | `admin` / `resepsionis` |
| created_at | timestamp | |

#### `kamar`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| nama_kamar | varchar | |
| tipe_kamar | varchar | |
| harga | int | per malam |
| deskripsi | text | |
| foto | varchar | path file |
| created_at | timestamp | |

#### `fasilitas_kamar`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| kamar_id | bigint FK | → kamar.id |
| nama_fasilitas | varchar | unique per kamar |
| created_at | timestamp | |

#### `galeri`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| judul | varchar | |
| foto | varchar | |
| deskripsi | text | opsional |
| urutan | int | default 0 |
| created_at | timestamp | |

#### `pesanan`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| kamar_id | bigint FK | → kamar.id |
| nama_pemesan | varchar | |
| email_pemesan | varchar | |
| hp_pemesan | varchar | |
| nama_tamu | varchar | |
| cek_in | date | |
| cek_out | date | |
| jml_kamar | int | |
| total_harga | bigint | |
| status | enum | `pending` / `dikonfirmasi` / `ditolak` / `selesai` |
| created_at | timestamp | |

#### `artikel`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| user_id | bigint FK | → users.id |
| judul | varchar | |
| slug | varchar | unique |
| konten | longtext | |
| thumbnail | varchar | nullable |
| kategori | enum | `promo` / `info` / `event` |
| status | enum | `draft` / `published` |
| published_at | timestamp | nullable |
| created_at | timestamp | |

#### `banner`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| judul | varchar | |
| media | varchar | nama file (image/gif/video) |
| tipe | enum | `image` / `gif` / `video` |
| link | varchar | nullable |
| aktif | boolean | default true |
| urutan | int | default 0 |
| created_at | timestamp | |

#### `absensi_karyawan`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| user_id | bigint FK | → users.id |
| tanggal | date | |
| jam_masuk | time | nullable |
| jam_keluar | time | nullable |
| status | enum | `hadir` / `izin` / `alfa` |
| keterangan | text | nullable |
| created_at | timestamp | |
| — | unique | `(user_id, tanggal)` |

---

## 5. Roadmap Pengerjaan

### Fase 1 — Laravel Backend ✅ `(selesai 14 Mei 2026)`
- [x] Kolom `role` ENUM di tabel `users`
- [x] Kolom `total_harga` di tabel `pesanan`
- [x] Middleware `CheckRole` + alias `'role'`
- [x] Migration: `artikel`, `banner`, `absensi_karyawan`
- [x] Controllers lengkap: resepsionis + Admin/
- [x] `routes/web.php` — 64 routes, pisah admin vs resepsionis
- [x] Unique constraint `(kamar_id, nama_fasilitas)` di `fasilitas_kamar`

### Fase 2 — Views Blade + Auth ✅ `(selesai 14 Mei 2026)`
- [x] `layouts/app.blade.php` — sidebar kondisional by role
- [x] `auth/login.blade.php` — redirect by role
- [x] Semua views resepsionis & admin
- [x] Design system seragam (Tailwind, DM Sans, `#FF6B00`)

### Fase 3 — REST API + Integrasi Next.js ✅ `(selesai 15 Mei 2026)`
- [x] `routes/api.php` — endpoint publik untuk Next.js
- [x] `Api/BannerController` — return field `media`, `tipe`, `src` (full URL)
- [x] `Api/KamarController`, `GaleriController`, `ArtikelController`, `PesananController`
- [x] `config/cors.php` — allow `http://localhost:3000`
- [x] Banner update: kolom `gambar` → `media` + `tipe` (support image/gif/video)
- [x] Upload banner video MP4/WEBM/OGG, maks 20MB

### Fase 4 — Halaman Publik Next.js `(in progress)`
- [ ] Landing page (`/`)
- [ ] Katalog kamar (`/kamar`)
- [ ] Detail kamar (`/kamar/[id]`)
- [ ] Galeri foto (`/galeri`)
- [ ] Artikel / promo (`/artikel`, `/artikel/[slug]`)
- [ ] Form reservasi publik (`/pesan`)

---

## 6. Cara Install & Jalankan

### Prasyarat

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL, XAMPP

### Backend (Laravel)

```bash
cd C:/xampp/htdocs
git clone https://github.com/rulifcode/Laravel_PemesananHotel.git app_ujikom_2022
cd app_ujikom_2022
composer install
cp .env.example .env
php artisan key:generate
```

Konfigurasi `.env`:
```
DB_DATABASE=db_ukk_2022
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
# → http://localhost:8000
```

### Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | admin@hotel.com | password |
| Resepsionis | resepsionis@hotel.com | password |

---

## 7. Daftar API Endpoint

Base URL: `http://localhost:8000/api`

### Publik (tanpa auth)

| Method | Endpoint | Keterangan |
|---|---|---|
| GET | `/banner` | Daftar banner aktif (image/gif/video) |
| GET | `/kamar` | Daftar kamar |
| GET | `/kamar/{id}` | Detail kamar |
| GET | `/galeri` | Daftar galeri |
| GET | `/artikel` | Daftar artikel published |
| GET | `/artikel/{slug}` | Detail artikel |
| POST | `/pesanan` | Buat pesanan baru |

### Response `/api/banner`
```json
{
  "data": [
    {
      "id": 1,
      "judul": "Living Room",
      "media": "1778764468.jpg",
      "tipe": "image",
      "src": "http://localhost:8000/img/banner/1778764468.jpg",
      "link": ""
    },
    {
      "id": 2,
      "judul": "Activity",
      "media": "1778783519_bapwnk.mp4",
      "tipe": "video",
      "src": "http://localhost:8000/img/banner/1778783519_bapwnk.mp4",
      "link": ""
    }
  ]
}
```

---

## 8. Catatan Penting Dev

### Tulis File PHP via PowerShell — WAJIB pakai ini
```powershell
[System.IO.File]::WriteAllText(
    "path\ke\file.php",
    @'konten'@,
    [System.Text.UTF8Encoding]::new($false)
)
```
Jangan pakai `Set-Content` — menyisipkan BOM yang merusak PHP.

### Cek BOM
```powershell
$bytes = [System.IO.File]::ReadAllBytes("file.php")
($bytes[0] -eq 0xEF -and $bytes[1] -eq 0xBB -and $bytes[2] -eq 0xBF)
```

### Konvensi Route
```
Resepsionis : kamar.*, galeri.*, pesanan.*, fasilitas-kamar.*
Admin only  : admin.artikel.*, admin.banner.*, admin.users.*
              admin.absensi.index, admin.laporan.index
Semua role  : absensi.masuk, absensi.keluar, absensi.saya
API publik  : /api/banner, /api/kamar, /api/galeri, /api/artikel, /api/pesanan
```

### Nama Kolom Database
```
Tabel kamar   : nama_kamar, tipe_kamar, harga, deskripsi, foto
Tabel pesanan : nama_pemesan, email_pemesan, hp_pemesan, nama_tamu,
                cek_in, cek_out, jml_kamar, total_harga, status
Tabel banner  : judul, media, tipe, link, aktif, urutan
```

### Design System (Blade Views)
```
Font         : DM Sans (Google Fonts)
Warna utama  : #FF6B00 (oranye brand)
Warna teks   : #121212 (heading), #464646 (body), #999/#aaa (muted)
Background   : #F5F4F2 (page), #FAFAF9 (input/row), white (card)
Border       : border-black/[0.06] (card), border-black/[0.08] (input)
Rounded      : rounded-[10px] (card), rounded-[7px] (input/button)
Error        : border-[#E24B4A] bg-[#FEF0F0] + text-[#E24B4A]
```

### Masalah yang Sudah Diperbaiki
- ~~Tabel `users` belum ada kolom `role`~~ → ✅
- ~~Tabel `pesanan` belum ada `total_harga`~~ → ✅
- ~~Duplikat `fasilitas_kamar`~~ → ✅ unique constraint
- ~~Banner kolom `gambar` tidak support video~~ → ✅ diganti `media` + `tipe`
- ~~API `/banner` return field salah~~ → ✅ return `media`, `tipe`, `src`

---

## 9. Progress & Checklist

### ✅ Selesai

- [x] Migration semua tabel
- [x] Model: semua + relasi + helper (`isVideo()`, `isGif()`, `isImage()`)
- [x] Seeder: `UserSeeder`, `KamarSeeder`, `FasilitasKamarSeeder`, `GaleriSeeder`
- [x] Middleware `CheckRole`
- [x] `AuthController` — login redirect by role
- [x] `routes/web.php` — 64 routes
- [x] `routes/api.php` — REST API publik
- [x] `Api/BannerController` — response dengan `src` full URL
- [x] `config/cors.php` — CORS allow `localhost:3000`
- [x] Semua Controllers CMS (resepsionis + admin)
- [x] Semua Views Blade dengan design system seragam
- [x] Banner: upload image/gif/video, preview di CMS, deteksi tipe otomatis

### Update 15/05/2026 Selesai ✅

- [ ] Fix `KamarController` — validasi pakai `nama_kamar` bukan `no_kamar`
- [ ] Fix `PesananController` — auto kalkulasi `total_harga`
- [ ] Seeder: `ArtikelSeeder`, `BannerSeeder`
- [ ] Testing menyeluruh semua route & CRUD
- [ ] Halaman publik Blade (opsional, bisa full Next.js)

---

*Terakhir diperbarui: 15 Mei 2026*
*Laravel 12 | PHP 8.2 | MySQL (XAMPP) | 64 web routes + 7 API routes*
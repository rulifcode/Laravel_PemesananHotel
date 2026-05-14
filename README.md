# app_ujikom_2022

> Sistem manajemen hotel berbasis web — Laravel REST API + Next.js Frontend

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

`app_ujikom_2022` adalah aplikasi manajemen hotel yang dibangun untuk keperluan Ujian Kompetensi Kejuruan (UKK) 2022. Sistem ini mencakup halaman publik untuk tamu hotel dan panel dashboard untuk staf internal (admin dan resepsionis).

**Fitur utama:**
- Halaman publik: landing page, katalog kamar, galeri, artikel/promo, form reservasi online
- Panel resepsionis: CRUD kamar, fasilitas, galeri, dan pesanan
- Panel admin: semua akses resepsionis + manajemen artikel, banner, users, absensi karyawan, dan laporan

---

## 2. Arsitektur Sistem

```
┌─────────────────────┐         ┌─────────────────────┐
│   Next.js (Frontend)│ ◄─────► │  Laravel (Backend)  │
│   Port: 3000        │  REST   │  Port: 8000         │
│                     │  API    │                     │
│  - Halaman Publik   │         │  - API Controllers  │
│  - Dashboard        │         │  - Sanctum Auth     │
│  - Sidebar role     │         │  - File Storage     │
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
│   │   ├── BannerController.php
│   │   ├── UserController.php
│   │   ├── AbsensiController.php
│   │   └── LaporanController.php
│   ├── AuthController.php
│   ├── KamarController.php
│   ├── GaleriController.php
│   ├── PesananController.php
│   └── FasilitasKamarController.php
├── app/Http/Middleware/
│   └── CheckRole.php
├── app/Models/
│   ├── User.php              (+ role, isAdmin, isResepsionis)
│   ├── Kamar.php
│   ├── FasilitasKamar.php
│   ├── Galeri.php
│   ├── Pesanan.php
│   ├── Artikel.php
│   ├── Banner.php
│   └── AbsensiKaryawan.php
├── bootstrap/app.php         (alias middleware 'role')
├── database/migrations/
├── routes/
│   ├── web.php               (64 routes)
│   └── api.php
├── storage/app/public/
└── resources/views/
    ├── layouts/app.blade.php (sidebar kondisional by role)
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

### Sidebar Menu

**Resepsionis:**
- Dashboard
- Kamar
- Fasilitas Kamar
- Galeri
- Pesanan
- Absensi Saya

**Admin (semua menu resepsionis +):**
- Artikel
- Banner
- Manajemen Users
- Absensi Karyawan
- Laporan

---

## 4. Struktur Database

### Tabel Existing (sudah ada)

#### `users`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| name | varchar | |
| email | varchar | unique |
| password | varchar | hashed |
| **role** | enum | `admin` / `resepsionis` |
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
| **total_harga** | bigint | |
| status | enum | `pending` / `dikonfirmasi` / `ditolak` / `selesai` |
| created_at | timestamp | |

### Tabel Baru (sudah dibuat)

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
| gambar | varchar | |
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
- [x] Tambah kolom `role` ENUM ke tabel `users`
- [x] Tambah kolom `total_harga` ke tabel `pesanan`
- [x] Install & konfigurasi Middleware CheckRole
- [x] Migration: `artikel`, `banner`, `absensi_karyawan`
- [x] Controllers penuh: resepsionis + Admin/
- [x] routes/web.php — 64 routes, pisah admin vs resepsionis
- [x] Bersihkan duplikat `fasilitas_kamar`, tambah unique constraint

### Fase 2 — Views Blade + Auth ✅ `(selesai 14 Mei 2026)`
- [x] `layouts/app.blade.php` — sidebar kondisional by role, branding **The Redison Blue** + logo
- [x] `auth/login.blade.php` — redirect by role
- [x] Semua views resepsionis: kamar, galeri, pesanan, fasilitas-kamar
- [x] Semua views admin: artikel, banner, users, absensi, laporan
- [x] **Design system** — seluruh views diselaraskan ke Tailwind custom (warna `#FF6B00`, DM Sans, komponen konsisten)

### Fase 3 — Halaman Publik `(belum)`
- [ ] Landing page (`/`)
- [ ] Katalog kamar (`/kamar`)
- [ ] Detail kamar (`/kamar/[id]`)
- [ ] Galeri foto (`/galeri`)
- [ ] Artikel / promo (`/artikel`, `/artikel/[slug]`)
- [ ] Form reservasi publik (`/pesan`)

### Fase 4 — Next.js Frontend `(belum)`
- [ ] Setup project Next.js
- [ ] Setup `middleware.ts` untuk proteksi route `/dashboard`
- [ ] Buat komponen `Sidebar.tsx` kondisional berdasarkan role
- [ ] Dashboard kamar, fasilitas, galeri, pesanan (resepsionis)
- [ ] Absensi mandiri (resepsionis)
- [ ] CRUD artikel + upload thumbnail (admin)
- [ ] CRUD banner + toggle aktif / urutan (admin)
- [ ] Manajemen users + ganti role (admin)
- [ ] Rekap absensi karyawan + filter tanggal (admin)
- [ ] Halaman laporan / statistik (admin)

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
git clone <repo-url> app_ujikom_2022
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
# Import SQL dump via phpMyAdmin
php artisan storage:link
php artisan serve
# -> http://localhost:8000
```

### Frontend (Next.js) — belum setup

```bash
cd frontend
npm install
cp .env.example .env.local
# Isi NEXT_PUBLIC_API_URL=http://localhost:8000/api
npm run dev
# -> http://localhost:3000
```

### Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | admin@hotel.com | password |
| Resepsionis | resepsionis@hotel.com | password |

---

## 7. Daftar API Endpoint

Base URL: `http://localhost:8000/api`

### Auth
| Method | Endpoint | Keterangan |
|---|---|---|
| POST | `/login` | Login, returns token |
| POST | `/logout` | Logout (auth required) |
| GET | `/me` | Data user login |

### Kamar
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| GET | `/kamar` | Daftar kamar (publik) | — |
| GET | `/kamar/{id}` | Detail kamar (publik) | — |
| POST | `/kamar` | Tambah kamar | resepsionis, admin |
| PUT | `/kamar/{id}` | Edit kamar | resepsionis, admin |
| DELETE | `/kamar/{id}` | Hapus kamar | resepsionis, admin |

### Pesanan
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| GET | `/pesanan` | Daftar pesanan | resepsionis, admin |
| GET | `/pesanan/{id}` | Detail pesanan | resepsionis, admin |
| POST | `/pesanan` | Buat pesanan baru (publik) | — |
| PUT | `/pesanan/{id}` | Edit pesanan | resepsionis, admin |
| PATCH | `/pesanan/{id}/status` | Update status | resepsionis, admin |
| DELETE | `/pesanan/{id}` | Hapus pesanan | admin |

### Galeri
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| GET | `/galeri` | Daftar foto (publik) | — |
| POST | `/galeri` | Upload foto | resepsionis, admin |
| PUT | `/galeri/{id}` | Edit galeri | resepsionis, admin |
| DELETE | `/galeri/{id}` | Hapus foto | resepsionis, admin |

### Artikel
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| GET | `/artikel` | Daftar artikel published (publik) | — |
| GET | `/artikel/{slug}` | Detail artikel (publik) | — |
| GET | `/artikel/all` | Semua artikel incl. draft | admin |
| POST | `/artikel` | Buat artikel | admin |
| PUT | `/artikel/{id}` | Edit artikel | admin |
| DELETE | `/artikel/{id}` | Hapus artikel | admin |

### Banner
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| GET | `/banner` | Daftar banner aktif (publik) | — |
| POST | `/banner` | Tambah banner | admin |
| PUT | `/banner/{id}` | Edit banner | admin |
| PATCH | `/banner/{id}/toggle` | Toggle aktif/nonaktif | admin |
| DELETE | `/banner/{id}` | Hapus banner | admin |

### Absensi
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| POST | `/absensi/masuk` | Clock-in | resepsionis, admin |
| POST | `/absensi/keluar` | Clock-out | resepsionis, admin |
| GET | `/absensi/saya` | Riwayat absensi sendiri | resepsionis, admin |
| GET | `/absensi` | Rekap semua karyawan | admin |
| GET | `/absensi?tanggal=2026-05-01` | Filter by tanggal | admin |

### Users (Admin Only)
| Method | Endpoint | Keterangan | Role |
|---|---|---|---|
| GET | `/users` | Daftar users | admin |
| POST | `/users` | Tambah user | admin |
| PUT | `/users/{id}` | Edit user | admin |
| DELETE | `/users/{id}` | Hapus user | admin |

---

## 8. Catatan Penting Dev

### Tulis File PHP via PowerShell — WAJIB pakai ini
```powershell
[System.IO.File]::WriteAllText(
    "path\ke\file.php",
    "konten",
    [System.Text.UTF8Encoding]::new($false)
)
```
Jangan pakai `Set-Content` atau heredoc `@'...'@` — menyisipkan BOM yang merusak PHP.

### Cek BOM
```powershell
$bytes = [System.IO.File]::ReadAllBytes("file.php")
($bytes[0] -eq 0xEF -and $bytes[1] -eq 0xBB -and $bytes[2] -eq 0xBF)
```

### Konvensi Penamaan
```
Route resepsionis : kamar.*, galeri.*, pesanan.*, fasilitas-kamar.*
Route admin only  : admin.artikel.*, admin.banner.*, admin.users.*
                    admin.absensi.index, admin.laporan.index
Route semua role  : absensi.masuk, absensi.keluar, absensi.saya
```

### Nama Kolom Database
```
Tabel kamar   : nama_kamar, tipe_kamar, harga, deskripsi, foto
Tabel pesanan : nama_pemesan, email_pemesan, hp_pemesan, nama_tamu,
                cek_in, cek_out, jml_kamar, total_harga, status
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
Badge status : hijau #16A34A (confirmed/aktif), kuning #D97706 (pending),
               merah #E24B4A (cancelled/ditolak), biru #3B82F6 (info)
```

### Masalah yang Sudah Diperbaiki
- ~~KRITIS — Tabel `users` belum ada kolom `role`~~ → ✅ sudah ada
- ~~PENTING — Tabel `pesanan` belum ada `total_harga`~~ → ✅ sudah ada
- ~~PENTING — Ada duplikat `fasilitas_kamar`~~ → ✅ sudah dibersihkan + unique constraint

---

## 9. Progress & Checklist

### ✅ Selesai

#### Database & Models
- [x] Migration: `users`, `cache`, `jobs`, `kamar`, `fasilitas_kamar`, `galeri`, `pesanan`
- [x] Migration: `artikel`, `banner`, `absensi_karyawan`
- [x] Kolom `role` ENUM di tabel `users`
- [x] Kolom `total_harga` di tabel `pesanan`
- [x] Unique constraint `(kamar_id, nama_fasilitas)` di `fasilitas_kamar`
- [x] Model: `Kamar`, `FasilitasKamar`, `Galeri`, `Pesanan` + relasi
- [x] Model: `User` (+ role, isAdmin, isResepsionis)
- [x] Model: `Artikel`, `Banner`, `AbsensiKaryawan`
- [x] Seeder: `UserSeeder`, `KamarSeeder`, `FasilitasKamarSeeder`, `GaleriSeeder`, `PesananSeeder`

#### Backend & Middleware
- [x] Middleware `CheckRole` — alias `'role'` di `bootstrap/app.php`
- [x] `AuthController` — login redirect by role
- [x] `routes/web.php` — 64 routes, pisah admin vs resepsionis

#### Controllers
- [x] `KamarController` — CRUD + upload foto
- [x] `GaleriController` — CRUD + upload foto
- [x] `PesananController` — CRUD + updateStatus
- [x] `FasilitasKamarController` — CRUD
- [x] `Admin/ArtikelController` — CRUD + slug auto + upload thumbnail
- [x] `Admin/BannerController` — CRUD + toggle aktif
- [x] `Admin/UserController` — CRUD + hash password + ganti role
- [x] `Admin/AbsensiController` — clock-in/out + rekap + riwayat
- [x] `Admin/LaporanController` — statistik pesanan + pendapatan per bulan

#### Views Blade — Design System
> Semua views menggunakan design system yang seragam: Tailwind CSS, DM Sans, warna brand `#FF6B00`, komponen konsisten (card, tabel, form, badge, tombol aksi).

- [x] `layouts/app.blade.php` — sidebar kondisional by role, branding **The Redison Blue** + logo `public/img/logo.png`, topbar dengan breadcrumb + tanggal + bell notif
- [x] `auth/login.blade.php`

**Resepsionis:**
- [x] `fasilitas-kamar/index.blade.php` — tabel dengan badge tipe kamar, icon fasilitas otomatis
- [x] `fasilitas-kamar/create.blade.php` — form dengan quick-pick chips fasilitas
- [x] `fasilitas-kamar/edit.blade.php`

**Admin — Artikel:**
- [x] `admin/artikel/index.blade.php`
- [x] `admin/artikel/create.blade.php` — grid 2 kolom (kategori + status), file input Tailwind
- [x] `admin/artikel/edit.blade.php`

**Admin — Banner:**
- [x] `admin/banner/index.blade.php` — thumbnail preview, toggle status pill hijau/abu
- [x] `admin/banner/create.blade.php` — hint format & rasio gambar
- [x] `admin/banner/edit.blade.php` — preview gambar saat ini sebelum input file

**Admin — Users:**
- [x] `admin/users/index.blade.php` — avatar inisial, badge "Anda", placeholder hapus diri sendiri
- [x] `admin/users/create.blade.php` — divider profil vs keamanan
- [x] `admin/users/edit.blade.php` — card header kontekstual (nama + email user yang diedit)

**Admin — Laporan:**
- [x] `admin/laporan/index.blade.php` — 4 stat card + 3 status card + tabel detail, filter bulan inline di header

---

### ⏳ Belum Selesai

#### Priority 1 — Testing & Bug Fix
- [ ] Test login admin — sidebar Admin Panel muncul
- [ ] Test login resepsionis — sidebar Admin Panel tidak muncul
- [ ] Test akses `/admin/*` pakai resepsionis — harusnya 403
- [ ] Test CRUD kamar (tambah, edit, hapus, upload foto)
- [ ] Test CRUD galeri (upload foto)
- [ ] Test CRUD pesanan (buat, update status)
- [ ] Test absensi clock-in/out
- [ ] Test admin: artikel, banner, users, laporan

#### Priority 2 — Fix KamarController
- [ ] Validasi kolom sesuai DB: `nama_kamar`, `tipe_kamar`, `harga`, `deskripsi`
- [ ] Sekarang masih pakai `'no_kamar'` yang salah

#### Priority 3 — Migration & Seeder
- [ ] Seeder: `ArtikelSeeder`, `BannerSeeder`
- [ ] Supaya bisa `php artisan migrate:fresh --seed` dari awal

#### Priority 4 — Fix PesananController
- [ ] Auto kalkulasi `total_harga`: `harga_kamar × jml_kamar × jumlah_malam`

#### Priority 5 — Halaman Publik (Fase 3)
- [ ] Landing page (`/`) — referensi Figma: [Redison Hotel Landing Page](https://www.figma.com/design/DurScaQJgIuFPrm7V6KowG/Redison-Hotel-Landing-Page--Community-?node-id=1-2&p=f&t=t72DbYvtNskG5YTZ-0)
- [ ] Katalog kamar (`/kamar`)
- [ ] Detail kamar (`/kamar/[id]`)
- [ ] Galeri foto (`/galeri`)
- [ ] Artikel / promo (`/artikel`, `/artikel/[slug]`)
- [ ] Form reservasi publik (`/pesan`)

#### Priority 6 — Next.js Frontend (Fase 4)
- [ ] Setup project Next.js
- [ ] Halaman publik (landing, kamar, galeri, artikel, pesan)
- [ ] Dashboard resepsionis
- [ ] Dashboard admin

---

*Terakhir diperbarui: 14 Mei 2026*
*Laravel 12.58.0 | PHP 8.2 | MySQL (XAMPP) | 64 routes*
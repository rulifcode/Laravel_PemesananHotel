# app_ujikom_2022

> Sistem manajemen hotel berbasis web — Laravel REST API + Next.js Frontend

![Status](https://img.shields.io/badge/status-in%20progress-yellow)
![Laravel](https://img.shields.io/badge/backend-Laravel%2011-red)
![Next.js](https://img.shields.io/badge/frontend-Next.js%2014-black)
![MySQL](https://img.shields.io/badge/database-MySQL-blue)

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
├── backend/          # Laravel 11 (pure API)
│   ├── app/
│   │   ├── Http/Controllers/Api/
│   │   ├── Models/
│   │   └── Middleware/
│   ├── database/migrations/
│   ├── routes/api.php
│   └── storage/app/public/
│
└── frontend/         # Next.js 14
    ├── app/
    │   ├── (public)/           # Halaman publik
    │   │   ├── page.tsx        # Landing page
    │   │   ├── kamar/
    │   │   ├── artikel/
    │   │   ├── galeri/
    │   │   └── pesan/
    │   └── dashboard/          # Panel staf (protected)
    │       ├── kamar/
    │       ├── fasilitas/
    │       ├── galeri/
    │       ├── pesanan/
    │       ├── artikel/        # Admin only
    │       ├── banner/         # Admin only
    │       ├── users/          # Admin only
    │       ├── absensi/        # Admin only
    │       └── laporan/        # Admin only
    ├── components/
    │   └── Sidebar.tsx         # Sidebar kondisional berdasarkan role
    └── middleware.ts            # Proteksi route dashboard
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
| **role** | enum | `admin` / `resepsionis` — **perlu ditambahkan** |
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
| **total_harga** | bigint | **perlu ditambahkan** |
| status | enum | `pending` / `dikonfirmasi` / `ditolak` / `selesai` |
| created_at | timestamp | |

### Tabel Baru (perlu dibuat)

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

### Fase 1 — Laravel Pure API `(1–2 hari)`
- [ ] Tambah kolom `role` ENUM ke tabel `users` ← **blocker utama**
- [ ] Tambah kolom `total_harga` ke tabel `pesanan`
- [ ] Install & konfigurasi Laravel Sanctum
- [ ] Buat migration: `artikel`, `banner`, `absensi_karyawan`
- [ ] Konversi routes dari `web.php` ke `api.php`
- [ ] Buat API controllers dengan response JSON
- [ ] Middleware role: `admin` dan `resepsionis`
- [ ] Bersihkan duplikat `fasilitas_kamar`, tambah unique constraint

### Fase 2 — Next.js Setup + Auth `(1 hari)`
- [ ] `npx create-next-app@latest frontend`
- [ ] Setup `middleware.ts` untuk proteksi route `/dashboard`
- [ ] Buat halaman login (hit `POST /api/login`)
- [ ] Simpan token + role di cookie/localStorage
- [ ] Buat komponen `Sidebar.tsx` kondisional berdasarkan role

### Fase 3 — Halaman Publik `(1–2 hari)`
- [ ] Landing page (`/`)
- [ ] Katalog kamar (`/kamar`)
- [ ] Detail kamar (`/kamar/[id]`)
- [ ] Galeri foto (`/galeri`)
- [ ] Artikel / promo (`/artikel`, `/artikel/[slug]`)
- [ ] Form reservasi publik (`/pesan`)

### Fase 4 — Dashboard CRUD + Fitur Lanjut `(2–3 hari)`
- [ ] Dashboard kamar (resepsionis)
- [ ] Dashboard fasilitas kamar (resepsionis)
- [ ] Dashboard galeri (resepsionis)
- [ ] Dashboard pesanan + update status (resepsionis)
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
- MySQL

### Backend (Laravel)

```bash
# 1. Clone dan masuk ke folder backend
cd backend

# 2. Install dependencies
composer install

# 3. Salin env dan generate key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
DB_DATABASE=app_ujikom_2022
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# 6. Link storage untuk file upload
php artisan storage:link

# 7. Jalankan server
php artisan serve
# → http://localhost:8000
```

### Frontend (Next.js)

```bash
# 1. Masuk ke folder frontend
cd frontend

# 2. Install dependencies
npm install

# 3. Salin env
cp .env.example .env.local

# 4. Isi NEXT_PUBLIC_API_URL
NEXT_PUBLIC_API_URL=http://localhost:8000/api

# 5. Jalankan dev server
npm run dev
# → http://localhost:3000
```

### Akun Default (dari Seeder)

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

### VS Code
- **Format On Save HARUS OFF** saat mengedit file PHP/Blade
- Gunakan PowerShell `Set-Content` untuk menulis file jika diperlukan
- Jangan biarkan formatter mengubah indentasi file Blade

### Konvensi Penamaan

**Variabel controller harus cocok dengan Blade:**
```php
// Controller
$kamars       → compact('kamars')
$pesanans     → compact('pesanans')
$fasilitasKamars → compact('fasilitasKamars')
```

**Nama kolom database:**
```
Tabel kamar   : nama_kamar, tipe_kamar, harga, deskripsi, foto
Tabel pesanan : nama_pemesan, email_pemesan, hp_pemesan, nama_tamu,
                cek_in, cek_out, jml_kamar, total_harga, status
```

### Migration
- File migration baru pakai timestamp terkini: `2026_05_12_15xxxx`
- Reset DB: `php artisan migrate:fresh --seed`

### Masalah Database yang Harus Diperbaiki
1. **KRITIS** — Tabel `users` belum ada kolom `role` → sidebar berbasis role tidak akan jalan
2. **PENTING** — Tabel `pesanan` belum ada `total_harga` → histori harga bisa salah jika harga kamar diubah
3. **PENTING** — Ada duplikat `fasilitas_kamar` (ID 1 dan 4 sama-sama 'AC' untuk kamar_id 2) → tambah unique constraint `(kamar_id, nama_fasilitas)` setelah bersihkan duplikat

---

## 9. Progress & Checklist

### Selesai ✅

#### Database & Backend
- [x] Migration: `users`, `cache`, `jobs`, `kamar`, `fasilitas_kamar`, `galeri`, `pesanan`
- [x] Model: `Kamar`, `FasilitasKamar`, `Galeri`, `Pesanan` + relasi
- [x] Controller: `KamarController`, `GaleriController`, `PesananController`, `FasilitasKamarController`
- [x] Routes resource: kamar, fasilitas-kamar, galeri, pesanan
- [x] Route PATCH: `pesanan/{id}/status`
- [x] Seeder: `UserSeeder`, `KamarSeeder`, `FasilitasKamarSeeder`, `GaleriSeeder`, `PesananSeeder`

#### Views Blade (Fix)
- [x] `kamar/index.blade.php`
- [x] `pesanan/index.blade.php`
- [x] `fasilitas-kamar/index.blade.php`

---

### Belum Selesai ⏳

#### Views Blade
- [ ] `layouts/app.blade.php` — layout utama
- [ ] `kamar/create.blade.php`
- [ ] `kamar/edit.blade.php`
- [ ] `galeri/index.blade.php`
- [ ] `galeri/create.blade.php`
- [ ] `galeri/edit.blade.php`
- [ ] `pesanan/create.blade.php`
- [ ] `pesanan/edit.blade.php`
- [ ] `pesanan/show.blade.php`
- [ ] `fasilitas-kamar/create.blade.php`
- [ ] `fasilitas-kamar/edit.blade.php`

#### Auth & Middleware
- [ ] Halaman login
- [ ] Middleware auth role (admin vs resepsionis)

#### Perbaikan Database
- [ ] Tambah kolom `role` ke tabel `users`
- [ ] Tambah kolom `total_harga` ke tabel `pesanan`
- [ ] Bersihkan duplikat `fasilitas_kamar`, tambah unique constraint
- [ ] Migration baru: `artikel`, `banner`, `absensi_karyawan`

#### Fase Next.js
- [ ] Setup project Next.js
- [ ] Halaman publik (landing, kamar, galeri, artikel, pesan)
- [ ] Dashboard resepsionis
- [ ] Dashboard admin

#### Testing
- [ ] Testing semua CRUD kamar
- [ ] Testing semua CRUD pesanan
- [ ] Testing semua CRUD galeri
- [ ] Testing semua CRUD fasilitas kamar
- [ ] Testing auth & middleware role

---

*Terakhir diperbarui: Mei 2026*
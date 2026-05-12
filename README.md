# Progress Project app_ujikom_2022

## ? SELESAI

### Database (Migrations)
- [x] `create_users_table` (default Laravel)
- [x] `create_cache_table` (default Laravel)
- [x] `create_jobs_table` (default Laravel)
- [x] `create_kamar_table`
- [x] `create_fasilitas_kamar_table`
- [x] `create_galeri_table`
- [x] `create_pesanan_table`

### Models
- [x] `app/Models/Kamar.php` ? relasi ke FasilitasKamar & Pesanan
- [x] `app/Models/FasilitasKamar.php` ? belongsTo Kamar
- [x] `app/Models/Galeri.php`
- [x] `app/Models/Pesanan.php` ? belongsTo Kamar

### Controllers
- [x] `app/Http/Controllers/KamarController.php` ? fix: $kamars + compact('kamars')
- [x] `app/Http/Controllers/GaleriController.php` ? CRUD + upload foto
- [x] `app/Http/Controllers/PesananController.php` ? fix: $pesanans + compact('pesanans')
- [x] `app/Http/Controllers/FasilitasKamarController.php` ? fix: $fasilitasKamars + compact('fasilitasKamars')

### Routes (`routes/web.php`)
- [x] `Route::resource('kamar', KamarController::class)`
- [x] `Route::resource('fasilitas-kamar', FasilitasKamarController::class)`
- [x] `Route::resource('galeri', GaleriController::class)`
- [x] `Route::resource('pesanan', PesananController::class)`
- [x] `Route::patch('pesanan/{id}/status', ...)` ? pesanan.status

### Seeder
- [x] `UserSeeder` ? admin & resepsionis
- [x] `KamarSeeder` ? 3 data kamar
- [x] `FasilitasKamarSeeder` ? 12 data fasilitas
- [x] `GaleriSeeder` ? 4 data galeri
- [x] `PesananSeeder` ? 3 data pesanan

### Views (Blade) - FIXED
- [x] `kamar/index.blade.php` ? fix: nama_kamar, tipe_kamar (hapus kolom status)
- [x] `pesanan/index.blade.php` ? fix: nama_pemesan, cek_in, cek_out, jml_kamar
- [x] `fasilitas-kamar/index.blade.php` ? fix: $fasilitasKamars, nama_kamar

---

## ?? MASIH PERLU DIKERJAKAN

### Views (Blade)
- [ ] Layout utama (`resources/views/layouts/app.blade.php`)
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

### Auth
- [ ] Login page
- [ ] Middleware auth (admin vs resepsionis)

### Lainnya
- [ ] Testing semua CRUD

---

## ?? CATATAN PENTING
- **Format On Save di VS Code harus OFF**
- Jangan edit file PHP/Blade di VS Code kalau Format On Save hidup
- Gunakan PowerShell Set-Content untuk menulis file agar aman
- Migration baru pakai timestamp: `2026_05_12_15xxxx`
- Jalankan `php artisan migrate:fresh --seed` kalau perlu reset DB
- Nama kolom DB: `nama_kamar`, `tipe_kamar`, `harga`, `deskripsi`, `foto` (tabel kamar)
- Nama kolom DB: `nama_pemesan`, `email_pemesan`, `hp_pemesan`, `nama_tamu`, `cek_in`, `cek_out`, `jml_kamar`, `status` (tabel pesanan)
- Variabel controller harus cocok dengan blade: $kamars, $pesanans, $fasilitasKamars

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\LaporanController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes: admin + resepsionis
Route::middleware(['auth', 'role:admin,resepsionis'])->group(function () {
    Route::get('/', fn() => redirect()->route('kamar.index'));
    Route::resource('kamar', KamarController::class);
    Route::resource('fasilitas-kamar', FasilitasKamarController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('pesanan', PesananController::class);
    Route::patch('pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.status');
    Route::post('absensi/masuk', [AbsensiController::class, 'masuk'])->name('absensi.masuk');
    Route::post('absensi/keluar', [AbsensiController::class, 'keluar'])->name('absensi.keluar');
    Route::get('absensi/saya', [AbsensiController::class, 'saya'])->name('absensi.saya');
});

// Routes: admin only
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('artikel', ArtikelController::class);
    Route::resource('banner', BannerController::class);
    Route::patch('banner/{id}/toggle', [BannerController::class, 'toggle'])->name('banner.toggle');
    Route::resource('users', UserController::class);
    Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\AuthController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('kamar.index'));
    Route::resource('kamar', KamarController::class);
    Route::resource('fasilitas-kamar', FasilitasKamarController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('pesanan', PesananController::class);
    Route::patch('pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.status');
});

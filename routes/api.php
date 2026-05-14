<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KamarController;
use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\BannerController;

// Public routes - dipakai Next.js & Flutter
Route::get('/kamar', [KamarController::class, 'index']);
Route::get('/kamar/{id}', [KamarController::class, 'show']);
Route::get('/galeri', [GaleriController::class, 'index']);
Route::get('/banner', [BannerController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{slug}', [ArtikelController::class, 'show']);
Route::post('/pesanan', [PesananController::class, 'store']);

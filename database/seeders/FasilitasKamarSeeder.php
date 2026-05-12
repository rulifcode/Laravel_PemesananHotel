<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FasilitasKamar;

class FasilitasKamarSeeder extends Seeder
{
    public function run(): void
    {
        // Fasilitas Kamar Standar (kamar_id = 1)
        FasilitasKamar::create(['nama_fasilitas' => 'AC', 'kamar_id' => 1]);
        FasilitasKamar::create(['nama_fasilitas' => 'TV', 'kamar_id' => 1]);
        FasilitasKamar::create(['nama_fasilitas' => 'WiFi', 'kamar_id' => 1]);

        // Fasilitas Kamar Deluxe (kamar_id = 2)
        FasilitasKamar::create(['nama_fasilitas' => 'AC', 'kamar_id' => 2]);
        FasilitasKamar::create(['nama_fasilitas' => 'TV', 'kamar_id' => 2]);
        FasilitasKamar::create(['nama_fasilitas' => 'WiFi', 'kamar_id' => 2]);
        FasilitasKamar::create(['nama_fasilitas' => 'Kulkas', 'kamar_id' => 2]);

        // Fasilitas Kamar Suite (kamar_id = 3)
        FasilitasKamar::create(['nama_fasilitas' => 'AC', 'kamar_id' => 3]);
        FasilitasKamar::create(['nama_fasilitas' => 'TV', 'kamar_id' => 3]);
        FasilitasKamar::create(['nama_fasilitas' => 'WiFi', 'kamar_id' => 3]);
        FasilitasKamar::create(['nama_fasilitas' => 'Kulkas', 'kamar_id' => 3]);
        FasilitasKamar::create(['nama_fasilitas' => 'Bathtub', 'kamar_id' => 3]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        Kamar::create([
            'nama_kamar'  => 'Kamar Standar',
            'tipe_kamar'  => 'Standar',
            'harga'       => 300000,
            'deskripsi'   => 'Kamar standar dengan fasilitas lengkap',
            'foto'        => null,
        ]);

        Kamar::create([
            'nama_kamar'  => 'Kamar Deluxe',
            'tipe_kamar'  => 'Deluxe',
            'harga'       => 500000,
            'deskripsi'   => 'Kamar deluxe dengan pemandangan taman',
            'foto'        => null,
        ]);

        Kamar::create([
            'nama_kamar'  => 'Kamar Suite',
            'tipe_kamar'  => 'Suite',
            'harga'       => 900000,
            'deskripsi'   => 'Kamar suite mewah dengan fasilitas premium',
            'foto'        => null,
        ]);
    }
}
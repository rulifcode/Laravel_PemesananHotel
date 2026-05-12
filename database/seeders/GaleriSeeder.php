<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        Galeri::create([
            'judul' => 'Lobby Hotel',
            'foto'  => null,
        ]);

        Galeri::create([
            'judul' => 'Kolam Renang',
            'foto'  => null,
        ]);

        Galeri::create([
            'judul' => 'Restoran',
            'foto'  => null,
        ]);

        Galeri::create([
            'judul' => 'Taman',
            'foto'  => null,
        ]);
    }
}
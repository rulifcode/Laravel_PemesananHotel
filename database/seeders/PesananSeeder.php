<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        Pesanan::create([
            'kamar_id'      => 1,
            'nama_pemesan'  => 'Budi Santoso',
            'email_pemesan' => 'budi@gmail.com',
            'hp_pemesan'    => '081234567890',
            'nama_tamu'     => 'Budi Santoso',
            'cek_in'        => '2026-05-15',
            'cek_out'       => '2026-05-17',
            'jml_kamar'     => 1,
            'status'        => 'pending',
        ]);

        Pesanan::create([
            'kamar_id'      => 2,
            'nama_pemesan'  => 'Siti Rahayu',
            'email_pemesan' => 'siti@gmail.com',
            'hp_pemesan'    => '082345678901',
            'nama_tamu'     => 'Siti Rahayu',
            'cek_in'        => '2026-05-18',
            'cek_out'       => '2026-05-20',
            'jml_kamar'     => 1,
            'status'        => 'confirmed',
        ]);

        Pesanan::create([
            'kamar_id'      => 3,
            'nama_pemesan'  => 'Andi Wijaya',
            'email_pemesan' => 'andi@gmail.com',
            'hp_pemesan'    => '083456789012',
            'nama_tamu'     => 'Andi Wijaya',
            'cek_in'        => '2026-05-20',
            'cek_out'       => '2026-05-23',
            'jml_kamar'     => 2,
            'status'        => 'pending',
        ]);
    }
}
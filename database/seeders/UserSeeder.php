<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@hotel.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name'     => 'Resepsionis',
            'email'    => 'resepsionis@hotel.com',
            'password' => Hash::make('password'),
        ]);
    }
}
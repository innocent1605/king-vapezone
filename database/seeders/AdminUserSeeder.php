<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::updateOrCreate(
            ['email' => 'admin@kingvapezone.com'],
            [
                'name' => 'Admin King Vapezone',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'Store King Vapezone Pusat, Jl. Sudirman No. 10',
            ]
        );

        // 2. Kasir
        User::updateOrCreate(
            ['email' => 'kasir@kingvapezone.com'],
            [
                'name' => 'Kasir King Vapezone',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'phone' => '081234567891',
                'address' => 'Store King Vapezone Counter A',
            ]
        );

        // 3. Pelanggan
        User::updateOrCreate(
            ['email' => 'pelanggan@kingvapezone.com'],
            [
                'name' => 'John Doe Vaper',
                'password' => Hash::make('password123'),
                'role' => 'pelanggan',
                'phone' => '081234567892',
                'address' => 'Jl. Merdeka No. 45, Jakarta Selatan',
            ]
        );
    }
}

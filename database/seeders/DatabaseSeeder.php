<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Nature Clean',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Owner
        User::create([
            'name' => 'Owner Nature Clean',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        // 3. Buat Data Settings
        Setting::create([
            'key' => 'kuota_deep_clean',
            'value' => 10,
        ]);
        
        Setting::create([
            'key' => 'kuota_fast_clean',
            'value' => 20,
        ]);

        // 4. Panggil Seeder lainnya
        $this->call([
            ServiceSeeder::class,
        ]);
    }
}
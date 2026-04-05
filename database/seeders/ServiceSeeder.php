<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    \App\Models\Service::create([
        'nama_layanan' => 'Deep Clean',
        'harga' => 50000,
        'kuota' => 10
    ]);
    \App\Models\Service::create([
        'nama_layanan' => 'Un-yellowing',
        'harga' => 75000,
        'kuota' => 5
    ]);
}
}

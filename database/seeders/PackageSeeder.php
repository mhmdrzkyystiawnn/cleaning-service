<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Package::create([
            'name' => 'Basic Package',
            'description' => 'Paket dasar untuk pembersihan rutin',
            'price' => 299000,
            'features' => ['Pembersihan ruang umum', 'Sapu dan pel lantai', 'Bersihkan kamar mandi', 'Bersihkan dapur'],
            'duration' => '2 jam',
            'max_area' => 100,
        ]);

        \App\Models\Package::create([
            'name' => 'Standard Package',
            'description' => 'Paket standar dengan layanan lebih komprehensif',
            'price' => 499000,
            'features' => ['Semua fitur Basic', 'Lap debu furniture', 'Bersihkan cermin dan jendela', 'Bersihkan kamar tidur', 'Vakum karpet'],
            'duration' => '3 jam',
            'max_area' => 200,
        ]);

        \App\Models\Package::create([
            'name' => 'Premium Package',
            'description' => 'Paket premium dengan layanan lengkap dan detail',
            'price' => 749000,
            'features' => ['Semua fitur Standard', 'Deep cleaning kamar mandi', 'Bersihkan rak dan lemari', 'Pembersihan detail rutin', 'Deodorasi ruangan', 'Lap furniture khusus'],
            'duration' => '4 jam',
            'max_area' => 300,
        ]);

        \App\Models\Package::create([
            'name' => 'Deluxe Package',
            'description' => 'Paket deluxe dengan layanan eksklusif',
            'price' => 999000,
            'features' => ['Semua fitur Premium', 'Pembersihan kitchenware', 'Pembersihan karpet profesional', 'Pembersihan sofa', 'Organisasi ruangan', 'Konsultasi kebersihan gratis'],
            'duration' => '5 jam',
            'max_area' => 500,
        ]);
    }
}

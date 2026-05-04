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
            'name' => 'Residential Cleaning',
            'description' => 'Layanan pembersihan rumah komprehensif untuk memberikan rumah impian Anda kebersihan maksimal.',
            'icon' => 'home',
        ]);

        \App\Models\Service::create([
            'name' => 'Office Cleaning',
            'description' => 'Layanan pembersihan kantor profesional untuk menciptakan lingkungan kerja yang bersih dan produktif.',
            'icon' => 'building',
        ]);

        \App\Models\Service::create([
            'name' => 'Carpet & Upholstery Cleaning',
            'description' => 'Pembersihan karpet dan perabot profesional menggunakan teknologi terkini.',
            'icon' => 'sofa',
        ]);

        \App\Models\Service::create([
            'name' => 'Deep Cleaning',
            'description' => 'Pembersihan menyeluruh yang menjangkau area-area tersembunyi dan sulit dijangkau.',
            'icon' => 'sparkles',
        ]);
    }
}

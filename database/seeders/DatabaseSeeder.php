<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@cleaningservice.com',
            'password' => 'password123',
            'is_admin' => true,
        ]);

        // Buat user biasa
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'is_admin' => false,
        ]);

        // Jalankan seeders lainnya
        $this->call([
            ServiceSeeder::class,
            PackageSeeder::class,
            FAQSeeder::class,
        ]);
    }
}

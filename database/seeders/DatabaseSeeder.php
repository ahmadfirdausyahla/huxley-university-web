<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Comment/hapus factory bawaan Laravel ini:
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 2. Panggil UserSeeder untuk Admin yang sudah kita buat:
        $this->call([
            UserSeeder::class,
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Super Admin',
                'email'    => 'admin@duke.edu',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
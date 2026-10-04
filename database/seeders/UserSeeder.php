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
            ['username' => 'adminhuxley'],
            [
                'name'     => 'Huxley Admin',
                'email'    => 'adminhuxley@gmail.com',
                'password' => Hash::make('adminhuxley123'),
            ]
        );
    }
}
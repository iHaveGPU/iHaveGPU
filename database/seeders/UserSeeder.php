<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                    // ✅ import โมเดล
use Illuminate\Support\Facades\Hash;    // ✅ import Hash

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Staff
        User::updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        // Customer
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );
    }
}

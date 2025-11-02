<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
    UsersSeeder::class,
    AddCPUSeeder::class,
    AddVGASeeder::class,
    AddRamSeeder::class,
    AddSSDSeeder::class,
    AddKeyboardSeeder::class,
    AddPSUSeeder::class,
    AddCaseSeeder::class,
    AddMonitorSeeder::class,
    AddMouseSeeder::class, 
    AddArticleSeeder::class,
    AddContactSeeder::class,
    AddComputerSetSeeder::class,
        ]);
    }
}

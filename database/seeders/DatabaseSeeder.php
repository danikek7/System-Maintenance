<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan UserSeeder
        $this->call(UserSeeder::class);
        $this->call(StatusLabelSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(AssetSeeder::class);
        $this->call(MaintenanceScheduleSeeder::class);
    }
}
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
        $this->call(PermissionGroupsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StatusLabelsSeeder::class);
        $this->call(ModelsSeeder::class);
        $this->call(ManufacturesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(UserGroupSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(AssetsSeeder::class);
         $this->call([
        JadwalSeeder::class,
    ]);
    }
}
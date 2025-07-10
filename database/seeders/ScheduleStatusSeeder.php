<?php

// database/seeders/ScheduleStatusSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schedule_statuses')->insert([
            ['id' => 1, 'name' => 'Draft',        'color' => 'bg-gray-300 text-gray-800', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Diajukan',     'color' => 'bg-blue-300 text-blue-800', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Dilaksanakan', 'color' => 'bg-yellow-300 text-yellow-800', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Terlaksana',   'color' => 'bg-green-300 text-green-800', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

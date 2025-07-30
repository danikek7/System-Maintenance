<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('models')->insert([
            [
                'id' => 1,
                'name' => 'IT',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 5:11'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 5:11'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 2,
                'name' => 'IT',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 5:24'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 5:24'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 3,
                'name' => 'IT',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 6:19'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 6:19'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 4,
                'name' => 'IT',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 7:12'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 7:12'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 5,
                'name' => 'IT',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 8:05'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 8:05'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
        ]);
    }
}

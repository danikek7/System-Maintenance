<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'PEMEDIK',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '10/06/2025 2:16'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '10/06/2025 2:16'),
                'created_by' => 1,
                'deleted_at' => null,
                'category_type' => 'asset',
                'notes' => null,
            ],
            [
                'id' => 2,
                'name' => 'Log.Umum',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 9:32'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 9:32'),
                'created_by' => 1,
                'deleted_at' => null,
                'category_type' => 'asset',
                'notes' => null,
            ],
        ]);
    }
}

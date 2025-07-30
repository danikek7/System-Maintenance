<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManufacturesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('manufactures')->insert([
            [
                'id' => 1,
                'name' => 'PT. INTIKOM BERLIAN MUSTIKA',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '25/03/2025 7:35'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '25/03/2025 7:35'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 2,
                'name' => 'Kaspersky',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '25/03/2025 7:37'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '25/03/2025 7:37'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 3,
                'name' => 'PANASONIC',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '11/04/2025 0:36'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '11/04/2025 0:36'),
                'created_by' => 2,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 4,
                'name' => 'TIDAK DIKETAHUI',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '11/04/2025 5:24'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '11/04/2025 5:24'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
            [
                'id' => 5,
                'name' => 'JIAMEI',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '11/04/2025 5:32'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '11/04/2025 5:32'),
                'created_by' => null,
                'deleted_at' => null,
                'notes' => null,
            ],
        ]);
    }
}

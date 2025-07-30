<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionGroupsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permission_groups')->insert([
            [
                'id' => 1,
                'name' => 'Pengelola Asset Log.Umum',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '08/04/2025 9:11'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '23/06/2025 13:37'),
                'created_by' => 1,
                'notes' => null,
            ],
            [
                'id' => 2,
                'name' => 'Pengelola Asset Pemedik',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '10/06/2025 2:37'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '10/06/2025 2:37'),
                'created_by' => 1,
                'notes' => null,
            ],
            [
                'id' => 3,
                'name' => 'Admin',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 1:24'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 1:24'),
                'created_by' => 1,
                'notes' => null,
            ],
            [
                'id' => 4,
                'name' => 'Kepala Bagian',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 1:28'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 1:43'),
                'created_by' => 1,
                'notes' => null,
            ],
            [
                'id' => 5,
                'name' => 'Kepala Bidang/Instalasi',
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 1:29'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '12/06/2025 1:29'),
                'created_by' => 1,
                'notes' => null,
            ],
        ]);
    }
}

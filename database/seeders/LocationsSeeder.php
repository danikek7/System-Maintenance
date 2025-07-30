<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'id' => 1,
                'lokasi' => 'ICU',
                'manager_id' => 2,
                'nama_manager' => 'Koordinator/Kepala Ruangan ICU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 38,
                'lokasi' => 'TIM IT',
                'manager_id' => 2,
                'nama_manager' => 'TIM IT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssetsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('assets')->insert([
            [
                'id' => 1795,
                'name' => 'CONVERTER HDMI TO VGA',
                'asset_tag' => 'RSFM-01795',
                'model_id' => 179,
                'serial' => '-',
                'notes' => '-',
                'created_by' => 2,
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 5:12'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '18/06/2025 6:55'),
                'deleted_at' => null,
                'status_id' => 2,
                'rtd_location' => 38,
                'location_id' => 38,
            ],
        ]);
    }
}

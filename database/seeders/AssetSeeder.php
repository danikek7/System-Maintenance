<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        Asset::insert([
            [
                'id' => 1793,
                'name' => 'AC',
                'asset_tag' => 'RSFM-01793',
                'model_id' => null,
                'serial' => '-',
                'notes' => 'AC 1 PK',
                'created_by' => 2,
                'status_id' => 2,
                'rtd_location' => null,
                'location_id' => null,
                'created_at' => '2025-06-18 04:57:00',
                'updated_at' => '2025-06-18 06:55:00',
            ],
            [
                'id' => 1794,
                'name' => 'BRACKET KOMPUTER',
                'asset_tag' => 'RSFM-01794',
                'model_id' => null,
                'serial' => '-',
                'notes' => '-',
                'created_by' => 2,
                'status_id' => 2,
                'rtd_location' => null,
                'location_id' => null,
                'created_at' => '2025-06-18 05:04:00',
                'updated_at' => '2025-06-18 09:22:00',
            ],
            [
                'id' => 1795,
                'name' => 'CONVERTER HDMI TO VGA',
                'asset_tag' => 'RSFM-01795',
                'model_id' => null,
                'serial' => '-',
                'notes' => '-',
                'created_by' => 2,
                'status_id' => 2,
                'rtd_location' => null,
                'location_id' => null,
                'created_at' => '2025-06-18 05:12:00',
                'updated_at' => '2025-06-18 06:55:00',
            ],
            [
                'id' => 1796,
                'name' => 'BRACKET KOMPUTER',
                'asset_tag' => 'RSFM-01796',
                'model_id' => null,
                'serial' => '-',
                'notes' => '-',
                'created_by' => 2,
                'status_id' => 2,
                'rtd_location' => null,
                'location_id' => null,
                'created_at' => '2025-06-18 05:14:00',
                'updated_at' => '2025-06-18 09:23:00',
            ],
            [
                'id' => 1797,
                'name' => 'CCTV',
                'asset_tag' => 'RSFM-01797',
                'model_id' => null,
                'serial' => '-',
                'notes' => 'CCTV LAN',
                'created_by' => 2,
                'status_id' => 2,
                'rtd_location' => null,
                'location_id' => null,
                'created_at' => '2025-06-18 05:17:00',
                'updated_at' => '2025-06-18 09:20:00',
            ],
        ]);
    }
}

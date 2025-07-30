<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaintenanceSchedule;
use App\Models\Asset;
use Faker\Factory;

class MaintenanceScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $assets = Asset::all();

        $jadwal_nama = [
    'Jadwal Pemeliharaan Bulan Agustus di Poli Umum',
    'Pengecekan AC Ruang Rawat Inap',
    'Pemeriksaan Generator Lantai 3',
    'Perawatan Alat Medis IGD',
    'Cek Rutin Tangki Air Gedung A',
];

foreach ($assets as $i => $asset) {
    MaintenanceSchedule::create([
        'nama_jadwal'   => $jadwal_nama[$i % count($jadwal_nama)],
        'asset_id'      => $asset->id,
        'schedule_date' => now()->addDays(rand(1, 30)),
        'created_by'    => 1,
        'status'        => 1,
        'model_id'      => $asset->model_id,
        'location_id'   => $asset->location_id,
    ]);
}

    }
}



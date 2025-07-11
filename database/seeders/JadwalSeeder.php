<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\DetailJadwal;
use App\Models\Asset;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();
        try {
            // Buat lokasi
            $lokasi = Location::create(['lokasi' => 'Gedung A', 'lokasi' => 'Lantai 1']);

            // Buat beberapa aset untuk lokasi ini
            $aset1 = Asset::create([
                'name' => 'AC Ruang Rapat',
                'asset_tag' => 'AC001',
                'location_id' => $lokasi->id,
                'model_id' => 1,
                'status_id' => '1',
            ]);

            $aset2 = Asset::create([
                'name' => 'Kamera CCTV',
                'asset_tag' => 'CCTV01',
                'location_id' => $lokasi->id,
                'model_id' => 1,
                'status_id' => '2',
            ]);

            // Buat jadwal
            $jadwal = Jadwal::create([
                'nama'       => 'Jadwal Bulan Juli',
                'bulan'      => '2025-07',
                'status_id'     => 1,
                'create_by'  => 1,
                'create_at'  => now(),
                'status_inspeksi' => 0
            ]);

            // Tambah detail_jadwal
            DetailJadwal::create([
                'jadwal_id'     => $jadwal->id,
                'asset_id'      => $aset1->id,
                'nama_asset'    => $aset1->name,
                'location_id'   => $lokasi->id,
                'nama_location' => $lokasi->nama,
                'inspeksi_at'   => now(),
            ]);

            DetailJadwal::create([
                'jadwal_id'     => $jadwal->id,
                'asset_id'      => $aset2->id,
                'nama_asset'    => $aset2->name,
                'location_id'   => $lokasi->id,
                'nama_location' => $lokasi->nama,
                'inspeksi_at'   => now(),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Location::insert([
            [
                'id' => 1,
                'lokasi' => 'ICU',
                'manager_id' => null,
                'nama_manager' => 'Koordinator/Kepala Ruangan ICU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'lokasi' => 'INSTALASI LABORATORIUM',
                'manager_id' => null,
                'nama_manager' => 'Koordinator/Kepala Ruangan Instalasi Laboratorium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'lokasi' => 'INSTALASI GAWAT DARURAT',
                'manager_id' => null,
                'nama_manager' => 'Koordinator/Kepala Ruangan Instalasi Gawat Darurat (IGD)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'lokasi' => 'INSTALASI KAMAR BERSALIN & PENYAKIT KANDUNGAN',
                'manager_id' => null,
                'nama_manager' => 'Koordinator/Kepala Ruangan Instalasi Kamar Bersalin & Penyakit Kandungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'lokasi' => 'INSTALASI KAMAR OPERASI',
                'manager_id' => null,
                'nama_manager' => 'Koordinator/Kepala Ruangan Instalasi Kamar Operasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'lokasi' => 'INSTALASI RADIOLOGI',
                'manager_id' => null,
                'nama_manager' => 'Koordinator/Kepala Ruangan Instalasi Radiologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

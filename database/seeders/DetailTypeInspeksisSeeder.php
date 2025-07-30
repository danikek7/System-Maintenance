<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailTypeInspeksisSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'mengecek roll karet penarik kertas',
            'cek noozle',
            'cek volume tinta',
            'cek kebersihan printer',
            'cek roll',
            'cek volume pembuangan tinta'
        ];

        foreach ($data as $index => $nama) {
            DB::table('detail_type_inspeksis')->insert([
                'id' => $index + 1,
                'id_type_inspeksi' => 1, // FK ke type_inspeksis (Printer)
                'nama' => $nama,
                'create_by' => 1, // Sesuaikan jika perlu
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

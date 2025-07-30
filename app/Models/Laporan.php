<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    // Nama tabel khusus, karena tabel tidak default jamak dari model
    protected $table = 'detail_jadwal_inspeksis';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'id_detail_jadwal',
        'id_detail_type_inspeksi',
        'notes',
        'hasil_indikator',
        'status',
        'create_by',
        'created_at',
        'updated_at',
    ];

    // Jika kamu menggunakan timestamps, ini sudah default true,
    // tapi kalau nama kolom created_at, updated_at standar, gak perlu diubah

    public $timestamps = true;

    // Relasi ke DetailJadwal
    public function detailJadwal()
    {
        return $this->belongsTo(DetailJadwal::class, 'id_detail_jadwal');
    }

    // Relasi ke TypeInspeksi
    public function typeInspeksi()
    {
        return $this->belongsTo(DetailTypeInspeksi::class, 'id_detail_type_inspeksi');
    }
    
}

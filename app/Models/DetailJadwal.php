<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailJadwal extends Model
{
    protected $table = 'detail_jadwals';

    // Kolom yang bisa diisi massal (fillable)
    protected $fillable = [
        'jadwal_id',
        'asset_id',
        'nama_asset',
        'location_id',
        'nama_location',
        'inspeksi_at',
    ];

    // Jika kamu pakai timestamps (created_at, updated_at)
    public $timestamps = true;

    // Relasi ke Jadwal (banyak detail dimiliki oleh satu jadwal)
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    // Relasi ke Asset
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    // Relasi ke Location
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}

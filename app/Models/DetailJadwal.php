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

    // Menghasilkan teks status gabungan dari pic_status dan manager_status
    public function getStatusLaporanLabelAttribute()
    {
        if ($this->pic_status == 0 && $this->manager_status == 0) {
            return 'Draft';
        }

        if ($this->pic_status == 1 && $this->manager_status == 0) {
            return 'Diajukan ke PIC';
        }

        if ($this->pic_status == 2 && $this->manager_status == 0) {
            return 'Menunggu persetujuan Manager';
        }

        if ($this->pic_status == 2 && $this->manager_status == 1) {
            return 'Selesai';
        }

        return 'Status tidak diketahui';
    }

    public function getStatusLaporanCodeAttribute()
    {
        // Jika belum ada laporan sama sekali (misal: cek relasi detailJadwalInspeksis kosong)
        if (!$this->sudah_ada_laporan) {
            return -1; // Belum dibuat
        }

        if ($this->pic_status == 0 && $this->manager_status == 0) {
            return 0; // Draft
        }

        if ($this->pic_status == 1 && $this->manager_status == 0) {
            return 1; // Diajukan ke PIC
        }

        if ($this->pic_status == 2 && $this->manager_status == 0) {
            return 2; // Menunggu persetujuan Manager
        }

        if ($this->pic_status == 2 && $this->manager_status == 1) {
            return 3; // Selesai
        }

        return -1; // Default status tidak diketahui
    }
    public function detailJadwalInspeksis()
    {
        return $this->hasMany(\App\Models\DetailJadwalInspeksi::class, 'id_detail_jadwal');
    }

    public function getSudahAdaLaporanAttribute()
    {
        return $this->detailJadwalInspeksis()->exists();
    }
    public function laporans()
{
    return $this->hasMany(\App\Models\Laporan::class, 'id_detail_jadwal');
}
public function pelaksana()
{
    return $this->belongsTo(User::class, 'inspeksi_by');
}

}

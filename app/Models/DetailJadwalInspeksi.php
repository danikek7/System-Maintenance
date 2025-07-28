<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailJadwalInspeksi extends Model
{
    protected $table = 'detail_jadwal_inspeksis';
    public $timestamps = true;

    protected $fillable = [
        'id_detail_jadwal',
        'id_detail_type_inspeksi',
        'notes',
        'hasil_indikator',
        'create_by',
        'created_at',
        'updated_at'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function detailType()
    {
        return $this->belongsTo(DetailTypeInspeksi::class, 'id_detail_type_inspeksi', 'id');
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            0 => 'Draf',
            1 => 'Submit',
            2 => 'Waiting',
            3 => 'Done',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }
    public function detailJadwal()
    {
        // Asumsi foreign key di tabel detail_jadwal_inspeksis adalah id_detail_jadwal
        // dan primary key di tabel detail_jadwals adalah id
        return $this->belongsTo(DetailJadwal::class, 'id_detail_jadwal', 'id');
    }
    public function indikator()
    {
        return $this->belongsTo(DetailTypeInspeksi::class, 'id_detail_type_inspeksi');
    }
}

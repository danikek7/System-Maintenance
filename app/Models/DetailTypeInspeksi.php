<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTypeInspeksi extends Model
{
    use HasFactory;

    protected $table = 'detail_type_inspeksis';

    protected $fillable = [
        'id_type_inspeksi',
        'nama',
        'create_by'
    ];

    // Relasi ke type_inspeksis
    public function typeInspeksi()
    {
        return $this->belongsTo(TypeInspeksi::class, 'id_type_inspeksi');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'detail_type_inspeksi_id');
    }
}

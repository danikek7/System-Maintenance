<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeInspeksi extends Model
{
    use HasFactory;

    protected $table = 'type_inspeksis';

    protected $fillable = [
        'nama',
    ];

    // Relasi ke detail_type_inspeksis
    public function detailParameters()
    {
        return $this->hasMany(DetailTypeInspeksi::class, 'id_type_inspeksi');
    }
    public function details()
    {
        return $this->hasMany(DetailTypeInspeksi::class);
    }
    public function detailTypeInspeksis()
    {
        return $this->hasMany(DetailTypeInspeksi::class, 'id_type_inspeksi', 'id');
    }
}

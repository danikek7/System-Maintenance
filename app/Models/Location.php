<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations'; // nama tabel sesuai database

    protected $primaryKey = 'id'; // default sebenarnya sudah id, tapi buat eksplisit

    protected $fillable = [
        'lokasi',
        'manager_id',
        'nama_manager',
    ];

    // Jika kamu ingin relasi ke manager (jika ada tabel manager)
    // public function manager()
    // {
    //     return $this->belongsTo(Manager::class, 'manager_id');
    // }

     public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}

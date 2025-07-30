<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations'; // Nama tabel di database

    protected $primaryKey = 'id'; // ID sebagai primary key

    protected $fillable = [
        'lokasi',
        'manager_id',
        'nama_manager',
    ];

    // Relasi ke user yang menjadi manager
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Relasi ke aset yang berada di lokasi ini
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    // Relasi ke jadwal pemeliharaan di lokasi ini
    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}

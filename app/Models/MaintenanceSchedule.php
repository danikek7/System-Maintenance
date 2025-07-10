<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    protected $table = 'maintenance_schedule'; // sesuaikan nama tabel
    
    protected $fillable = [
        'asset_id',
        'schedule_date',
        'name_schedule',
        'location_id',
        'status',
        // tambahkan kolom lain jika ada
    ];

    // Relasi ke lokasi (misal tabel locations)
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}

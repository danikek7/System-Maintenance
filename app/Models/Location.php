<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
<<<<<<< HEAD
=======
    protected $table = 'locations'; // nama tabel sesuai database

    protected $primaryKey = 'id'; // default sebenarnya sudah id, tapi buat eksplisit

>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01
    protected $fillable = [
        'lokasi',
        'manager_id',
        'nama_manager',
    ];

<<<<<<< HEAD
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}

=======
    // Jika kamu ingin relasi ke manager (jika ada tabel manager)
    // public function manager()
    // {
    //     return $this->belongsTo(Manager::class, 'manager_id');
    // }
}
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $primaryKey = 'id';

    // Sesuaikan dengan kolom custom
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'nama',
        'bulan',
        'status_jadwal',
        'manager_id',
        'location_id',
        'create_at',
        'update_at',
        'create_by',
        'update_by',
        'approve_at',
    ];

    protected $casts = [
        'create_at' => 'datetime',
        'update_at' => 'datetime',
        'approve_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function detailJadwal()
    {
        return $this->hasMany(DetailJadwal::class, 'jadwal_id');
    }

    public function details()
    {
        return $this->hasMany(DetailJadwal::class, 'jadwal_id', 'id');
    }
    public function type_inspeksi()
    {
        return $this->belongsTo(TypeInspeksi::class, 'type_inspeksi_id'); // sesuaikan foreign key-nya
    }
 

}

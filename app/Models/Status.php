<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusLabel extends Model
{
    use SoftDeletes;

    protected $table = 'status_label'; // sesuaikan nama tabelnya

    protected $fillable = [
        'name',
        'created_by',
        'deployable',
        'pending',
        'archived',
        'notes',
        'color',
        'show_in_nav',
        'default_label',
    ];

    // Relasi ke user pembuat status label
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke aset (jika perlu)
    public function assets()
    {
        return $this->hasMany(Asset::class, 'status_id');
    }

    // Relasi ke jadwal maintenance (jika status dipakai di sana)
    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, 'status_id');
    }
}

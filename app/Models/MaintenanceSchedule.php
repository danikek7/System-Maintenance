<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    use HasFactory;

    protected $table = 'maintenance_schedule';

    protected $fillable = [
        'asset_id',
        'schedule_date',
        'name_schedule',
        'location_id',
        'status',
        'created_by',
        'model_id',
    ];

    // Relasi ke asset
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    // Relasi ke lokasi
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    // Relasi ke status label
    public function statusLabel()
    {
        return $this->belongsTo(StatusLabel::class, 'status');
    }

    // Relasi ke status khusus untuk schedule, jika dibedakan
    public function scheduleStatus()
    {
        return $this->belongsTo(ScheduleStatus::class, 'status');
    }
}

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
        'created_by',
        'status',
        'model_id',
        'location_id',
    ];

    // public function asset()
    // {
    //     return $this->belongsTo(Asset::class);
    // }
    
    // app/Models/MaintenanceSchedule.php

public function asset()
{
    return $this->belongsTo(Asset::class);
}


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function statusLabel()
    {
        return $this->belongsTo(StatusLabel::class, 'status');
    }

    // app/Models/Asset.php

public function maintenanceSchedules()
{
    return $this->hasMany(MaintenanceSchedule::class);
}

public function edit(MaintenanceSchedule $jadwal)
{
    $locations = Location::all(); // ✅ ambil semua lokasi
    return view('pelaksana.asetjadwal', compact('jadwal', 'locations'));
}

// app/Models/MaintenanceSchedule.php

public function scheduleStatus()
{
    return $this->belongsTo(ScheduleStatus::class, 'status');
}


}

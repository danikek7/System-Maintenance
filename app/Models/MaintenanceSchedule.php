<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01
use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
<<<<<<< HEAD
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


=======
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
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01
}

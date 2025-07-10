<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLabel extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, 'status', 'id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'status_id');
    }

    // Fungsi untuk mengambil status "Disetujui"
    public static function approve()
    {
        return self::where('name', 'Disetujui')->first();
    }

    // Fungsi untuk menyetel status 'Disetujui' pada suatu schedule
    public static function setAsApproved(\App\Models\MaintenanceSchedule $schedule)
    {
        $status = self::approve();
        $schedule->status = $status->id;
        return $schedule->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceReport extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reports'; // Jika kamu memang memakai primary key custom

    // Kalau tidak, gunakan default 'id'

    protected $fillable = [
        'schedule_id',
        'report_date',
        'created_by',
        'parameter1',
        'parameter2',
        'catatan1',
        'catatan2',
        'status',
    ];

    // Relasi ke jadwal
    public function schedule()
    {
        return $this->belongsTo(MaintenanceSchedule::class, 'schedule_id');
    }

    // Relasi ke pembuat laporan
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke label status
    public function statusLabel()
    {
        return $this->belongsTo(StatusLabel::class, 'status');
    }
}

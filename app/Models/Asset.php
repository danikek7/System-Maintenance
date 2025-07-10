<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model_id', 'location_id', 'status_id'];

    // Relasi ke jadwal maintenance
    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }

    // Relasi ke lokasi
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    // Relasi ke status label
    public function statusLabel()
    {
        return $this->belongsTo(StatusLabel::class, 'status_id');
    }

    // ✅ Relasi ke model scanner (AssetModel)
    public function model()
    {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'asset_tag',
        'model_id',
        'serial',
        'notes',
        'created_by',
        'status_id',
        'rtd_location',
        'location_id',
    ];

    public function model()
    {
        return $this->belongsTo(ModelType::class); // Ganti dengan ModelType jika kamu gunakan nama model kustom
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(StatusLabel::class, 'status_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    protected $table = 'assets';

    protected $fillable = [
        'name',
        'asset_tag',
        'model_id',
        'kategori_id',
        'serial',
        'notes',
        'created_by',
        'status_id',
        'produsen_id',
        'rtd_location',
        'location_id',
    ];

    // Relasi ke model ModelAssets
    public function model()
    {
        return $this->belongsTo(ModelAssets::class, 'model_id')->withTrashed();
    }

    // Relasi ke user yang membuat asset
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke status label
    public function status()
    {
        return $this->belongsTo(StatusLabel::class, 'status_id');
    }

    // Relasi ke lokasi
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    // Relasi ke produsen
    public function produsen()
    {
        return $this->belongsTo(Manufacture::class, 'produsen_id');
    }

    // Relasi ke jadwal pemeliharaan
    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}

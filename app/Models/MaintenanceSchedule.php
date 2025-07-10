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

    /**
     * Relasi ke aset
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    /**
     * Relasi ke lokasi
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * Relasi ke status label
     */
    public function statusLabel()
    {
        return $this->belongsTo(StatusLabel::class, 'status');
    }

    /**
     * Relasi ke model aset (opsional jika kamu punya tabel models)
     */
    public function model()
    {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }

    /**
     * Relasi ke user yang membuat (opsional)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

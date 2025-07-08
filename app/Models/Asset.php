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
        'serial',
        'notes',
        'created_by',
        'status_id',
        'rtd_location',
        'location_id',
    ];

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

    // Relasi ke model (misalnya tipe asset)
    public function model()
    {
        return $this->belongsTo(ModelName::class, 'model_id');
    }

    // Relasi ke user pembuat
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

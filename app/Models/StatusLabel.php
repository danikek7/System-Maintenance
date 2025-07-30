<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusLabel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'deployable',
        'pending',
        'archived',
        'notes',
        'color',
        'show_in_nav',
        'default_label',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'status_id');
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, 'status');
    }
}


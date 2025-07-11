<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'bulan',
        'status',
        'manager_id',
        'lokasi',
        'assets',
        'create_at',
        'update_at',
        'create_by',
        'update_by',
        'approve_at',
    ];

    protected $casts = [
        'assets' => 'array',
        'create_at' => 'datetime',
        'update_at' => 'datetime',
        'approve_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }

    public function lokasi()
    {
        return $this->belongsTo(Location::class, 'lokasi');
    }
    public function details()
{
    return $this->hasMany(DetailJadwal::class, 'jadwal_id');
}

}

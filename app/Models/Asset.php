<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
=======
use App\Models\Location;
use App\Models\ModelAssets;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

    protected $table = 'assets';
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01

    protected $fillable = [
        'name',
        'asset_tag',
        'model_id',
<<<<<<< HEAD
=======
        'kategori_id',
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01
        'serial',
        'notes',
        'created_by',
        'status_id',
<<<<<<< HEAD
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

=======
        'produsen_id',
        'location_id',
    ];

    /**
     * Relasi ke tabel locations
     */
    public function lokasi()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function model()
    {
        return $this->belongsTo(ModelAssets::class, 'model_id')->withTrashed();
    }
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function produsen()
    {
        return $this->belongsTo(Manufacture::class, 'produsen_id');
    }
}
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01

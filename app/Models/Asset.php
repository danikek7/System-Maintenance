<?php

namespace App\Models;

use App\Models\Location;
use App\Models\ModelAssets;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    use HasFactory;

    protected $table = 'models'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['name']; // atau kolom lain di tabel models

    public function assets()
    {
        return $this->hasMany(Asset::class, 'model_id');
    }
}

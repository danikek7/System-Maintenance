<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';  // sesuaikan nama tabelmu

    protected $fillable = ['name', 'created_by', 'notes'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'kategori_id');
    }
}

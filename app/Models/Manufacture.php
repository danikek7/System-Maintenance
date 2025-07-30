<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacture extends Model
{
    use SoftDeletes;

    protected $table = 'manufactures';

    protected $fillable = [
        'name',
        'created_by',
        'notes',
    ];
}

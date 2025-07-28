<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Location; 

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Primary key tetap 'id' sesuai migration baru
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Kolom yang bisa diisi massal
     */
    protected $fillable = [
        'email',
        'password',
        'activated',
        'created_by',
        'activation_code',
        'activated_at',
        'last_login',
        'reset_password_code',
        'first_name',
        'last_name',
        'employee_num',
        'username',
        'notes',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_code',
        'reset_password_code',
    ];

    /**
     * Casts untuk atribut tertentu
     */
    protected $casts = [
        'password' => 'hashed',
        'activated' => 'boolean',
        'activated_at' => 'datetime',
        'last_login' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Untuk autentikasi pakai kolom username
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    /**
     * Relasi ke user yang membuat user ini
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    // User.php

public function manager()
{
    return $this->belongsTo(User::class, 'manager_id');
}

public function subordinates()
{
    return $this->hasMany(User::class, 'manager_id');
}
// public function locations()
// {
//     return $this->hasMany(Location::class, 'manager_id', 'id');
// }
public function location()
{
    return $this->belongsTo(Location::class, 'location_id');
}


}

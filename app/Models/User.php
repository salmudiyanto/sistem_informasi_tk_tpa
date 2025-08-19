<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role', 'related_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'related_id');
    }

    public function wali()
    {
        return $this->belongsTo(Wali::class, 'related_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function related()
    {
        return $this->belongsTo(
            $this->role === 'admin' ? null : 
            ($this->role === 'guru' ? Guru::class : Wali::class),
            'related_id'
        );
    }
}

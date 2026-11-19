<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'Login',
        'Password',
        'Role_ID',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function role()
    {

        return $this->belongsTo(\App\Models\Role::class, 'Role_ID', 'Role_ID');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactroy;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'user';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
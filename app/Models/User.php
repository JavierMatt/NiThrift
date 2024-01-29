<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'email',
        'password',
        'province',
        'city',
        'postcalCode',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function detailProducts()
    {
        return $this->hasMany(DetailProduct::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}

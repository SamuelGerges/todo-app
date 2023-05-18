<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        if(!empty($password)){
            return $this->attributes['password'] = bcrypt($password);
        }
    }

    public function review()
    {
        return $this->hasMany(Review::class,'user_id','id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'user_id','id');
    }
}

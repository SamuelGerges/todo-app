<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable =[
        'title',
        'description',
        'user_id',
    ];


    public function scopeSelection($query)
    {
        return $query->select('id','title','description','user_id');
    }
    public function details()
    {
        return $this->hasOne(ProductDetail::class,'product_id','id');
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imagable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

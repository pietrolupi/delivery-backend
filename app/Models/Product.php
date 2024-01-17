<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->using(OrderProduct::class)->withPivot(['product _quantity']);
    }

    protected $fillable = [
        'name',
        'restaurant_id',
        'ingredients',
        'description',
        'price',
        'visibility',
        'image',
    ];
}

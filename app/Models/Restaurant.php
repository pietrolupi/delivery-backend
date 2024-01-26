<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function orders(){
        return $this->hasManyThrough(Order::class, OrderProduct::class, 'product_id', 'id', 'id', 'order_id')
            ->distinct(); // Adding distinct to avoid duplicate orders when multiple products have the same order
    }


    protected static function booted()
    {
        static::deleting(function ($restaurant) {
            // Delete all orders associated with the restaurant
            $restaurant->orders()->delete();
        });
    }
}

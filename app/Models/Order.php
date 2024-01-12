<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static function getTotalPrice(Order $order){

        $total_price = 0;

        $products = $order->products;

        foreach($products as $product){

            $total_price += $product->price;
        }

        return $total_price;
    }

    public function products(){
        return $this->belongsToMany(Product::class)->using(OrderProduct::class)->withPivot(['order_quantity']);
    }

    protected $fillable = [
        'date',
        'total_price',
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_phone',
    ];
}

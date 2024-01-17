<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Type;
use App\Models\Order;
use App\Models\OrderProduct;


class PageController extends Controller
{
    public function index(){

        $restaurants = Restaurant::with('types', 'products')->get();

        return response()->json($restaurants);

    }

    public function getTypes(){

        $types = Type::with('restaurants')->get();

        return response()->json($types);
    }


}

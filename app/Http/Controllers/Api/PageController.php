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
    public function index(Request $request){
        $types = $request->query('types');

        if ($types) {
            // Inizia la query
            $query = Restaurant::query();

            // Aggiungi una clausola whereHas per ogni tipo
            foreach ($types as $type) {
                $query->whereHas('types', function ($query) use ($type) {
                    $query->where('name', $type);
                });
            }

            // Ottieni i ristoranti con i loro tipi e prodotti
            $restaurants = $query->with('types', 'products')->get();
        } else {
            // Se non ci sono tipi specificati, restituire tutti i ristoranti
            $restaurants = Restaurant::with('types', 'products')->get();
        }

        return response()->json($restaurants);
    }

    public function getTypes(){

        $types = Type::with('restaurants')->get();

        return response()->json($types);
    }
    //Funzione dettaglio ristorante
    public function getRestaurantById($id){

        $restaurant = Restaurant::with('products')->where('id', $id)->first();

        foreach($restaurant->products as $product){
            $product->image ? $product->image = asset('storage/'. $product->image) : $product->image = asset('img/placeholder.jpg');
        }

        return response()->json($restaurant);

    }

}

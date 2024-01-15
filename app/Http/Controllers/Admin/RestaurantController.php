<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;



class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        return view('admin.restaurant.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.restaurant.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request)
    {
        $form_data = $request->all();
        $form_data['user_id'] = Auth::id();

        $new_restaurant = new Restaurant();
         // se esiste la chiave image salvo l'immagine nel file system e nel database
        if(array_key_exists('image', $form_data)) {

            // prima di salvare il file prendo il nome del file per salvarlo nel d
            $data['image'] = Storage::put('uploads', $form_data['image']);
        }
        $new_restaurant->fill($form_data);
        $new_restaurant->save();
        if(array_key_exists('types' , $form_data)){
            $new_restaurant->types()->attach($form_data['types']);
        }
            return redirect()->route('admin.restaurant.show' , $new_restaurant->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {

        if($restaurant->user_id != Auth::id()){
            return view('errors.404');
        }

        return view('admin.restaurant.show' , compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.restaurant.index')->with('deleted' , "$restaurant->name was deleted");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        if ($user && $user->restaurant) {
            $products = Product::where('restaurant_id', $user->restaurant->id)->orderBy('name', 'ASC')->get();
            return view ('admin.products.index', compact('products'));
        } else {
            return view('admin.restaurant.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $product = new Product();
        return view('admin.products.create' , compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $form_data = $request->all();

        $exist = Product::where('name', $form_data['name'])->where('restaurant_id', $form_data['restaurant_id'])->first();

        if($exist) {
            return redirect()->route('admin.products.create')->with('error', 'this product is already in your Menu');
        }else {
            $new_product = new Product();
            $new_product->restaurant_id = $form_data['restaurant_id'];

             // se esiste la chiave image salvo l'immagine nel file system e nel database
            if(array_key_exists('image', $form_data)) {

                // prima di salvare il file prendo il nome del file per salvarlo nel d
                $form_data['image'] = Storage::put('uploads', $form_data['image']);
            }

            $new_product->fill($form_data);
            $new_product->save();
            return redirect()->route('admin.products.show', $new_product)->with('success', 'the product was successfully added in your Menu');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $form_data = $request->all();

        if(array_key_exists('image', $form_data)){
            if($product->image){
                Storage::disk('public')->delete($product->image);
            }

            $form_data['image'] = Storage::put('uploads', $form_data['image']);
        }

        $product->update($form_data);
        return redirect()->route('admin.products.show', compact('product'))->with('success', 'the product was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // $product->orders()->detach();

        $product->delete();
        return redirect()->route('admin.products.index')->with('deleted', 'the product was successfully deleted');
    }
}

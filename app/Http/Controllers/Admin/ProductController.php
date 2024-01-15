<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name' , 'ASC')->paginate(10);
        return view('admin.products.index' , compact('products'));
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
        $product->update($form_data);
        return redirect()->route('admin.products.show', compact('product'))->with('success', 'the product was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

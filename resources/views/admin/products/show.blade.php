@extends('layouts.admin')

@section('content')

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h3>{{ $product->name}}</h1>

        <div class="content d-flex flex-column flex-md-row gap-2">
            <div class="image mb-2">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name}}">
            </div>
            <div class="text">
                <p>Ingredients: {{ $product->ingredients }}</p>
                @if($product->description)
                    <p>Description: {{ $product->description }}</p>
                @endif
                <p>Price: {{$product->price}} &euro;</p>
            </div>
        </div>

        <div class="buttons d-flex gap-2">
            @include('generals.buttons.edit_btn', ['route'=>route('admin.products.edit' , $product)])
            @include('generals.buttons.delete_btn', [
                'route' => route('admin.products.destroy', $product),
                'name' => $product->name,
            ])
        </div>



@endsection

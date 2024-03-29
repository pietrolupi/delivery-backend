@extends('layouts.admin')

@section('content')

<div class="p-4">
    @include('generals.partials.sessions')

    <h3>{{ $product->name}}</h1>
    <div class="content d-flex flex-column flex-md-row gap-2">
        <div class="image mb-2 w-25">
            <img src="{{ asset('storage/' . $product->image) }}" onerror="this.src='{{ asset('img/placeholder.jpg') }}'" class="img-fluid " alt="{{ $product->name }}">
        </div>

        <div class="text">
            <p>Ingredients: {{ $product->ingredients }}</p>
            @if($product->description)
                <p>Description: {{ $product->description }}</p>
            @endif
            <p>Price: {{$product->price}} &euro;</p>
            <span class="badge rounded-pill {{ $product->visibility == 1 ? 'text-bg-success' : 'text-bg-danger' }} p-2 mb-2">
                {{ $product->visibility == 1 ? 'Avaliable' : 'Unavaliable' }}
            </span>
            <div class="buttons d-flex gap-2">
                @include('generals.buttons.edit_btn', ['route'=>route('admin.products.edit' , $product)])

                <!-- button delete -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash-can"></i>
                </button>

            </div>
        </div>
    </div>
    @include('generals.buttons.back_btn', ['route' => route('admin.products.index', $product)])

      <!-- Modal -->
      @include('generals.partials.modal')
      <!--/// Modal -->

</div>
@endsection

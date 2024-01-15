@extends('layouts.admin')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>{{ $product->name}}</h1>
        @include('generals.buttons.edit_btn', ['route'=>route('admin.products.edit' , $product)])
        @include('generals.buttons.delete_btn', [
            'route' => route('admin.products.destroy', $product),
            'name' => $product->name,
        ])

    </div>
@endsection
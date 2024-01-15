@extends('layouts.admin')

@section('content')
    <h1>Your Menu</h1>
    @include('generals.buttons.create_btn', [
        'route' => route('admin.products.create'),
        'add' => 'Add a new product',
    ])
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
@endsection

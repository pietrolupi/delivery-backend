@extends('layouts.admin')

@section('content')
    <h1>Lista Prodotti</h1>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
@endsection

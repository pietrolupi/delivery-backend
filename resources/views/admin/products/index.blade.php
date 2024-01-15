@extends('layouts.admin')

@section('content')
    <h1>Your Menu</h1>
    @include('generals.buttons.create_btn', [
        'route' => route('admin.products.create'),
        'add' => 'Add a new product',
    ])

    <div class="d-flex flex-wrap gap-3 flex-column flex-md-row mt-4">

        @foreach ($products as $product)
            {{-- <li>{{ $product->name }}</li> --}}

            <a href="{{ route('admin.products.show', $product)}}">

                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{ $product->name}}</p>
                    </div>
                </div>

            </a>
        @endforeach

    </div>

@endsection

@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')

    <h1>Your Menu</h1>
    @include('generals.buttons.create_btn', [
        'route' => route('admin.products.create'),
        'add' => 'Add a new product',
    ])

    <div class="d-flex flex-wrap gap-3 flex-column flex-md-row align-items-center mt-4">

        @foreach ($products as $product)
            <a href="{{ route('admin.products.show', $product) }}">

                <div class="card product d-flex p-2 flex-column align-items-center justify-content-center {{ $product->visibility == 0 ? 'unavaliable' : '' }}"
                    style="width: 15rem;">
                    <div class="image">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            onerror="this.src='{{ asset('img/placeholder.jpg') }}'"
                            class="img-fluid card-img-top w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body">
                        <h6 class="card-text">{{ $product->name }}</h6>

                        <div class="buttons d-flex gap-2">
                            @include('generals.buttons.edit_btn', [
                                'route' => route('admin.products.edit', $product),
                            ])
                            @include('generals.buttons.delete_btn', [
                                'route' => route('admin.products.destroy', $product),
                                'name' => $product->name,
                            ])
                        </div>
                    </div>
                </div>

            </a>
        @endforeach

    </div>
@endsection

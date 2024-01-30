@extends('layouts.admin')

@section('content')
<div class="p-4">
    @include('generals.partials.sessions')

    <h1>Your Menu</h1>
    <p>On these pages, you can manage your products. Feel free to add, edit, or remove them.</p>
    @include('generals.buttons.create_btn', [
        'route' => route('admin.products.create'),
        'add' => 'Add a new product',
    ])

    <div class="d-flex flex-wrap gap-3 flex-column flex-md-row align-items-center mt-4">

        @foreach ($products as $product)
            <div>
                <a href="{{ route('admin.products.show', $product) }}" class="text-decoration-none">
                    <div class="card product d-flex p-2 flex-column align-items-center justify-content-center {{ $product->visibility == 0 ? 'unavaliable' : '' }}"
                        style="width: 15rem;">
                        <div class="image d-flex align-items-center justify-content-center">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                onerror="this.src='{{ asset('img/placeholder.jpg') }}'"
                                class="img-fluid card-img-top w-50 object-fit-cover" alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <h6 class="card-text text-center">{{ $product->name }}</h6>
                        </div>
                        <div class="buttons d-flex gap-2">
                            @include('generals.buttons.edit_btn', [
                                'route' => route('admin.products.edit', $product),
                            ])
                            <!-- button delete -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>

                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!-- Modal -->
    @include('generals.partials.modal')
    <!--/// Modal -->
    </div>
@endsection

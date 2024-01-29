@extends('layouts.admin')

@section('content')
    <div>
        <h2>Welcome to {{ $restaurant->name }}</h2>

        @if ($restaurant->types->isNotEmpty())

        <div class="content d-flex gap-2">
            <div class="title d-flex align-items-center">
                <span>Types:</span>
            </div>

            <ul class="list-unstyled d-flex flex-wrap gap-2 my-3">
                @foreach ($restaurant->types as $type)
                    <li>
                        <span class="badge-type rounded-pill p-1">{{ $type['name'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="content d-flex flex-column flex-md-row gap-2 mb-2 p-2">
            <div class="image w-50 w-md-25">
                <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}">
            </div>
            <div class="text fw-bold">
                <h4>Your restaurant's details:</h4>
                <p>Address: {{ $restaurant->address }}</p>
                <p>VAT: {{ $user->vat }}</p>
            </div>
        </div>


        @endif
        <div class="btns d-flex gap-2">
            @include('generals.buttons.back_btn', ['route' => route('admin.restaurant.index', $restaurant)])
        </div>
    </div>

@endsection

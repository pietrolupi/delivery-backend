@extends('layouts.admin')

@section('content')
    <div>
        <h2>Welcome to {{ $restaurant->name }}</h2>

        @if ($restaurant->types->isNotEmpty())

        <div class="content d-flex gap-2">
            <div class="title">
                <span>Types:</span>
            </div>

            <ul class="list-unstyled d-flex gap-2">
                @foreach ($restaurant->types as $type)
                    <li>
                        <span class="badge rounded-pill text-bg-info p-2">{{ $type['name'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="content d-flex gap-2 mb-2">
            <div class="image w-25">
                <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}">
            </div>
            <div class="text">
                <p>Address: {{ $restaurant->address }}</p>
            </div>
        </div>


        @endif

        @include('generals.buttons.delete_btn', [
            'route' => route('admin.restaurant.destroy', $restaurant),
            'name' => $restaurant->name,
        ])


    </div>
@endsection

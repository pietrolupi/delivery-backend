@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')


    <h2>Your restaurant:</h2>

        <a href="{{ route('admin.restaurant.show', $restaurant) }}" class="text-decoration-none">
            <div class="card p-3" style="width: 18rem;">
                <div class="image">
                    <img src="{{ asset('storage/' . $restaurant->image) }}" onerror="this.src='{{ asset('img/placeholder.jpg') }}'" class="card-img-top" alt="{{ $restaurant->name}}">
                </div>
                <div class="card-body">
                    <h2 class="card-text text-center">{{ $restaurant->name }}</h2>
                </div>
            </div>
        </a>

@endsection

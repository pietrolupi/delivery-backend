@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')
    
    @if (isset($restaurant->user_id))
    <h2>Your restaurant:</h2>

        <a href="{{ route('admin.restaurant.show', $restaurant) }}" class="text-decoration-none">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                <div class="card-body">
                    <h2 class="card-text text-center">{{ $restaurant->name }}</h2>
                </div>
            </div>
        </a>
    @else
    <h2>Register your restaurant:</h2>
        @include('generals.buttons.register_restaurant_btn', [
            'route' => route('admin.restaurant.create'),
            'add' => 'Register your Restaurant',
        ])
    @endif
@endsection

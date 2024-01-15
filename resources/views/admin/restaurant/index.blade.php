@extends('layouts.admin')

@section('content')
    @if (session('deleted'))
        <div class="alert alert-success" role="alert">
            {{ session('deleted') }}
        </div>
    @endif

    @if (isset($restaurant->user_id))
        <a href="{{ route('admin.restaurant.show', $restaurant) }}" class="text-decoration-none">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                <div class="card-body">
                    <h2 class="card-text text-center">{{ $restaurant->name }}</h2>
                </div>
            </div>
        </a>
    @else
        @include('generals.buttons.register_restaurant_btn', [
            'route' => route('admin.restaurant.create'),
            'add' => 'Register your Restaurant',
        ])
    @endif
@endsection

@extends('layouts.admin')

@section('content')
    <div>
        <h1>Welcome {{ $restaurant->name }}</h1>

        @if ($restaurant->types->isNotEmpty())
            <h2>Tipologie:</h2>
            <ul>
                @foreach ($restaurant->types as $type)
                    <li>{{ $type['name'] }}</li>
                @endforeach
            </ul>
        @endif

        @include('generals.buttons.delete_btn', [
            'route' => route('admin.restaurant.destroy', $restaurant),
            'name' => $restaurant->name,
        ])


    </div>
@endsection

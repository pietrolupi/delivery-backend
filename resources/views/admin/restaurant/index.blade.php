

@extends('layouts.admin')

@section('content')

{{-- @dd($restaurant) --}}
    @foreach ( $restaurant as $item )

        @if (!isset($restaurant->user_id))
        <h2>{{ $item->name }}</h2>
        @else
        <h2>ti odio</h2>
        @endif

    @endforeach


@endsection

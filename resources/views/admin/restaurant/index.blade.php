

@extends('layouts.admin')

@section('content')

{{-- @dd($restaurant) --}}
    @foreach ( $restaurant as $item )

        @if (isset($item->user_id))
        <h2>{{ $item->name }}</h2>
        @else
        <h2>no restaurant</h2>
        @endif

    @endforeach


@endsection

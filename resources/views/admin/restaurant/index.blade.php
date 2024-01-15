@extends('layouts.admin')

@section('content')

@if(isset($restaurant->user_id))
    <h2>{{$restaurant->name}}</h2>
@else
    <a href="{{route('admin.restaurant.create')}}"> INSERISCI UN RISTORANTE</a>
@endif

@endsection



@extends('layouts.admin')

@section('content')

@if(isset($restaurant->user_id))
    <h2>{{$restaurant->name}}</h2>
@else
    <h2>INSERISCI UN RISTORANTE</h2>
@endif

@endsection

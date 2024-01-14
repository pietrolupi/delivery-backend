@extends('layouts.admin')

@section('content')

@if(isset($restaurant->user_id))
<div class="card" style="width: 18rem;">
    <img src="{{ asset('storage/' . $restaurant->image) }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h2 class="card-text">{{$restaurant->name}}</h2>
    </div>
</div>
@else
    @include('generals.botons.create_boton', ['route' => route('admin.restaurant.create'), 'add' => 'Register your Restaurant'])
@endif


@endsection

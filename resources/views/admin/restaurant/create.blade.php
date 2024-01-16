@extends('layouts.admin')

@section('content')

<div class="container">

    <h1 class="mt-5">Create Restaurant</h1>

    <form
    class="form-group"
    action="{{route('admin.restaurant.store')}}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input
        type="text"
        id="name"
        name="name"
        class="form-control
        @error('name')
        is-invalid
        @enderror"
        value="{{old('name')}}">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Restaurant's address</label>
        <input
        type="text"
        id="address"
        name="address"
        class="form-control
        @error('address')
        is-invalid
        @enderror"
        value="{{old('address')}}"
        >

    </div>

    <div class="mb-3">
        <div class="btn-group d-flex flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
            @foreach ($types as $type)

                <input
                name="types[]"
                id="type_{{$type->id}}"
                value="{{$type->id}}"
                type="checkbox"
                class="btn-check"
                autocomplete="off"
                @if(old('types') && in_array($type->id, old('types')))
                checked
                @endif>

                <label class="btn btn-outline-primary" for="type_{{$type->id}}">{{$type->name}}</label>

            @endforeach

        </div>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input
        type="file"
        id="image"
        name="image"
        class="form-control
        @error('image')
        is-invalid
        @enderror"
        onchange="showImage(event)"
        value="{{old('image')}}"
        >

        <img id="thumb" src="/img/placeholder.jpg" alt="">

    </div>





    <button type="submit" class="btn btn-success">Invia</button>
    <button type="reset" class="btn btn-danger">Annulla</button>

    </form>

</div>


@endsection

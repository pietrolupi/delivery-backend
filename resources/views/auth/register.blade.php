@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="restaurant_name" class="form-label">Restaurant Name</label>
                            <input
                            type="text"
                            id="restaurant_name"
                            name="restaurant_name"
                            class="form-control
                            @error('restaurant_name')
                            is-invalid
                            @enderror"
                            value="{{old('restaurant_name')}}">
                        </div>

                        <div class="mb-3">
                            <label for="restaurant_address" class="form-label">Restaurant's address</label>
                            <input
                            type="text"
                            id="restaurant_address"
                            name="restaurant_address"
                            class="form-control
                            @error('address')
                            is-invalid
                            @enderror"
                            value="{{old('address')}}"
                            >
                        </div>
                        {{--vat --}}
                        <div class="mb-4 row">
                            <label for="vat" class="col-md-4 col-form-label text-md-right">VAT</label>

                            <div class="col-md-6">
                                <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}" required autocomplete="vat" autofocus>
                            </div>

                            @error('vat')
                            <div class="text-danger w-100 text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
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
                            <input type="file" id="image" name="image" class="form-control mb-3 @error('image') is-invalid @enderror" value="{{ old('image') }}">
                            <img id="thumb" src="/img/placeholder.jpg" alt="">
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

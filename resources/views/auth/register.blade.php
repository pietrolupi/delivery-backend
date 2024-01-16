@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">


        <div class="col-md-8">
            <p>Note: Fields marked with an asterisk * are mandatory.</p>
            <div class="card">

                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} &ast;</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} &ast;</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} &ast; </label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} &ast; </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">Restaurant Name &ast; </label>
                            <div class="col-md-6">
                                <input
                                type="text"
                                id="restaurant_name"
                                name="restaurant_name"
                                class="form-control
                                @error('restaurant_name')
                                is-invalid
                                @enderror"
                                value="{{old('restaurant_name')}}">
                                @error('restaurant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="restaurant_address" class="col-md-4 col-form-label text-md-right">Restaurant Address &ast; </label>
                            <div class="col-md-6">
                                <input
                                type="text"
                                id="restaurant_address"
                                name="restaurant_address"
                                class="form-control
                                @error('restaurant_address')
                                is-invalid
                                @enderror"
                                value="{{old('restaurant_address')}}">
                                @error('restaurant_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--vat --}}
                        <div class="mb-4 row">
                            <label for="vat" class="col-md-4 col-form-label text-md-right">VAT &ast; </label>
                            <div class="col-md-6">
                                <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}" required autocomplete="vat" autofocus>
                                @error('vat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex gap-2 btn-group d-flex flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
                                <p class="col-12 col-form-label text-md-right">Select one or more restaurant typology: </p>
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
                                    @endif
                                    onchange="checkSelectedTypes()"
                                >

                                <label class="btn btn-outline-primary" for="type_{{$type->id}}">{{$type->name}}</label>
                                @endforeach

                            </div>
                            <div id="typeErrorMessage" class="text-danger" style="display: none;">
                                Please select at least one type.
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="image" name="image"
                                    class="form-control @error('image') is-invalid @enderror mb-3"
                                    onchange="showImage(event)" value="{{ old('image') }}">
                            <p id="newImageText" style="display: none;">Uploaded image preview:</p>
                            <img id="imagePreview" alt="" class="w-25 mb-3">
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        checkSelectedTypes();
    });

    function showImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function () {
            var dataURL = reader.result;
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = dataURL;
            document.getElementById('newImageText').style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }

    function checkSelectedTypes() {
        var typesCheckbox = document.getElementsByName('types[]');
        var typeErrorMessage = document.getElementById('typeErrorMessage');

        var atLeastOneSelected = false;
        for (var i = 0; i < typesCheckbox.length; i++) {
            if (typesCheckbox[i].checked) {
                atLeastOneSelected = true;
                break;
            }
        }

        if (atLeastOneSelected) {
            typeErrorMessage.style.display = 'none';
        } else {
            typeErrorMessage.style.display = 'block';
        }
    }
</script>


@endsection

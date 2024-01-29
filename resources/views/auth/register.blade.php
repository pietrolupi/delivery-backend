@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">


        <div class="col-md-8">

            <div class="card register-login">

                <div class="card-header d-flex flex-column justify-content-center align-items-center">
                   <h5> {{ __('Register to DeliveBoo') }}</h5>
                    <img class="image" style="width: 80px;" src="/img/bg-register.png" alt="register-img">
                </div>

                <div class="card-body">
                    <p class="text-danger">Note: fields marked with an asterisk &ast; are required.</p>
                    <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} &ast;</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                <span id="errorName" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} &ast;</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span id="errorEmail" class="text-danger"></span>
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

                                <span id="errorPassword" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} &ast; </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span id="errorPasswordConfirm" class="text-danger"></span>
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
                                <span id="errorRestaurantName" class="text-danger"></span>
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
                                <span id="errorRestaurantAddress" class="text-danger"></span>
                            </div>
                        </div>

                        {{--vat --}}
                        <div class="mb-4 row">
                            <label for="vat" class="col-md-4 col-form-label text-md-right">VAT &ast; </label>
                            <div class="col-md-6">
                                <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}" required autocomplete="vat" autofocus>
                                <span id="errorVat" class="text-danger"></span>
                                @error('vat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="d-flex gap-2 btn-group d-flex flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
                                <p class="col-12 col-form-label text-md-right">Select one or more restaurant tipology: &ast; </p>
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

                                <label class="btn-type d-flex justify-content-center align-items-center" for="type_{{$type->id}}">{{$type->name}}</label>
                                @endforeach

                            </div>
                            <div id="typeErrorMessage" class="text-danger py-2" style="display: none;">
                                Please select at least one type.
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="image" class="form-label">Image &ast;</label>
                            <input type="file" id="image" name="image"
                                    class="form-control @error('image') is-invalid @enderror mb-3"
                                    onchange="showImage(event)" value="{{ old('image') }}">
                            <span id="errorImage" class="text-danger"></span>
                            <p id="newImageText" style="display: none;">Uploaded image preview:</p>
                            <img id="imagePreview" alt="" class="w-25 mb-3">
                        </div>

                        <div class="mb-4 row mb-0">
                            <div >
                                <button type="submit" class="btn register-login">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /*  CIENT SIDE VALIDATION ------------------------------------------------------------------------------------------------------ */

    $(document).ready(function() {
            const form = $('form');
            const name = $('#name');
            const email = $('#email');
            const password = $('#password');
            const passwordConfirm = $('#password-confirm');
            const restaurantName = $('#restaurant_name');
            const restaurantAddress = $('#restaurant_address');
            const vat = $('#vat');
            const image = $('#image');

            const errorName = $('#errorName');
            const errorEmail = $('#errorEmail');
            const errorPassword = $('#errorPassword');
            const errorPasswordConfirm = $('#errorPasswordConfirm');
            const errorRestaurantName = $('#errorRestaurantName');
            const errorRestaurantAddress = $('#errorRestaurantAddress');
            const errorVat = $('#errorVat');
            const errorImage = $('#errorImage');

            function validateName() {
                let nameVal = name.val().trim();
                if (nameVal.length === 0) {
                    errorName.text('Name is required.');
                    name.css('border', '2px solid red');
                    return false;
                } else if (nameVal.length < 3) {
                    errorName.text('Name must be at least 3 characters.');
                    name.css('border', '2px solid red');
                    return false;
                } else if (nameVal.length > 255) {
                    errorName.text('Name must be less than 255 characters.');
                    name.css('border', '2px solid red');
                    return false;
                } else {
                    errorName.text('');
                    name.css('border', '');
                    return true;
                }
            }

            // errorEmail

        function validateEmail() {
            let emailVal = email.val().trim();
            if (emailVal.length === 0) {
                errorEmail.text('The email field is required.');
                email.css('border', '2px solid red');
                return false;
            } else if (emailVal.length > 255) {
                errorEmail.text('The email may not be greater than 255 characters.');
                email.css('border', '2px solid red');
                return false;
            } else if (!isValidEmail(emailVal)) {
                errorEmail.text('The email must be a valid email address.');
                email.css('border', '2px solid red');
                return false;
            } else {
                errorEmail.text('');
                email.css('border', '');
                return true;
            }
        }

        // Funzione di supporto per la validazione dell'indirizzo email
        function isValidEmail(email) {
            // Utilizza una semplice espressione regolare per la validazione dell'email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        // error password

        function validatePassword() {
            let passwordVal = password.val().trim();
            if (passwordVal.length === 0) {
                errorPassword.text('The password field is required.');
                password.css('border', '2px solid red');
                return false;
            } else if (passwordVal.length < 8) {
                errorPassword.text('The email may not be smaller than 8 characters.');
                password.css('border', '2px solid red');
                return false;
            } else if (passwordVal.length > 255) {
                errorPassword.text('The email may not be greater than 255 characters.');
                password.css('border', '2px solid red');
                return false;
            } else {
                errorPassword.text('');
                password.css('border', '');
                return true;
            }
        }

        function validatePasswordConfirm() {
            let passwordConfirmVal = passwordConfirm.val().trim();
            let passwordVal = password.val().trim();

            if (passwordConfirmVal.length === 0) {
                errorPasswordConfirm.text('The password field is required.');
                passwordConfirm.css('border', '2px solid red');
                return false;
            } else if (passwordConfirmVal.length < 8) {
                errorPasswordConfirm.text('The password may not be smaller than 8 characters.');
                passwordConfirm.css('border', '2px solid red');
                return false;
            } else if (passwordConfirmVal.length > 255) {
                errorPasswordConfirm.text('The password may not be greater than 255 characters.');
                passwordConfirm.css('border', '2px solid red');
                return false;
            } else if (passwordConfirmVal != passwordVal) {
                errorPasswordConfirm.text('The passwords do not match');
                passwordConfirm.css('border', '2px solid red');
                return false;
            } else {
                errorPasswordConfirm.text('');
                passwordConfirm.css('border', '');
                return true;
            }
        }

        // restaurant name

        function validateRestaurantName() {
                let RestaurantNameVal = restaurantName.val().trim();
                if (RestaurantNameVal.length === 0) {
                    errorRestaurantName.text('The restaurant name is required.');
                    restaurantName.css('border', '2px solid red');
                    return false;
                } else if (RestaurantNameVal.length < 2) {
                    errorRestaurantName.text('The restaurant name must be at least 2 characters.');
                    restaurantName.css('border', '2px solid red');
                    return false;
                } else if (RestaurantNameVal.length > 255) {
                    errorRestaurantName.text('The restaurant name must be less than 255 characters.');
                    restaurantName.css('border', '2px solid red');
                    return false;
                } else {
                    errorRestaurantName.text('');
                    restaurantName.css('border', '');
                    return true;
                }
            }

    // restaurant address

    function validateRestaurantAddress() {
                let RestaurantAddressVal = restaurantAddress.val().trim();
                if (RestaurantAddressVal.length === 0) {
                    errorRestaurantAddress.text('The restaurant address is required.');
                    restaurantAddress.css('border', '2px solid red');
                    return false;
                } else if (RestaurantAddressVal.length < 5) {
                    errorRestaurantAddress.text('The restaurant address must be at least 5 characters.');
                    restaurantAddress.css('border', '2px solid red');
                    return false;
                } else if (RestaurantAddressVal.length > 255) {
                    errorRestaurantAddress.text('The restaurant address must be less than 255 characters.');
                    restaurantAddress.css('border', '2px solid red');
                    return false;
                } else {
                    errorRestaurantAddress.text('');
                    restaurantAddress.css('border', '');
                    return true;
                }
            }

            function validateVat() {
                let vatVal = vat.val().trim();
                if (vatVal.length === 0) {
                    errorVat.text('VAT is required.');
                    vat.css('border', '2px solid red');
                    return false;
                } else if (vatVal.length < 13 || vatVal.length > 13) {
                    errorVat.text('The VAT must be 13 characters length.');
                    vat.css('border', '2px solid red');
                    return false;
                } else {
                    errorVat.text('');
                    vat.css('border', '');
                    return true;
                }
            }


            // image

            function validateImage() {
                const allowedFormats = ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp'];
                const maxFileSize = 2048; // Kilobytes (2MB)

                const imageVal = image[0].files[0]; // Ottieni il file caricato dall'input

                if (!imageVal) {
                    errorImage.text('Image is required.');
                    image.css('border', '2px solid red');
                    return false;
                }

                const imageType = imageVal.type.split('/').pop().toLowerCase(); // Ottieni il formato del file
                const imageSize = imageVal.size / 1024; // Calcola la dimensione in kilobytes

                if (!allowedFormats.includes(imageType)) {
                    errorImage.text('Invalid image format. Allowed formats: jpeg, png, jpg, gif, svg, webp.');
                    image.css('border', '2px solid red');
                    return false;
                } else if (imageSize > maxFileSize) {
                    errorImage.text('Image size must be 2MB or less.');
                    image.css('border', '2px solid red');
                    return false;
                } else {
                    errorImage.text('');
                    image.css('border', '');
                    return true;
                }
            }

            // Funzione di validazione generale (mi controlla  TUTTI i campi sopra e mi returna TRUE solo se TUTTI sono TRUE)
            function validateForm() {
                let isNameValid = validateName();
                let isEmailValid = validateEmail();
                let isPasswordValid = validatePassword();
                let isPasswordConfirmValid = validatePasswordConfirm();
                let isRestaurantNameValid = validateRestaurantName();
                let isRestaurantAddressValid = validateRestaurantAddress();
                let isVatValid = validateVat();
                let isImageValid = validateImage();

                return isNameValid && isEmailValid && isPasswordValid && isPasswordConfirmValid && isRestaurantNameValid && isRestaurantAddressValid && isVatValid && isImageValid;
            }

            // Gestione dell'invio del form (avviene solo se la funzione sopra mi da return TRUE)
            form.on('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Impedisci l'invio del form se non è valido
                }
            });

            // Event listener per i cambiamenti di input DINAMICI
            name.on('input', validateName);
            email.on('input', validateEmail);
            password.on('input', validatePassword);
            passwordConfirm.on('input', validatePasswordConfirm);
            restaurantName.on('input', validateRestaurantName);
            restaurantAddress.on('input', validateRestaurantAddress);
            vat.on('input', validateVat);
            image.on('input', validateImage);

    })

</script>


@endsection

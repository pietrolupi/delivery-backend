@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')
    <h2>Create your product</h2>
    <form class="form-group" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input required type="hidden" name="restaurant_id" value="{{ Auth::user()->restaurant->id }}">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name"
                class="form-control
                @error('name')
                is-invalid
                @enderror"
                value="{{ old('name') }}">
            <span id="errorName" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <input type="text" id="ingredients" name="ingredients"
                class="form-control
                @error('ingredients')
                is-invalid
                @enderror"
                value="{{ old('ingredients') }}">
            <span id="errorIngredients" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea type="text" id="description" name="description"
                class="form-control
                @error('description')
                is-invalid
                @enderror"
                value="{{ old('description') }}">
            </textarea>
            <span id="errorDescription" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price" min="0.01" max="9999.99"
                class="form-control
                @error('price')
                is-invalid
                @enderror"
                value="{{ old('price') }}">
            <span id="errorPrice" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Disponibility</label>
            <div class="form-check">
                <input type="checkbox" id="visibility" name="visibility" {{ old('visibility') == 1 ? 'checked' : '' }}
                    class="form-check-input" value="1">

                <label class="form-check-label" for="visibility">
                    <div id="visibilityMessage">
                        <span class="{{ old('visibility') == 1 ? 'text-success' : 'text-danger' }}">
                            {{ old('visibility') == 1 ? 'Avaliable' : 'Unavaliable' }}
                        </span>
                    </div>
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" id="image" name="image"
                class="form-control
                @error('image')
                is-invalid
                @enderror mb-3"
                onchange="showImage(event)" value="{{ old('image', $product->image) }}">
            <span id="errorImage" class="text-danger"></span>
            <p id="newImageText" style="display: none;">Uploaded image preview:</p>
            <img id="imagePreview" alt="" class="w-25 mb-3">

        </div>


        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /*  CIENT SIDE VALIDATION ------------------------------------------------------------------------------------------------------ */

        $(document).ready(function() {
            const form = $('form');
            const name = $('#name');
            const ingredients = $('#ingredients');
            const description = $('#description');
            const price = $('#price');
            const image = $('#image');

            const errorName = $('#errorName');
            const errorDescription = $('#errorDescription');
            const errorIngredients = $('#errorIngredients');
            const errorPrice = $('#errorPrice');
            const errorImage = $('#errorImage');

            // FUNZIONI DI VALIDAZIONI E MESSAGGI PER OGNI CAMPO
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
                    errorName.text('Name must be less than 120 characters.');
                    name.css('border', '2px solid red');
                    return false;
                } else {
                    errorName.text('');
                    name.css('border', '');
                    return true;
                }
            }

            function validateIngredients() {

                let ingredientsVal = ingredients.val().trim();
                if (ingredientsVal.length === 0) {
                    errorIngredients.text('Ingredients is required.');
                    ingredients.css('border', '2 px solid red');
                    return false;
                } else if (ingredientsVal.length < 2) {
                    errorIngredients.text('Ingredients must be at least 2 characters.');
                    ingredients.css('border', '2 px solid red');
                    return false;
                } else if (ingredientsVal.length > 255) {
                    errorIngredients.text('Ingredients\' text must be less than 255 characters.');
                    ingredients.css('border', '2 px solid red');
                    return false;
                } else {
                    errorIngredients.text('');
                    ingredients.css('border', '');
                    return true;
                }
            }

            function validateDescription() {

                let descriptionVal = description.val().trim();
                if (descriptionVal.length > 400) {
                    errorDescription.text('Description\'s text must be less than 400 characters.');
                    description.css('border', '2px solid red');
                    return false;
                } else {
                    errorDescription.text('');
                    description.css('border', '');
                    return true;
                }
            }


            function validatePrice() {
                let priceVal = price.val().trim();
                if (priceVal === '') {
                    errorPrice.text('Price is required.');
                    price.css('border', '2px solid red');
                    return false;
                } else if (isNaN(priceVal) || Number(priceVal) < 0 || Number(priceVal) > 9999) {
                    errorPrice.text('Price must be a number between 0 and 9999.');
                    price.css('border', '2px solid red');
                    return false;
                } else {
                    errorPrice.text('');
                    price.css('border', '');
                    return true;
                }
            }

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
                let isIngredientsValid = validateIngredients();
                let isDescriptionValid = validateDescription();
                let isPriceValid = validatePrice();
                let isImageValid = validateImage();

                return isNameValid && isIngredientsValid && isDescriptionValid && isPriceValid && isImageValid;
            }

            // Gestione dell'invio del form (avviene solo se la funzione sopra mi da return TRUE)
            form.on('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Impedisci l'invio del form se non è valido
                }
            });

            // Event listener per i cambiamenti di input DINAMICI
            name.on('input', validateName);
            ingredients.on('input', validateIngredients);
            description.on('input', validateDescription);
            price.on('input', validatePrice);
            image.on('input', validateImage);
        });

        /* ------------------------------------------------------------------------------------------------------------------------------ */

        /* Visibility checkbox  */
        $(document).ready(function() {
            $('#visibility').change(function() {
                var message = $(this).prop('checked') ? 'Avaliable' : 'Unavaliable';
                $('#visibilityMessage span').removeClass('text-success text-danger').addClass($(this).prop(
                    'checked') ? 'text-success' : 'text-danger').text(message);
            });
        });

        /* Image Upload Preview */
        function showImage(event) {
            let input = event.target;
            let reader = new FileReader();
            let output = document.getElementById('imagePreview');
            let newImageText = document.getElementById('newImageText');

            reader.onload = function() {
                output.src = reader.result;
                newImageText.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection

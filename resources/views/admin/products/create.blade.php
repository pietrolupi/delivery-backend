@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')
    <h2>Create your product</h2>
    <form class="form-group" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="restaurant_id" value="{{ Auth::user()->restaurant->id }}">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name"
                class="form-control
                @error('name')
                is-invalid
                @enderror"
                value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <input type="text" id="ingredients" name="ingredients"
                class="form-control
                @error('ingredients')
                is-invalid
                @enderror"
                value="{{ old('ingredients') }}">
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
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price"
                class="form-control
                @error('price')
                is-invalid
                @enderror"
                value="{{ old('price') }}">
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
                class="form-control mb-3
                @error('image')
                is-invalid
                @enderror"
                onchange="showImage(event)" value="{{ old('image') }}">
            <img id="thumb" src="{{ asset('storage/img/' . 'placeholder.jpg') }}"
                onerror="this.src='/img/placeholder.jpg'" alt="">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>

    {{-- client side validation --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const form = $('form');
            const name = $('#name');
            const ingredients = $('#ingredients');
            const description = $('#description');
            const price = $('#price');

            // Funzione di validazione
            function validateForm() {
                let isValid = true;
                [name, ingredients, description, price].forEach(function (field) {
                    if (field.val().trim() === '') {
                        field.css('border', '1px solid orange'); // Applica lo stile di errore
                        isValid = false;
                    } else {
                        field.css('border', ''); // Rimuovi lo stile di errore
                    }
                });
                return isValid;
            }

            // Gestione dell'invio del form
            form.on('submit', function (event) {
                if (!validateForm()) {
                    event.preventDefault(); // Impedisci l'invio del form se non è valido
                    console.log('Validation failed');
                }
            });

            // Rimuovi lo stile di errore all'input
            [name, ingredients, description, price].forEach(function (field) {
                field.on('input', function () {
                    $(this).css('border', '');
                });
            });
        });
    </script>

    {{-- ------------------------------------------------------------------------------------ --}}

@endsection


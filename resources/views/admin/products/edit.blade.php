@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')

    <h2>Update your product</h2>
    <form class="form-group mb-2" action="{{ route('admin.products.update', $product) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name"
                class="form-control
            @error('name')
            is-invalid
            @enderror"
                value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <input type="text" id="ingredients" name="ingredients"class="form-control
                                                @error('ingredients')
                is-invalid
                @enderror"
                value="{{ old('ingredients', $product->ingredients) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" id="description" name="description"
                class="form-control
            @error('description')
            is-invalid
            @enderror">
            {{ old('description', $product->description) }}
        </textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price"class="form-control
                                            @error('price')
            is-invalid
            @enderror"
                value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Disponibility</label>
            <div class="form-check">
                <input value="{{ old('visibility', $product->visibility) }}" {{ $product->visibility == 1 ? 'checked' : 0 }}
                    type="checkbox" id="visibility" name="visibility" class="form-check-input">
                <label class="form-check-label" for="visibility">
                    <div id="visibilityMessage">
                        <span class="{{ $product->visibility == 1 ? 'text-success' : 'text-danger' }}">
                            {{ $product->visibility == 1 ? 'Avaliable' : 'Unavaliable' }}
                        </span>
                    </div>
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Substitute the image</label>
            <input type="file" id="image" name="image"
                class="form-control
            @error('image')
            is-invalid
            @enderror mb-3"
                onchange="showImage(event)" value="{{ old('image', $product->image) }}">
            <p>Old image:</p>
            <img id="thumb" src="{{ asset('storage/app/public/uploads' . $product?->image) }}"
                onerror="this.src='/img/placeholder.jpg'" alt="{{ $product->name }}" class="w-25">

        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#visibility').change(function() {
            var message = $(this).prop('checked') ? 'Avaliable' : 'Unavaliable';
            $('#visibilityMessage span').removeClass('text-success text-danger').addClass($(this).prop(
                'checked') ? 'text-success' : 'text-danger').text(message);
        });
    });

    // funzione per visualizzare l'anteprima dell'immagine
    function showImage(event) {
        console.log('mostra img');
        const thumb = document.getElementById('thumb');
        // associo a src l'immagine caricata
        thumb.src = URL.createObjectURL(event.target.files[0]);

    }
</script>

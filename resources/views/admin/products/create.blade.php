@extends('layouts.admin')

@section('content')
    <div class="container">

        <h2 class="mt-5">Create your product</h2>

        <form class="form-group" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="restaurant_id" value="{{ $valore }}">

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
                <label for="visibility" class="form-label">Visibility</label>
                <div class="form-check">
                    <input value="1" checked type="checkbox" id="visibility" name="visibility" class="form-check-input"
                          >
                    <label class="form-check-label" for="visibility">Visible</label>
                </div>
            </div>



            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image"
                    class="form-control
        @error('image')
        is-invalid
        @enderror"
                    onchange="showImage(event)" value="{{ old('image') }}">

                <img id="thumb" src="/img/placeholder.jpg" alt="">

            </div>





            <button type="submit" class="btn btn-success">Invia</button>
            <button type="reset" class="btn btn-danger">Annulla</button>

        </form>

    </div>
@endsection

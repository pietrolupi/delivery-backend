@extends('layouts.admin')

@section('content')
    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif



        <h2 class="mt-5">Update your product</h2>

        <form class="form-group" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name"
                    class="form-control
                @error('name')
                is-invalid
                @enderror"
                    value="{{ old ('name', $product->name) }}">
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <input type="text" id="ingredients" name="ingredients"
                    class="form-control
                @error('ingredients')
                is-invalid
                @enderror"
                    value="{{ old('ingredients', $product->ingredients) }}">

            </div>

            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea type="text" id="description" name="description"
                    class="form-control
                @error('description')
                is-invalid
                @enderror"
                   >
                    {{ old('description', $product->description) }}
                </textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" id="price" name="price"
                    class="form-control
                @error('price')
                is-invalid
                @enderror"
                    value="{{ old('price', $product->price) }}">
            </div>

            <div class="mb-3">
                <label for="visibility" class="form-label">Visibility</label>
                <div class="form-check">
                    <input value="{{ old('visibility', $product->visibility) }}" @if(old('visibility', $product->visibility) == 1) checked @endif type="checkbox" id="visibility" name="visibility" class="form-check-input"
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
                    onchange="showImage(event)" value="{{ old('image', $product->image) }}">

                <img id="thumb" src="/img/placeholder.jpg" alt="">

            </div>





            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>

        </form>

    </div>
@endsection

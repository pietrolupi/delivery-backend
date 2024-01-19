@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')

    <h3>{{ $product->name}}</h1>
    <div class="content d-flex flex-column flex-md-row gap-2">
        <div class="image mb-2 w-25">
            <img src="{{ asset('storage/' . $product->image) }}" onerror="this.src='{{ asset('img/placeholder.jpg') }}'" class="img-fluid " alt="{{ $product->name }}">
        </div>

        <div class="text">
            <p>Ingredients: {{ $product->ingredients }}</p>
            @if($product->description)
                <p>Description: {{ $product->description }}</p>
            @endif
            <p>Price: {{$product->price}} &euro;</p>
            <span class="badge rounded-pill {{ $product->visibility == 1 ? 'text-bg-success' : 'text-bg-danger' }} p-2 mb-2">
                {{ $product->visibility == 1 ? 'Avaliable' : 'Unavaliable' }}
            </span>
            <div class="buttons d-flex gap-2">
                @include('generals.buttons.edit_btn', ['route'=>route('admin.products.edit' , $product)])

                <!-- button delete -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa-solid fa-trash-can"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete confirmation</h5>
                                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex flex-column align-items-center">
                                <p class="fw-bold">Are you sure you want to delete {{ $product->name }}?</p>
                                <div class="image w-50">
                                    <img class="w-100" src="/img/modal-img.png" alt="error">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <span>Yes</span>
                                        <i class="m-1 fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                 <!--/// Modal -->
            </div>
        </div>
    </div>
    @include('generals.buttons.back_btn', ['route' => route('admin.products.index', $product)])

    {{-- jquery script for modal  --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // function to show modal
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
        }
    </script>
@endsection

<!-- delete_modal.blade.php -->
@if(isset($product))
    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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

    {{-- jQuery script for modal --}}
    <script>
        // function to show modal
        function showDeleteModal{{ $product->id }}() {
            $('#deleteModal{{ $product->id }}').modal('show');
        }
    </script>
@endif

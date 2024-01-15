<form action="{{ $route }}" method="Post"
    onsubmit="return confirm('Are you sure you want to DELETE {{ $name }}')">

    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" style="color:black"><i class="fa-solid fa-trash-can"></i></button>
</form>

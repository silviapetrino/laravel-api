<form action="{{ $route }}" method="POST" class="d-inline-block mt-1" onsubmit="return confirm('{{ $message }}')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="fa-solid fa-trash"></i>
    </button>

</form>

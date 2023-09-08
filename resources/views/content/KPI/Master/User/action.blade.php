<form action="{{ route('user.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE') {{-- Use 'DELETE' method to conform to the RESTful conventions --}}
    <button type="submit" class="btn btn-outline-danger btn-sm me-2 btn-delete" data-name="">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
        Deactivate
    </button>
</form>

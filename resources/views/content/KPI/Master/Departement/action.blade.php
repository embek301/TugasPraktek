<div class="d-flex">
    <div>
        <a href="{{ route('departement.edit', $dept->id) }}"class="btn btn-outline-warning btn-sm me-2">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            Edit
        </a>
    </div>
    <div>
        <form action="{{ route('departement.destroy', $dept->id) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-danger btn-sm me-2 btn-delete" data-name="{{ $dept->name }}">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                Hapus
            </button>
        </form>
    </div>
</div>

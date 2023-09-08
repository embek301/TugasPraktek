@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    @if (auth()->user()->hak == 1 || auth()->user()->hak == 2 || auth()->user()->hak == 3 || auth()->user()->hak == 4)
        <h2>Anda tidak memiliki akses</h2>
    @endif
    @if (auth()->user()->hak == 5 ||
            auth()->user()->hak == 6 ||
            auth()->user()->hak == 7 ||
            auth()->user()->hak == 8 ||
            auth()->user()->hak == 9 ||
            auth()->user()->hak == 10)
        <ul class="list-inline mb-2 float-end">
            <li class="list-inline-item">
                <a href="{{ route('cabang.create') }}" class="btn btn-gold">
                    <i class="fa fa-id-badge me-1"></i> Tambahkan Cabang
                </a>
            </li>
        </ul>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="cabangTable">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Cabang</th>
                        <th>Admin Unit</th>
                        <th>PIC</th>
                        <th>Head</th>
                        <th>Kabeng</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabang as $index => $cab)
                        @if ($cab->name != null)
                            <tr>
                                <td align="center">{{ $index }}</td>
                                <td>{{ $cab->name }}</td>
                                <td>{{ $cab->admin_unit }}</td>
                                <td>{{ $cab->pic }}</td>
                                <td>{{ $cab->head }}</td>
                                <td>{{ $cab->kabeng }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <a
                                                href="{{ route('cabang.edit', $cab->id) }}"class="btn btn-outline-warning btn-sm me-2">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                Edit
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('cabang.destroy', $cab->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger btn-sm me-2 btn-delete"
                                                    data-name="{{ $cab->name }}">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#cabangTable').DataTable();

            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();

                var form = $(this).closest("form");
                var name = $(this).data("name");

                Swal.fire({
                    title: "Anda yakin ingin menghapus Cabang " + name + "?",
                    text: "Anda tidak bisa mengembalikan data!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: "Iya, Hapus!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

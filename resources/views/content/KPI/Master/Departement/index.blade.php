@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    @if (auth()->user()->hak == 5 ||
            auth()->user()->hak == 6 ||
            auth()->user()->hak == 7 ||
            auth()->user()->hak == 8 ||
            auth()->user()->hak == 9 ||
            auth()->user()->hak == 10)
        <ul class="list-inline mb-2 float-end">
            <li class="list-inline-item">
                <a href="{{ route('departement.create') }}" class="btn btn-gold">
                    <i class="fa fa-id-badge me-1"></i> Tambahkan Departement
                </a>
            </li>
        </ul>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="departementTable">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Departement</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($dept as $index => $dept)
                        @if ($dept->name != null)
                            <tr>
                                <td align="center">{{ $index }}</td>
                                <td>
                                    {{ $dept->name }}
                                </td>
                                <td>
                                    @include('content.KPI.Master.Departement.action')
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    @endif

    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#departementTable').DataTable();

                $(".datatable").on("click", ".btn-delete", function(e) {
                    e.preventDefault();

                    var form = $(this).closest("form");
                    var name = $(this).data("name");

                    Swal.fire({
                        title: "Anda yakin ingin menghapus Departement " + name + "?",
                        text: "Anda tidak bisa mengembalikan data!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "Tidak, Batal",
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

@endsection

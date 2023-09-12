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
                <a href="{{ route('penilai4.create') }}" class="btn btn-gold">
                    <i class="fa fa-id-badge me-1"></i> Tambahkan Penilai 4
                </a>
            </li>
        </ul>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="penilai4Table">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($pen4 as $index => $pen4)
                        @if ($pen4->name != null)
                            <tr>
                                <td align="center">{{ $index }}</td>
                                <td>
                                    {{ $pen4->name }}
                                </td>
                                <td>
                                    @include('content.KPI.Master.Penilai.Penilai4.action')
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    @endif
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#penilai4Table').DataTable();
            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();

                var form = $(this).closest("form");
                var name = $(this).data("name");

                Swal.fire({
                    title: "Anda yakin ingin menghapus Penillai-4 " + name + "?",
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

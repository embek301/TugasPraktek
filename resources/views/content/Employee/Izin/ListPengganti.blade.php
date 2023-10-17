@extends('layouts.employee-layout')
@section('content')
    @if ($isPengganti)
        <div class="text-center">
            <h1 class="mb-4">List Approval Cuti</h1>
        </div>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="terlambatTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Absensi</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        @if (auth()->user()->hak == 7 || auth()->user()->hak == 10)
                            <th>Approval1</th>
                        @endif
                        <th>Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($terlambatData as $index => $terlambat)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td>
                                <a
                                    href="{{ route('list-cuti.edit', $terlambat->id_terlambat) }}">{{ $terlambat->id_terlambat }}</a>
                            </td>
                            <td>{{ $terlambat->nik }}</td>
                            <td>{{ $terlambat->nama }}</td>
                            <td>{{ date('d/m/Y', strtotime($terlambat->tanggal)) }}</td>

                            @if (auth()->user()->hak == 7 || auth()->user()->hak == 10)
                                <td>{{ $terlambat->approval1 }}</td>
                            @endif
                            <td>{{ $terlambat->jenis }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#terlambatTable').DataTable();
            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();

                var form = $(this).closest("form");
                var name = $(this).data("nama");

                Swal.fire({
                    title: "Anda yakin ingin menghapus Jabatan " + name + "?",
                    text: "Anda tidak bisa mengembalikan data!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "Tidak, Batal",
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

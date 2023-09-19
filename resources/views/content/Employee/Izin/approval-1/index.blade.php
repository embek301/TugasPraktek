<!-- Check if the user is a penilai2 -->
{{-- @if (auth()->user()->penilai2) --}}
    <div class="text-center">
        <h1 class="mb-4">List Approval Absensi</h1>
    </div>
    <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
        <table class="table table-bordered table-hover mb-0 datatable" id="terlambatTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Alasan</th>
                    <th>Approval 1</th>
                    <th>Tanggal Approval 1</th>
                    <th>Status</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terlambatData as $index => $terlambat)
                    <tr>
                        <td align="center">{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('izin-terlambat.edit', $terlambat->id_terlambat) }}">{{ $terlambat->id_terlambat }}</a>
                        </td>
                        <td>{{ $terlambat->nik }}</td>
                        <td>{{ $terlambat->nama }}</td>
                        <td>{{ date('Y-m-d', strtotime($terlambat->tanggal)) }}</td>
                        <td>{{ $terlambat->jam }}</td>
                        <td>{{ $terlambat->alasan }}</td>
                        <td>{{ $terlambat->aprroval1 }}</td>
                        <td>{{ $terlambat->tgl_app1 }}</td>
                        <td>{{ $terlambat->status }}</td>
                        <td>{{ $terlambat->jenis }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
{{-- @endif --}}
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

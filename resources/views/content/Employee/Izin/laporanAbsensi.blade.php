@extends('layouts.employee-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    <h5 class="mb-4">Selamat Datang {{ Auth::user()->who }}</h5>
    <div class="text-center">
        <h1 class="mb-4">Laporan Absensi Karyawan</h1>
    </div>
    <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
        <table class="table table-bordered table-hover mb-0 datatable" id="absensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Absensi</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Departement</th>
                    <th>Cabang</th>
                    <th>Jenis</th>
                    <th>Tanggal Izin</th>
                    <th>Jam Izin</th>
                    <th>Alasan</th>
                    <th>Status App I</th>
                    <th>Alasan App I</th>
                    <th>Status App II</th>
                    <th>Alasan App II</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terlambatData as $index => $terlambat)
                    <tr>
                        <td align="center">{{ $index + 1 }}</td>
                        <td>
                            {{ $terlambat->id_terlambat }}
                        </td>
                        <td>{{ $terlambat->nik }}</td>
                        <td>{{ $terlambat->nama }}</td>
                        <td>{{ $terlambat->jabatan }}</td>
                        <td>{{ $terlambat->dept }}</td>
                        <td>{{ $terlambat->cab }}</td>
                        <td>{{ $terlambat->jenis }}</td>
                        <td>{{ date('Y-m-d', strtotime($terlambat->tanggal)) }}</td>
                        <td>{{ $terlambat->jam }}</td>
                        <td>{{ $terlambat->alasan }}</td>
                        <td>{{ $terlambat->approval1 }}</td>
                        <td>{{ $terlambat->alasan1 }}</td>
                        <td>{{ $terlambat->approval2 }}</td>
                        <td>{{ $terlambat->alasan2 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- @endif --}}
    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#absensi').DataTable();
                
            });
        </script>
    @endpush
@endsection

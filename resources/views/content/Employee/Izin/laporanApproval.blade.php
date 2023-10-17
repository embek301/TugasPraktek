@extends('layouts.employee-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    <h5 class="mb-4">Selamat Datang {{ Auth::user()->who }}</h5>
    <!-- Check if the user is a penilai2 -->
    @if (
        $isPenilai2 ||
            auth()->user()->hak == 6 ||
            auth()->user()->hak == 7 ||
            auth()->user()->hak == 8 ||
            auth()->user()->hak == 10)
        <div class="text-center">
            <h1 class="mb-4">{{ $pageTitle }}</h1>
        </div>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="terlambatTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Absensi </th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Pengganti Cuti</th>
                        <th>Status App Cuti</th>
                        <th>Approval 1</th>
                        @if (auth()->user()->hak == 7 || auth()->user()->hak == 10)
                            <th>Status App1</th>
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
                                    href="{{ route('izin-terlambat.edit', $terlambat->id_terlambat) }}">{{ $terlambat->id_terlambat }}</a>
                            </td>
                            <td>{{ $terlambat->nik }}</td>
                            <td>{{ $terlambat->nama }}</td>
                            <td>{{ date('Y-m-d', strtotime($terlambat->tanggal)) }}</td>
                            <td>{{ $terlambat->jam }}</td>
                            <td>{{ $terlambat->pengganti }}</td>
                            <td>{{ $terlambat->approval3 }}</td>
                            <td>{{ $penilai2Data[$terlambat->nama] }}</td>
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
    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#terlambatTable').DataTable();

            });
        </script>
    @endpush
@endsection

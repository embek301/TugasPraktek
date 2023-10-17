<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $jenisLaporan }}</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/asw.png') }}" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+I+rZm5n5Hv5rwJ/kDeKeSUlI5zqop2iUA4j5A5C+ozE5Sx" crossorigin="anonymous">
    <style>
        html {
            font-size: 10px;
        }

        table {
            margin: 0 auto;
            width: auto;
            /* margin-left: -30px; */
        }

        .table-bordered th,
        .table-bordered td {
            padding: 0.5rem;
            border: 1px solid black !important;
        }
    </style>
</head>
<h1 class="text-center" style="font-size: 40px">Data Laporan Rekapitulasi Izin</h1>
<h3 class="text-center" style="font-size: 30px">{{ $bulan }}</h3>
<table class="table table-bordered text-center">
    <thead style=" font-size: 12px;">
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Departement</th>
            <th>Cabang</th>
            <th>Total Izin Terlambat</th>
            <th>Total Izin Pulang Awal</th>
            <th>Total Izin No Clock In</th>
            <th>Total Izin No Clock Out</th>
            <th>Total Izin Sakit</th>
            <th>Total Izin Cuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($terlambatData as $index => $item)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->dept }}</td>
                <td>{{ $item->cab }}</td>
                <td>{{ $item->telat }}</td>
                <td>{{ $item->pulang }}</td>
                <td>{{ $item->clockin }}</td>
                <td>{{ $item->clockout }}</td>
                <td>{{ $item->sakit }} Hari</td>
                <td>{{ $item->cuti }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

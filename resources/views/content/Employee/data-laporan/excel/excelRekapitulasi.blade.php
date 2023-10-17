<!-- resources/views/excel/terlambat_excel.blade.php -->
<html>

<head>
    <style>
        /* Atur gaya CSS sesuai kebutuhan Anda */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Tambahkan CSS untuk baris pertama (judul) */
        tr:first-child {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Data Laporan Rekapitulasi Izin</h1>
    <h2>{{ $bulan }}</h2>
    <table>
        <thead>
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
            @foreach ($terlambatData as $index => $terlambat)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $terlambat->nik }}</td>
                    <td>{{ $terlambat->nama }}</td>
                    <td>{{ $terlambat->jabatan }}</td>
                    <td>{{ $terlambat->dept }}</td>
                    <td>{{ $terlambat->cab }}</td>
                    <td>{{ $terlambat->telat }}</td>
                    <td>{{ $terlambat->pulang }}</td>
                    <td>{{ $terlambat->clockin }}</td>
                    <td>{{ $terlambat->clockout }}</td>
                    <td>{{ $terlambat->sakit }} </td>
                    <td>{{ $terlambat->cuti }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

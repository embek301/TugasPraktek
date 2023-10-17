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
    <h1>Data Laporan Izin Sakit</h1>
    <h2>{{ $bulan }}</h2>
    <table>
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
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($terlambatData as $index => $terlambat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $terlambat->id_terlambat }}</td>
                    <td>{{ $terlambat->nik }}</td>
                    <td>{{ $terlambat->nama }}</td>
                    <td>{{ $terlambat->jabatan }}</td>
                    <td>{{ $terlambat->dept }}</td>
                    <td>{{ $terlambat->cab }}</td>
                    <td>{{ $terlambat->jenis }}</td>
                    <td>{{ $terlambat->tanggal }}</td>
                    <td>{{ $terlambat->jam }}</td>
                    <td>{{ $terlambat->alasan }}</td>
                    <td>{{ $terlambat->approval2 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

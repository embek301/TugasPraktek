<!DOCTYPE html>
<html>

<head>
    <title>{{ $terlambat->jenis }}</title>
</head>

<body>
    <p>{{ $terlambat->jenis }} {{ $terlambat->nama }} pada tanggal
        {{ \Carbon\Carbon::parse($terlambat->tgl_awal)->format('d/m/Y') }},sampai dengan tanggal
        {{ \Carbon\Carbon::parse($terlambat->tgl_akhir)->format('d/m/Y') }} dengan
        alasan
        {{ $terlambat->alasan }} dan pengganti {{$terlambat->pengganti}}</p>
    <p>Click link untuk Menerima atau Menolak 
        <a href="{{ route('izin-terlambat.edit', $terlambat->id_terlambat) }}">Approval</a></p>
</body>

</html>

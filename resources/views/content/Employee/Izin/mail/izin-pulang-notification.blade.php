<!DOCTYPE html>
<html>

<head>
    <title>Izin Pulang Awal Notification</title>
</head>

<body>
    <p>{{ $terlambat->jenis }} {{ $terlambat->nama }} tanggal
        {{ \Carbon\Carbon::parse($terlambat->tanggal)->format('d/m/Y') }}, jam {{ $terlambat->jam }} dengan alasan
        {{ $terlambat->alasan }}</p>
    <p>Click link untuk Menerima atau Menolak <a
            href="{{ route('izin-terlambat.edit', $terlambat->id_terlambat) }}">Approval</a></p>
</body>

</html>

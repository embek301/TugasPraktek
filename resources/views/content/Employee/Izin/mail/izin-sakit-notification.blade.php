<!DOCTYPE html>
<html>

<head>
    <title>Izin Pulang Awal Notification</title>
</head>

<body>
    <p>{{ $terlambat->jenis }} {{ $terlambat->nama }} tanggal
        {{ \Carbon\Carbon::parse($terlambat->tgl_awal)->format('d/m/Y') }}, sampai {{ \Carbon\Carbon::parse($terlambat->akhir)->format('d/m/Y') }} dengan diagnosa
        {{ $terlambat->alasan }}</p>
    <p>Click link untuk Menerima atau Menolak <a
            href="{{ route('izin-terlambat.edit', $terlambat->id_terlambat) }}">Approval</a></p>
</body>

</html>

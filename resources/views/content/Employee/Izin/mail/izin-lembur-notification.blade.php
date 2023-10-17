<!DOCTYPE html>
<html>

<head>
    <title>Izin Lembur Notification</title>
</head>

<body>
    @php
        $jam = explode(':', $terlambat->jam);
        $formattedJam = ltrim($jam[0], '0'); // Menghapus angka 0 di depan jam
    @endphp
    <p>{{ $terlambat->jenis }} {{ $terlambat->nama }} lembur pada tanggal
        {{ \Carbon\Carbon::parse($terlambat->tgl_awal)->format('d/m/Y') }}, selama {{$formattedJam}} jam dengan
        alasan
        {{ $terlambat->alasan }}</p>
    <p>Click link untuk Menerima atau Menolak <a
            href="{{ route('izin-terlambat.edit', $terlambat->id_terlambat) }}">Approval</a></p>
</body>

</html>

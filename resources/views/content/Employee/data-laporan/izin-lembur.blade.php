@extends('layouts.employee-layout')
@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    <h5 class="mb-4">Selamat Datang {{ Auth::user()->who }}</h5>
    @if (auth()->user()->hak == 7 || auth()->user()->hak == 10)
        <div class="text-center">
            <h1 class="mb-3">{{ $pageTitle }}</h1>
        </div>
        <div class="text-center">
            <h4 class="mb-3" id="bulan"></h4>
        </div>
        <div class="row">
            <div class="col-lg-9 col-xl-6">
                <!-- Konten lainnya di sini -->
            </div>
            <div class="text-end mb-3">
                <a href="#" id="export-excel-button" class="btn btn-success">
                    <i class="fa fa-file-excel-o me-1"></i> Export to Excel
                </a>
                <a href="#" id="export-pdf-button" class="btn btn-danger">
                    <i class="fa fa-file-pdf-o me-1"></i> Export to PDF
                </a>
            </div>
        </div>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-4 mb-3">
                    <label for="tanggal_awal" class="form-label">Pilih Tanggal Awal</label>
                    <input class="form-control" type="date" id="tanggal_awal" name="tanggal_awal">
                </div>
                <!-- Kolom Kanan -->
                <div class="col-md-4 mb-3">
                    <label for="tanggal_akhir" class="form-label">Pilih Tanggal Akhir</label>
                    <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir">
                </div>
                <div class="col-md-5 mb-3">
                    <label for="cabang" class="form-label">Cabang</label>
                    <select name="cabang" id="cabang" class="form-select">
                        @foreach ($cabs as $cabang)
                            <option value="{{ $cabang->name }}" {{ old('cabang') == $cabang->name ? 'selected' : '' }}>
                                {{ $cabang->name }}</option>
                        @endforeach
                    </select>
                    @error('cabang')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div>
                <!-- Tombol Filter -->
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" id="filter-btn" class="btn btn-primary"><i class="fa fa-search"
                            aria-hidden="true"></i> Filter</button>
                </div>
            </div>
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
                        <th>Tanggal Izin</th>
                        <th>Tanggal Lembur</th>
                        <th>Jam Lembur</th>
                        <th>Alasan</th>
                        <th>Status</th>
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
                            <td>{{ date('d/m/Y', strtotime($terlambat->tanggal)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($terlambat->tgl_awal)) }}</td>
                            <td>{{ $terlambat->jam }}</td>
                            <td>{{ $terlambat->alasan }}</td>
                            <td>{{ $terlambat->approval2 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @push('scripts')
            <script type="module">
                $(document).ready(function() {
                    $('#absensi').DataTable();

                    function formatDateToDMY(dateString) {
                        var date = new Date(dateString);
                        var day = date.getDate().toString().padStart(2, '0');
                        var month = date.toLocaleString('id-ID', {
                            month: 'long'
                        });
                        var year = date.getFullYear();
                        return day + ' ' + month + ' ' + year;
                    }


                    function formatDate(dateString) {
                        var date = new Date(dateString);
                        var day = date.getDate();
                        var month = date.getMonth() + 1; // Ingat bulan dimulai dari 0, sehingga perlu ditambahkan 1
                        var year = date.getFullYear();
                        var formattedDate = day.toString().padStart(2, '0') + '/' + month.toString().padStart(2, '0') +
                            '/' + year.toString();
                        return formattedDate;
                    }

                    function updateBulan(tanggalAwal, tanggalAkhir) {
                        if (tanggalAwal !== '' && tanggalAkhir !== '') {
                            var formattedTanggalAwal = formatDateToDMY(tanggalAwal);
                            var formattedTanggalAkhir = formatDateToDMY(tanggalAkhir);

                            $('#bulan').text('Tanggal ' + formattedTanggalAwal + ' s/d ' + formattedTanggalAkhir);
                        } else {
                            $('#bulan').text('');
                        }
                    }
                    // Tangani filter saat tombol diklik
                    $('#filter-btn').click(function() {
                        var tanggalAwal = $('#tanggal_awal').val();
                        var tanggalAkhir = $('#tanggal_akhir').val();
                        var cabang = $('#cabang').val();

                        // Validasi tanggal awal dan akhir
                        if (tanggalAwal === '' || tanggalAkhir === '') {
                            alert('Silakan pilih tanggal awal dan tanggal akhir');
                            return;
                        }

                        // Panggil fungsi updateBulan untuk menampilkan rentang tanggal
                        updateBulan(tanggalAwal, tanggalAkhir);

                        // Kirim permintaan AJAX untuk memperbarui tabel
                        $.ajax({
                            url: '{{ route('filter-Lembur') }}', // Ganti dengan nama route yang sesuai
                            type: 'GET',
                            data: {
                                tanggal_awal: tanggalAwal,
                                tanggal_akhir: tanggalAkhir,
                                cabang: cabang,
                            },
                            success: function(response) {
                                // Destroy the existing DataTable
                                if ($.fn.DataTable.isDataTable('#absensi')) {
                                    $('#absensi').DataTable().destroy();
                                }

                                // Remove existing tbody content
                                $('#absensi tbody').empty();

                                // Add new data to tbody
                                $.each(response.data, function(index, terlambat) {

                                    var newRow = '<tr>' +
                                        '<td align="center">' + (index + 1) + '</td>' +
                                        '<td>' + terlambat.id_terlambat + '</td>' +
                                        '<td>' + terlambat.nik + '</td>' +
                                        '<td>' + terlambat.nama + '</td>' +
                                        '<td>' + terlambat.jabatan + '</td>' +
                                        '<td>' + terlambat.dept + '</td>' +
                                        '<td>' + terlambat.cab + '</td>' +
                                        '<td>' + formatDate(terlambat.tanggal) + '</td>' +
                                        '<td>' + formatDate(terlambat.tgl_awal) + '</td>' +
                                        '<td>' + terlambat.jam + '</td>' +
                                        '<td>' + terlambat.alasan + '</td>' +
                                        '<td>' + terlambat.approval2 + '</td>' +
                                        '</tr>';
                                    '</tr>';
                                    $('#absensi tbody').append(newRow);
                                });

                                // Reinitialize DataTable with the new data
                                $('#absensi').DataTable({
                                    // DataTable initialization options here
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });

                    $('#export-excel-button').click(function() {
                        var tanggalAwal = $('#tanggal_awal').val();
                        var tanggalAkhir = $('#tanggal_akhir').val();
                        var cabang = $('#cabang').val();

                        // Validasi form sebelum ekspor
                        if (tanggalAwal === '' || tanggalAkhir === '' || cabang === '') {
                            alert('Silahkan isi semua kolom filter terlebih dahulu.');
                            return;
                        }

                        // Redirect ke URL untuk ekspor Excel dengan filter yang sama
                        window.location.href = '{{ route('export.excel.Lembur') }}' + '?tanggal_awal=' +
                            tanggalAwal +
                            '&tanggal_akhir=' + tanggalAkhir + '&cabang=' + cabang;
                    });

                    // Tangani klik tombol ekspor PDF (sama seperti ekspor Excel)
                    $('#export-pdf-button').click(function() {
                        var tanggalAwal = $('#tanggal_awal').val();
                        var tanggalAkhir = $('#tanggal_akhir').val();
                        var cabang = $('#cabang').val();

                        if (tanggalAwal === '' || tanggalAkhir === '' || cabang === '') {
                            alert('Silahkan isi semua kolom filter terlebih dahulu.');
                            return;
                        }
                        window.location.href = '{{ route('export.pdf.Lembur') }}' + '?tanggal_awal=' +
                            tanggalAwal +
                            '&tanggal_akhir=' + tanggalAkhir + '&cabang=' + cabang;
                    });
                });
            </script>
        @endpush
    @endif
@endsection

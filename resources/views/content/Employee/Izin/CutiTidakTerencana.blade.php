@extends('layouts.employee-layout')

@section('content')
    <div class="container-sm mt-5">
        @if ($isWithinAllowedTime)
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center text-dark">
                    <div class="p-5 rounded-3 border col-xl-6" style="background-color: #d4d5d5;">
                        <div class="mb-3 text-center">
                            <img class="img-fluid "
                                src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}"alt="image">
                            </i>
                            <h4>{{ $pageTitle }}</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="who" class="form-label">Nama</label>
                                <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                    id="who" placeholder="Masukkan Nama" value="{{ auth()->user()->who }}" readonly>
                                @error('who')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input class="form-control @error('nik')is-invalid @enderror" type="text" name="nik"
                                    id="nik" placeholder="Masukkan Nama" value="{{ auth()->user()->nik }}" readonly>
                                @error('nik')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                                <input
                                    class="form-control @error('tanggal_pengajuan') is-invalid @enderror custom-placeholder"
                                    type="date" name="tanggal_pengajuan" id="tanggal_pengajuan"
                                    value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_awal" class="form-label">Tanggal Awal Cuti</label>
                                <input class="form-control @error('tgl_awal') is-invalid  @enderror custom-placeholder"
                                    type="date" name="tgl_awal" id="tgl_awal">
                                <div id="tgl_awal_error" class="text-danger"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_akhir" class="form-label">Tanggal Akhir Cuti</label>
                                <input class="form-control @error('tgl_akhir') is-invalid  @enderror custom-placeholder"
                                    type="date" name="tgl_akhir" id="tgl_akhir">
                                <div id="tgl_akhir_error" class="text-danger"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label">Jumlah cuti</label>
                                <input class="form-control @error('jumlah')is-invalid @enderror" type="text"
                                    name="jumlah" id="jumlah" value="" readonly>
                                @error('jumlah')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="keperluan" class="form-label">Keperluan</label>
                                <textarea class="form-control @error('keperluan') is-invalid @enderror" type="text" name="keperluan" id="keperluan"
                                    style="height:100px">{{ old('keperluan') }}</textarea>
                                <div id="keperluan_error" class="text-danger"></div>
                                @error('keperluan')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-select">
                                    <option value="Cuti Keperluan Pribadi">Cuti Keperluan Pribadi</option>
                                    {{-- <option value="Cuti Menikah (2 hari)">Cuti Menikah (2 hari)</option>
                                    <option value="Cuti Bersalin (3 bulan)">Cuti Bersalin (3 bulan)</option>
                                    <option value="Cuti Mengkhitan/Membabtis (2 hari)">Cuti Mengkhitan/Membabtis (2 hari)
                                    </option>
                                    <option value="Cuti Haji/Ziarah Tanah Suci (40 hari / 14 hari)">Cuti Haji/Ziarah Tanah
                                        Suci (40 hari / 14 hari)</option>
                                    <option value="Cuti Tahunan">Cuti Tahunan</option> --}}
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pengganti" class="form-label">Pengganti</label>
                                <select name="pengganti" id="pengganti" class="form-select">
                                    @foreach ($pengganti as $penggantiUser)
                                        <option value="{{ $penggantiUser->who }}">{{ $penggantiUser->who }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-grid">
                                <a href="{{ route('employee-form.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
                                        class="fa fa-arrow-left me-2"></i>
                                    Cancel</a>
                            </div>
                            <div class="col-md-6 d-grid">
                                <button type="submit" class="btn btn-success btn-lg mt-3" id="submitBtn">
                                    <i class="fa fa-check me-2"></i> Save
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        @else
            <p class="text-danger">Izin Pulang Awal Tidak Bisa Diakses, Izin hanya dapat diakses pada jam 08.01 - 15.59</p>
        @endif
    </div>
    <script>
        var startDateInput = document.getElementById('tgl_awal');
        var endDateInput = document.getElementById('tgl_akhir');
        var jumlahInput = document.getElementById('jumlah');
        var endDateError = document.getElementById('tgl_akhir_error'); // Pesan kesalahan
        var submitBtn = document.getElementById('submitBtn');

        // Menonaktifkan tombol "Save" secara default
        submitBtn.setAttribute('disabled', 'true');

        // Mendengarkan perubahan pada input tanggal
        startDateInput.addEventListener('input', calculateDuration);
        endDateInput.addEventListener('input', calculateDuration);

        function calculateDuration() {
            var startDate = new Date(startDateInput.value);
            var endDate = new Date(endDateInput.value);

            if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && endDate >= startDate) {
                // Menghitung durasi dalam hari
                var timeDifference = endDate - startDate;
                var daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) + 1;

                // Memperbarui nilai input "Jumlah sakit" dan pesan kesalahan
                jumlahInput.value = daysDifference + ' hari';
                endDateError.textContent = ''; // Menghapus pesan kesalahan jika tanggal valid

                // Mengaktifkan tombol "Save" karena tidak ada pesan kesalahan
                submitBtn.removeAttribute('disabled');
            } else {
                jumlahInput.value = ''; // Menghapus nilai jika tanggal tidak valid
                endDateError.textContent =
                    'Tanggal akhir harus lebih besar atau sama dengan tanggal awal'; // Menampilkan pesan kesalahan

                // Menonaktifkan tombol "Save" ketika ada pesan kesalahan
                submitBtn.setAttribute('disabled', 'true');
            }
        }
    </script>
    <script>
        // Ambil elemen input dan elemen pesan kesalahan
        var tanggalPengajuanInput = document.getElementById('tanggal_pengajuan');
        var tanggalAwalCutiInput = document.getElementById('tgl_awal');
        var tglAwalError = document.getElementById('tgl_awal_error');
        var submitBtn = document.getElementById('submitBtn');

        // Tambahkan event listener untuk memantau perubahan pada tanggal awal cuti
        tanggalAwalCutiInput.addEventListener('change', function() {
            // Ambil tanggal dari input
            var tanggalPengajuan = new Date(tanggalPengajuanInput.value);
            var tanggalAwalCuti = new Date(this.value);

            // Hitung perbedaan dalam milisekon
            var perbedaan = tanggalAwalCuti - tanggalPengajuan;

            // Hitung perbedaan dalam hari
            var perbedaanHari = perbedaan / (1000 * 60 * 60 * 24);

            // Jika perbedaan kurang dari 14 hari, tampilkan pesan kesalahan dan nonaktifkan tombol "Submit"
            if (perbedaanHari < 14) {
                tglAwalError.textContent =
                    'Tanggal awal cuti harus lebih besar dari 14 hari dari tanggal pengajuan.';
                submitBtn.setAttribute('disabled', 'true');
            } else {
                tglAwalError.textContent = ''; // Hapus pesan kesalahan jika valid
                // submitBtn.removeAttribute('disabled'); // Aktifkan tombol "Submit"
            }
        });
    </script>

@endsection

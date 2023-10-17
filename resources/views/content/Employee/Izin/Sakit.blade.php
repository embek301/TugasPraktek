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
                                <label for="tgl_awal" class="form-label">Tanggal Awal Sakit</label>
                                <input class="form-control @error('tgl_awal') is-invalid  @enderror custom-placeholder"
                                    type="date" name="tgl_awal" id="tgl_awal">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_akhir" class="form-label">Tanggal Akhir Sakit</label>
                                <input class="form-control @error('tgl_akhir') is-invalid  @enderror custom-placeholder"
                                    type="date" name="tgl_akhir" id="tgl_akhir">
                                <div id="tgl_akhir_error" class="text-danger"></div> <!-- Pesan kesalahan -->
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label">Jumlah sakit</label>
                                <input class="form-control @error('jumlah')is-invalid @enderror" type="text"
                                    name="jumlah" id="jumlah" value="" readonly>
                                @error('jumlah')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan/Diagonosa</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan"
                                    id="keterangan" value="{{ old('keterangan') }}"style="height:100px"></textarea>
                                @error('keterangan')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <label for="surat_dokter">Upload Surat Dokter</label>
                            <input type="file" class="form-control bg-transparent" id="surat_dokter" name="surat_dokter"
                                accept=".jpg, .pdf, .docx" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-grid">
                                <a href="{{ route('employee-form.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
                                        class="fa fa-arrow-left me-2"></i>
                                    Cancel</a>
                            </div>
                            <div class="col-md-6 d-grid">
                                <button type="submit" class="btn btn-success btn-lg mt-3"><i class="fa fa-check me-2"></i>
                                    Save</button>
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
        // Mendapatkan elemen-elemen input tanggal dan pesan kesalahan
        var startDateInput = document.getElementById('tgl_awal');
        var endDateInput = document.getElementById('tgl_akhir');
        var jumlahInput = document.getElementById('jumlah');
        var endDateError = document.getElementById('tgl_akhir_error'); // Pesan kesalahan

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
            } else {
                jumlahInput.value = ''; // Menghapus nilai jika tanggal tidak valid
                endDateError.textContent =
                    'Tanggal akhir harus lebih besar atau sama dengan tanggal awal'; // Menampilkan pesan kesalahan
            }
        }
    </script>
@endsection

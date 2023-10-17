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
                                <label for="nik" class="form-label">NIK</label>
                                <input class="form-control @error('nik')is-invalid @enderror" type="text" name="nik"
                                    id="nik" placeholder="Masukkan Nama" value="{{ auth()->user()->nik }}" readonly>
                                @error('nik')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="who" class="form-label">Nama</label>
                                <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                    id="who" placeholder="Masukkan Nama" value="{{ auth()->user()->who }}" readonly>
                                @error('who')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input class="form-control @error('jabatan')is-invalid @enderror" type="text"
                                    name="jabatan" id="jabatan" placeholder="Masukkan Nama"
                                    value="{{ auth()->user()->jabatan }}" readonly>
                                @error('jabatan')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal Pengajuan</label>
                                <input class="form-control @error('tanggal') is-invalid @enderror custom-placeholder"
                                    type="date" name="tanggal" id="tanggal"
                                    value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_lembur" class="form-label">Tanggal Lembur</label>
                                <input class="form-control @error('tgl_lembur') is-invalid  @enderror custom-placeholder"
                                    type="date" name="tgl_lembur" id="tgl_lembur" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="waktu" class="form-label">Waktu Lembur</label>
                                <div class="input-group">
                                    <input class="form-control @error('waktu') is-invalid  @enderror custom-placeholder"
                                        type="number" name="waktu" id="waktu" min="1"required >
                                    <span class="input-group-text">jam</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alasanLembur" class="form-label">Alasan Lembur</label>
                                <textarea class="form-control @error('alasanLembur') is-invalid @enderror" type="text" name="alasanLembur"
                                    id="alasanLembur" value="{{ old('alasanLembur') }}" placeholder="Alasan Pulang" style="height:100px" required></textarea>
                                @error('alasanLembur')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
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
            <p class="text-danger">Izin Lembur Tidak Bisa Diakses, Izin hanya dapat diakses pada jam 16.00</p>
        @endif
    </div>
@endsection

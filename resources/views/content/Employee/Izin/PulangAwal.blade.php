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
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input class="form-control @error('tanggal') is-invalid @enderror custom-placeholder"
                                    type="date" name="tanggal" id="tanggal"
                                    value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <input class="form-control @error('waktu') is-invalid  @enderror custom-placeholder"
                                    type="text" name="waktu" id="waktu"
                                    value="{{ $dateInGMTPlus7->format('H:i:s') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alasanPulang" class="form-label">Alasan Pulang Awal</label>
                                <textarea class="form-control @error('alasanPulang') is-invalid @enderror" type="text" name="alasanPulang"
                                    id="alasanPulang" value="{{ old('alasanPulang') }}" placeholder="Alasan Pulang" style="height:100px"></textarea>
                                @error('alasanPulang')
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
            <p class="text-danger">Izin Pulang Awal Tidak Bisa Diakses, Izin hanya dapat diakses pada jam 08.01 - 15.59</p>
        @endif
    </div>
@endsection

@extends('layouts.employee-layout')
@section('content')
    <style>
        /* Define a custom CSS class to style the placeholder color */
        .custom-placeholder::placeholder {
            color: #a7a4a4;
            /* Set your desired color */
        }
    </style>
    <div class="container-sm mt-5">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center text-dark">
                <div class="p-5 rounded-3 border col-xl-6" style="background-color: #d4d5d5;">
                    <div class="mb-3 text-center">
                        <img class="img-fluid " src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}"alt="image">
                        </i>
                        <h4>{{ $pageTitle }} {{$izinTerlambat->jenis}}</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="who" class="form-label">Nama</label>
                            <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                id="who" placeholder="Masukkan Nama" value="{{ $izinTerlambat->nama }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control @error('nik')is-invalid @enderror" type="text" name="nik"
                                id="nik" placeholder="Masukkan Nama" value="{{ $izinTerlambat->nik }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input class="form-control @error('tanggal') is-invalid @enderror custom-placeholder"
                                type="date" name="tanggal" id="tanggal"
                                value="{{ date('Y-m-d', strtotime($izinTerlambat->tanggal)) }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input class="form-control @error('waktu') is-invalid  @enderror custom-placeholder"
                                type="text" name="waktu" id="waktu" value="{{ $izinTerlambat->jam }}" readonly>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="alasanTerlambat" class="form-label">Alasan Terlambat</label>
                            <input class="form-control @error('alasanTerlambat') is-invalid  @enderror custom-placeholder"
                                type="text" name="alasanTerlambat" id="alasanTerlambat"
                                value="{{ $izinTerlambat->alasan }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_persetujuan" class="form-label">Tanggal Persetujuan</label>
                            <input
                                class="form-control @error('tanggal_persetujuan') is-invalid @enderror custom-placeholder"
                                type="date" name="tanggal_persetujuan" id="tanggal_persetujuan"
                                value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="diterima"
                                    value="Diterima">
                                <label class="form-check-label" for="diterima">
                                    Diterima
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="ditolak"
                                    value="Ditolak">
                                <label class="form-check-label" for="ditolak">
                                    Ditolak
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="alasanDiterima" class="form-label">Alasan Diterima</label>
                            <textarea class="form-control @error('alasanDiterima') is-invalid @enderror" type="text" name="alasanDiterima"
                                id="alasanDiterima" value="{{ old('alasanDiterima') }}" placeholder="Alasan Terlambat" style="height:100px"></textarea>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="last" class="form-label">Last User</label>
                            <input class="form-control @error('last')is-invalid @enderror" type="text" name="last"
                                id="last" placeholder="Masukkan Nama" value="{{ auth()->user()->who }}" readonly>
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
    </div>
@endsection

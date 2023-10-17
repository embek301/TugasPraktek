@extends('layouts.employee-layout')
@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('list-cuti.update', [$izinTerlambat->id_terlambat]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-center text-dark">
                <div class="p-5 rounded-3 border col-xl-6" style="background-color: #d4d5d5;">
                    <div class="mb-3 text-center">
                        <img class="img-fluid " src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}"alt="image">
                        </i>
                        <h4>{{ $pageTitle }} {{ $izinTerlambat->jenis }}</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idCuti" class="form-label">Id Terlambat</label>
                            <input class="form-control @error('idCuti')is-invalid @enderror" type="text" name="idCuti"
                                id="idCuti" placeholder="Masukkan Nama" value="{{ $izinTerlambat->id_terlambat }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="who" class="form-label">Nama</label>
                            <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                id="who" placeholder="Masukkan Nama" value="{{ $izinTerlambat->nama }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input class="form-control" type="text" name="jabatan" id="jabatan"
                                value="{{ $jabatanUser }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control @error('nik')is-invalid @enderror" type="text" name="nik"
                                id="nik" placeholder="Masukkan Nama" value="{{ $izinTerlambat->nik }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal Izin</label>
                            <input class="form-control @error('tanggal') is-invalid @enderror custom-placeholder"
                                type="date" name="tanggal" id="tanggal"
                                value="{{ date('Y-m-d', strtotime($izinTerlambat->tanggal)) }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tgl_awal" class="form-label">Tanggal Awal Cuti</label>
                            <input class="form-control @error('tgl_awal') is-invalid @enderror custom-placeholder"
                                type="date" name="tgl_awal" id="tgl_awal" value="{{ $izinTerlambat->tgl_awal }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_akhir" class="form-label">Tanggal Akhir Cuti</label>
                            <input class="form-control @error('tgl_akhir') is-invalid @enderror custom-placeholder"
                                type="date" name="tgl_akhir" id="tgl_akhir" value="{{ $izinTerlambat->tgl_akhir }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input class="form-control @error('kategori') is-invalid @enderror custom-placeholder"
                                type="text" name="kategori" id="kategori" value="{{ $izinTerlambat->kategori }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_cuti" class="form-label">Jumlah Hari</label>
                            <input class="form-control @error('jumlah_cuti') is-invalid @enderror custom-placeholder"
                                type="text" name="jumlah_cuti" id="jumlah_cuti" value="{{ $izinTerlambat->hari }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pengganti" class="form-label">Pengganti</label>
                            <input class="form-control @error('pengganti') is-invalid @enderror custom-placeholder"
                                type="text" name="pengganti" id="pengganti" value="{{ $izinTerlambat->pengganti }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_app3" class="form-label">Tanggal Approval 1</label>
                            <input class="form-control @error('tgl_app3') is-invalid @enderror custom-placeholder"
                                type="date" name="tgl_app3" id="tgl_app3"
                                value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="alasanCuti" class="form-label">Alasan</label>
                            <input class="form-control @error('alasanCuti') is-invalid  @enderror custom-placeholder"
                                type="text" name="alasanCuti" id="alasanCuti" value="{{ $izinTerlambat->alasan }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status3" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status3" id="diterima"
                                    value="Diterima" checked>
                                <label class="form-check-label" for="diterima">
                                    Diterima
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status3" id="ditolak"
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

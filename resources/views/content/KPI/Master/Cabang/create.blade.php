@extends('layouts.kpi-layout')

@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('cabang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center text-dark">
                <div class="p-5 rounded-3 border col-xl-6" style="background-color: #d4d5d5;">
                    <div class="mb-3 text-center">
                        <img class="img-fluid " src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}"alt="image">
                        </i>
                        <h4>{{ $pageTitle }}</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_cabang" class="form-label">Nama Cabang</label>
                            <input class="form-control @error('nama_cabang')is-invalid @enderror" type="text"
                                name="nama_cabang" id="nama_cabang" value="{{ old('nama_cabang') }}"
                                placeholder="Masukkan Nama ">
                            @error('nama_cabang')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_admin" class="form-label">Nama Admin Unit</label>
                            <input class="form-control @error('nama_admin')is-invalid @enderror" type="text"
                                name="nama_admin" id="nama_admin" value="{{ old('nama_admin') }}"
                                placeholder="Masukkan Nama ">
                            @error('nama_admin')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_pic" class="form-label">Nama PIC</label>
                            <input class="form-control @error('nama_pic')is-invalid @enderror" type="text"
                                name="nama_pic" id="nama_pic" value="{{ old('nama_pic') }}" placeholder="Masukkan Nama ">
                            @error('nama_pic')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_head" class="form-label">Nama Head</label>
                            <input class="form-control @error('nama_head')is-invalid @enderror" type="text"
                                name="nama_head" id="nama_head" value="{{ old('nama_head') }}" placeholder="Masukkan Nama ">
                            @error('nama_head')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_kabeng" class="form-label">Nama Kabeng</label>
                            <input class="form-control @error('nama_kabeng')is-invalid @enderror" type="text"
                                name="nama_kabeng" id="nama_kabeng" value="{{ old('nama_kabeng') }}"
                                placeholder="Masukkan Nama ">
                            @error('nama_kabeng')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('cabang.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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
    </div>
    </form>

    </div>
@endsection

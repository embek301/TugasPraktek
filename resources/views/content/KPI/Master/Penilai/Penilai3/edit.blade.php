@extends('layouts.kpi-layout')


@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('penilai3.update', ['penilai3' => $penilai3->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-center text-dark">
                <div class="p-5 rounded-3 border col-xl-6" style="background-color: #d4d5d5;">
                    <div class="mb-3 text-center">
                        <img class="img-fluid " src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}"alt="image">
                        </i>
                        <h4>{{ $pageTitle }}</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_penilai3" class="form-label">Nama penilai3</label>
                            <input class="form-control @error('nama_penilai3')is-invalid @enderror" type="text"
                                name="nama_penilai3" id="nama_penilai3"
                                value="{{ $errors->any() ? old('nama_penilai3') : $penilai3->name }}"
                                placeholder="Masukkan Nama"oninput="this.value = this.value.toUpperCase()">
                            @error('nama_penilai3')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-grid">
                                <a href="{{ route('penilai3.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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

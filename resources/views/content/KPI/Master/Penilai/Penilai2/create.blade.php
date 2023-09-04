@extends('layouts.kpi-layout')

@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('pen2.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-12">
                            <label for="nama_penilai2" class="form-label">Nama Penilai 2</label>
                            <input class="form-control @error('nama_penilai2')is-invalid @enderror" type="text"
                                name="nama_penilai2" id="nama_penilai2" value="{{ old('nama_penilai2') }}"
                                placeholder="Masukkan Nama " oninput="this.value = this.value.toUpperCase()">
                            @error('nama_penilai2')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('pen2.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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

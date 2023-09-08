@extends('layouts.kpi-layout')

@section('content')
    <style>
        /* Define a custom CSS class to style the placeholder color */
        .custom-placeholder::placeholder {
            color: #a7a4a4;
            /* Set your desired color */
        }
    </style>
    <div class="container-sm mt-5">
        <form action="{{ route('pen4.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-14">
                            <label for="nama_penilai4" class="form-label">Nama Penilai 4</label>
                            <input class="form-control @error('nama_penilai4')is-invalid @enderror custom-placeholder"
                                type="text" name="nama_penilai4" id="nama_penilai4" value="{{ old('nama_penilai4') }}"
                                placeholder="Masukkan Nama " oninput="this.value = this.value.toUpperCase()">
                            @error('nama_penilai4')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('pen4.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
                                    class="fa fa-arrow-left me-4"></i>
                                Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-success btn-lg mt-3"><i class="fa fa-check me-4"></i>
                                Save</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>

    </div>
@endsection

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
    <form action="{{ route('penilai2.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center text-dark">
            <div class="p-5 rounded-3 border col-xl-6" style="background-color: #d4d5d5;">
                <div class="mb-3 text-center">
                    <img class="img-fluid " src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}" alt="image">
                    <h4>{{ $pageTitle }}</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label for="nama_penilai2" class="form-label">Nama Penilai 2</label>
                        <select name="nama_penilai2" id="nama_penilai2" class="form-select">
                            @foreach ($user as $nama_penilai2)
                            <option value="{{ $nama_penilai2->who }}"
                                {{ old('nama_penilai2') == $nama_penilai2->who ? 'selected' : '' }}>
                                {{ $nama_penilai2->who }}</option>
                            @endforeach
                        </select>
                        @error('nama_penilai2')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <a href="{{ route('penilai2.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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

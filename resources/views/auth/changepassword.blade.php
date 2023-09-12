@extends('layouts.app')

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
                        <h4>{{ $pageTitle }}</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input class="form-control @error('current_password')is-invalid @enderror custom-placeholder"
                                type="password" name="current_password" id="current_password"
                                value="{{ old('current_password') }}" placeholder="Password Lama ">
                            @error('current_password')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input class="form-control @error('new_password')is-invalid @enderror custom-placeholder"
                                type="password" name="new_password" id="new_password" value="{{ old('new_password') }}"
                                placeholder="Password Baru ">
                            @error('new_password')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input class="form-control @error('new_password')is-invalid @enderror custom-placeholder"
                                type="password" name="new_password_confirmation" id="new_password_confirmation"
                                value="{{ old('new_password_confirmation') }}" placeholder="Konfirmasi Password Baru ">
                            @error('new_password_confirmation')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('home') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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

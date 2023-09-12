@extends('layouts.kpi-layout')


@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('cabang.update', ['cabang' => $cabang->id]) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-6 mb-3">
                            <label for="nama_cabang" class="form-label">Nama Cabang</label>
                            <input class="form-control @error('nama_cabang')is-invalid @enderror" type="text"
                                name="nama_cabang" id="nama_cabang"
                                value="{{ $errors->any() ? old('nama_cabang') : $cabang->name }}"
                                placeholder="Masukkan Nama Cabang"oninput="this.value = this.value.toUpperCase()">
                            @error('nama_cabang')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_admin" class="form-label">Nama Admin Unit</label>
                            <select name="nama_admin" id="nama_admin" class="form-select">
                                @foreach ($user->where('jabatan', '13') as $admin)
                                    <option value="{{ $admin->who }}"
                                        {{ old('nama_admin', $cabang->admin) == $admin->who ? 'selected' : '' }}>
                                        {{ $admin->who }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_admin')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_pic" class="form-label">Nama PIC</label>
                            <select name="nama_pic" id="nama_pic" class="form-select">
                                @foreach ($user->where('jabatan', '8') as $pic)
                                    <option value="{{ $pic->who }}"
                                        {{ old('nama_pic', $cabang->pic) == $pic->who ? 'selected' : '' }}>
                                        {{ $pic->who }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_head')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_head" class="form-label">Nama Head</label>
                            <select name="nama_head" id="nama_head" class="form-select">
                                @foreach ($user->where('jabatan', '21') as $head)
                                    <option value="{{ $head->who }}"
                                        {{ old('nama_head', $cabang->head) == $head->who ? 'selected' : '' }}>
                                        {{ $head->who }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_head')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_kabeng" class="form-label">Nama Kabeng</label>
                            <select name="nama_kabeng" id="nama_kabeng" class="form-select">
                                @foreach ($user->where('jabatan', '20') as $kabeng)
                                    <option value="{{ $kabeng->who }}"
                                        {{ old('nama_kabeng', $cabang->kabeng) == $kabeng->who ? 'selected' : '' }}>
                                        {{ $kabeng->who }}
                                    </option>
                                @endforeach
                            </select>
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
        </form>
    </div>
@endsection

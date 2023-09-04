@extends('layouts.kpi-layout')

@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('kpi.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control @error('nik')is-invalid @enderror" type="text" name="nik"
                                id="nik" placeholder="Masukkan NIK">
                            @error('nik')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="who" class="form-label">Nama</label>
                            <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                id="who" value="{{ old('who') }}" placeholder="Masukkan Nama ">
                            @error('who')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" type="text"
                                name="username" id="username" value="{{ old('username') }}"
                                placeholder="Masukkan username ">
                            @error('username')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" id="password" value="{{ old('password') }}"
                                placeholder="Masukkan password ">
                            @error('password')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="penilai2" class="form-label">Penilai 2</label>
                            <select name="penilai2" id="penilai2" class="form-select">
                                @foreach ($penilai2 as $penilai2)
                                    <option value="{{ $penilai2->id }}"
                                        {{ old('penilai2') == $penilai2->id ? 'selected' : '' }}>
                                        {{ $penilai2->id . '. ' . $penilai2->name }}</option>
                                @endforeach
                            </select>
                            @error('penilai2')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="penilai3" class="form-label">Penilai 3</label>
                            <select name="penilai3" id="penilai3" class="form-select">
                                @foreach ($penilai3 as $penilai3)
                                    <option value="{{ $penilai3->id }}"
                                        {{ old('penilai3') == $penilai3->id ? 'selected' : '' }}>
                                        {{ $penilai3->id . '. ' . $penilai3->name }}</option>
                                @endforeach
                            </select>
                            @error('penilai3')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="penilai4" class="form-label">Penilai 4</label>
                            <select name="penilai4" id="penilai4" class="form-select">
                                @foreach ($penilai4 as $penilai4)
                                    <option value="{{ $penilai4->id }}"
                                        {{ old('penilai4') == $penilai4->id ? 'selected' : '' }}>
                                        {{ $penilai4->id . '. ' . $penilai4->name }}</option>
                                @endforeach
                            </select>
                            @error('penilai4')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cabang" class="form-label">Cabang</label>
                            <select name="cabang" id="cabang" class="form-select">
                                @foreach ($cabs as $cabang)
                                    <option value="{{ $cabang->id }}"
                                        {{ old('cabang') == $cabang->id ? 'selected' : '' }}>
                                        {{ $cabang->id . '. ' . $cabang->name }}</option>
                                @endforeach
                            </select>
                            @error('cabang')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departemen" class="form-label">Departemen</label>
                            <select name="departemen" id="departemen" class="form-select">
                                @foreach ($depts as $departemen)
                                    <option value="{{ $departemen->id }}"
                                        {{ old('departemen') == $departemen->id ? 'selected' : '' }}>
                                        {{ $departemen->id . '. ' . $departemen->name }}</option>
                                @endforeach
                            </select>
                            @error('departemen')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hak" class="form-label">Hak</label>
                            <select name="hak" id="hak" class="form-select">
                                @foreach ($hak as $hak)
                                    <option value="{{ $hak->id }}" {{ old('hak') == $hak->id ? 'selected' : '' }}>
                                        {{ $hak->id }}</option>
                                @endforeach
                            </select>
                            @error('hak')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="golongan" class="form-label">golongan</label>
                            <select name="golongan" id="golongan" class="form-select">
                                @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}"
                                        {{ old('golongan') == $gol->id ? 'selected' : '' }}>
                                        {{ $gol->name }}</option>
                                @endforeach
                            </select>
                            @error('golongan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <input class="form-control @error('grade') is-invalid @enderror" type="number"
                                name="grade" id="grade" value="{{ old('grade') }}" placeholder="Masukkan grade">
                            @error('grade')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                            <input class="form-control @error('tgl_masuk') is-invalid @enderror" type="date"
                                name="tgl_masuk" id="tgl_masuk">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-select">
                                @foreach ($jabatan as $jab)
                                    <option value="{{ $jab->id }}" {{ old('jab') == $jab->id ? 'selected' : '' }}>
                                        {{ $jab->name }}</option>
                                @endforeach
                            </select>
                            @error('jabatan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan email">
                            @error('email')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="aktif" class="form-label">Aktif</label>
                            <input class="form-control @error('aktif') is-invalid @enderror" type="text"
                                name="aktif" id="aktif" value="{{ old('aktif') }}" placeholder="Masukkan aktif">
                            @error('aktif')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option>TRAINING</option>
                                <option>KONTRAK</option>
                                <option>TETAP</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_kontrak" class="form-label">Tanggal Kontrak</label>
                            <input class="form-control @error('tgl_kontrak') is-invalid @enderror" type="date"
                                name="tgl_kontrak" id="tgl_kontrak">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('kpi.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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

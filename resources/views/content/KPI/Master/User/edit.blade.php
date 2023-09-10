@extends('layouts.kpi-layout')

@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('user.update', ['user' => $users->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                                id="nik" placeholder="Masukkan NIK"
                                value="{{ $errors->any() ? old('nik') : $users->nik }}">
                            @error('nik')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="who" class="form-label">Nama</label>
                            <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                id="who" placeholder="Masukkan Nama"
                                value="{{ $errors->any() ? old('who') : $users->who }}">
                            @error('who')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control @error('username')is-invalid @enderror" type="text"
                                name="username" id="username" placeholder="Masukkan username"
                                value="{{ $errors->any() ? old('username') : $users->username }}">
                            @error('username')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input class="form-control @error('password') is-invalid @enderror custom-placeholder"
                                    type="password" name="password" id="password"
                                    value="{{ $errors->any() ? old('password') : $users->password }}"
                                    placeholder="Masukkan password">
                                <button class="btn btn-outline-secondary" type="button" id="password-toggle-btn">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="penilai2" class="form-label">Penilai 2</label>
                            <select name="penilai2" id="penilai2" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('penilai2');
                                    } else {
                                        $selected = $users->penilai2;
                                    }
                                @endphp
                                @foreach ($penilai2 as $pen2)
                                    <option value="{{ $pen2->id }}" {{ $selected == $pen2->id ? 'selected' : '' }}>
                                        {{ $pen2->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penilai2')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="penilai3" class="form-label">Penilai 3</label>
                            <select name="penilai3" id="penilai3" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('penilai3');
                                    } else {
                                        $selected = $users->penilai3;
                                    }
                                @endphp
                                @foreach ($penilai3 as $pen3)
                                    <option value="{{ $pen3->id }}" {{ $selected == $pen3->id ? 'selected' : '' }}>
                                        {{ $pen3->name }}
                                    </option>
                                @endforeach
                            </select>
                            </select>
                            @error('penilai3')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="penilai4" class="form-label">Penilai 4</label>
                            <select name="penilai4" id="penilai4" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('penilai4');
                                    } else {
                                        $selected = $users->penilai4;
                                    }
                                @endphp
                                @foreach ($penilai4 as $pen4)
                                    <option value="{{ $pen4->id }}" {{ $selected == $pen4->id ? 'selected' : '' }}>
                                        {{ $pen4->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penilai4')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cabang" class="form-label">Cabang</label>
                            <select name="cabang" id="cabang" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('cabang');
                                    } else {
                                        $selected = $users->cab;
                                    }
                                @endphp
                                @foreach ($cabs as $cab)
                                    <option value="{{ $cab->id }}" {{ $selected == $cab->id ? 'selected' : '' }}>
                                        {{ $cab->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cabang')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departemen" class="form-label">Departemen</label>
                            <select name="departemen" id="departemen" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('departemen');
                                    } else {
                                        $selected = $users->dept;
                                    }
                                @endphp
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}" {{ $selected == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departemen')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hak" class="form-label">Hak</label>
                            <select name="hak" id="hak" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('hak');
                                    } else {
                                        $selected = $users->hak;
                                    }
                                @endphp
                                @foreach ($hak as $hak)
                                    <option value="{{ $hak->id }}" {{ $selected == $hak->id ? 'selected' : '' }}>
                                        {{ $hak->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hak')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="golongan" class="form-label">golongan</label>
                            <select name="golongan" id="golongan" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('golongan');
                                    } else {
                                        $selected = $users->golongan;
                                    }
                                @endphp
                                @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}" {{ $selected == $gol->id ? 'selected' : '' }}>
                                        {{ $gol->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('golongan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <input class="form-control @error('grade') is-invalid @enderror" type="number"
                                name="grade" id="grade"
                                value="{{ $errors->any() ? old('grade') : $users->grade }}" placeholder="Masukkan grade">
                            @error('grade')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_masuk" class="form-label"> Masuk</label>
                            <input class="form-control @error('tgl_masuk') is-invalid @enderror datepicker" type="text"
                                name="tgl_masuk" id="tgl_masuk"
                                value="{{ old('tgl_masuk', \Carbon\Carbon::parse($users->tgl_masuk)->format('d/m/Y')) }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-select">
                                @php
                                    $selected = '';
                                    if ($errors->any()) {
                                        $selected = old('jabatan');
                                    } else {
                                        $selected = $users->jabatan;
                                    }
                                @endphp
                                @foreach ($jabatan as $jab)
                                    <option value="{{ $jab->id }}" {{ $selected == $jab->id ? 'selected' : '' }}>
                                        {{ $jab->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                name="email" id="email"
                                value="{{ $errors->any() ? old('email') : $users->email }}" placeholder="Masukkan email">
                            @error('email')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="aktif" class="form-label">Aktif</label>
                            <select class="form-select @error('aktif') is-invalid @enderror" name="aktif"
                                id="aktif">
                                <option value="1" @if ($users->aktif == 1) selected @endif>Aktif</option>
                                <option value="0" @if ($users->aktif == 0) selected @endif>Tidak Aktif
                                </option>
                            </select>
                            @error('aktif')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="TRAINING"
                                    {{ old('status', $users->status) === 'TRAINING' ? 'selected' : '' }}>TRAINING</option>
                                <option value="KONTRAK"
                                    {{ old('status', $users->status) === 'KONTRAK' ? 'selected' : '' }}>KONTRAK</option>
                                <option value="TETAP" {{ old('status', $users->status) === 'TETAP' ? 'selected' : '' }}>
                                    TETAP</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_kontrak" class="form-label">Tanggal Kontrak</label>
                            <input class="form-control @error('tgl_kontrak') is-invalid @enderror datepicker"
                                type="text" name="tgl_kontrak" id="tgl_kontrak"
                                value="{{ old('tgl_kontrak', $users->tgl_kontrak ? \Carbon\Carbon::parse($users->tgl_kontrak)->format('Y-m-d') : '') }}"
                                {{ $users->status === 'TETAP' ? 'readonly' : '' }} data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-danger btn-lg mt-3"><i
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
    <script>
        $(document).ready(function() {
            // Add a click event listener to the input
            $("#tgl_masuk").click(function() {
                // Change the input type to 'date' when clicked
                $(this).attr("type", "date");

                // Remove the 'readonly' attribute
                $(this).removeAttr("readonly");

                // Focus the input to open the date picker immediately
                $(this).focus();
            });

            // Add a blur event listener to revert to 'text' type when losing focus
            $("#tgl_masuk").blur(function() {
                // Change the input type back to 'text' if the value is empty
                if (!$(this).val()) {
                    $(this).attr("type", "text");
                    // Restore the original value if no date was selected
                    $(this).val(
                        "{{ old('tgl_masuk', \Carbon\Carbon::parse($users->tgl_masuk)->format('d/m/Y')) }}"
                    );
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var passwordField = document.getElementById("password");
            var passwordToggleBtn = document.getElementById("password-toggle-btn");

            passwordToggleBtn.addEventListener("click", function() {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    passwordToggleBtn.innerHTML =
                        '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
                } else {
                    passwordField.type = "password";
                    passwordToggleBtn.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to toggle the input type and readonly attribute
            function toggleTglKontrakInput() {
                const tglKontrakInput = $("#tgl_kontrak");
                const selectedStatus = $("#status").val();

                if (selectedStatus !== 'TETAP') {
                    // Allow editing when status is not TETAP
                    tglKontrakInput.prop("readonly", false);
                    tglKontrakInput.attr("type", "date");
                    // Set the date format to dd/mm/yyyy
                    tglKontrakInput.attr("data-date-format", "dd/mm/yyyy");
                } else {
                    // Disable and show the date when status is TETAP
                    tglKontrakInput.prop("readonly", true);
                    tglKontrakInput.attr("type", "text");
                    // Set the value to the original database date in dd/mm/yyyy format
                    tglKontrakInput.val(
                        "{{ $users->tgl_kontrak ? \Carbon\Carbon::parse($users->tgl_kontrak)->format('d/m/Y') : '' }}"
                    );
                }
            }

            // Handle status change event
            $("#status").change(toggleTglKontrakInput);

            // Initial state
            toggleTglKontrakInput();

            // Add a click event listener to show the date picker immediately
            $("#tgl_kontrak").click(function() {
                if (!$(this).prop("readonly")) {
                    $(this).attr("type", "date");
                    $(this).focus();
                }
            });

            // Add a blur event listener to revert to 'text' type when losing focus
            $("#tgl_kontrak").blur(function() {
                // Change the input type back to 'text' if the value is empty
                if (!$(this).val()) {
                    $(this).attr("type", "text");
                    // Set the value to the original database date in dd/mm/yyyy format
                    $(this).val(
                        "{{ $users->tgl_kontrak ? \Carbon\Carbon::parse($users->tgl_kontrak)->format('d/m/Y') : '' }}"
                    );
                }
            });

            // Handle date selection from the date picker
            $("#tgl_kontrak").on("change", function() {
                e
                if ($(this).val()) {
                    // Convert the selected date to a Carbon date
                    const selectedDate = $(this).val();
                    const carbonDate = moment(selectedDate, 'YYYY-MM-DD').format('DD/MM/YYYY');
                    $(this).val(carbonDate);
                } else {
                    // Handle null value here
                    // You can set the input value to null or any other desired behavior
                    // Example: $(this).val('');
                }
            });
        });
    </script>
@endsection

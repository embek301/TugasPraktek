@extends('layouts.employee-layout')
@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('izin-terlambat.update', ['izin_terlambat' => $izinTerlambat->id_terlambat]) }}" method="POST"
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
                            <label for="idTerlambat" class="form-label">Id Terlambat</label>
                            <input class="form-control @error('idTerlambat')is-invalid @enderror" type="text"
                                name="idTerlambat" id="idTerlambat" placeholder="Masukkan Nama"
                                value="{{ $izinTerlambat->id_terlambat }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control @error('nik')is-invalid @enderror" type="text" name="nik"
                                id="nik" placeholder="Masukkan Nama" value="{{ $izinTerlambat->nik }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="who" class="form-label">Nama</label>
                            <input class="form-control @error('who')is-invalid @enderror" type="text" name="who"
                                id="who" placeholder="Masukkan Nama" value="{{ $izinTerlambat->nama }}" readonly>
                        </div>
                        @if ($izinTerlambat->jenis == 'Izin Cuti Tidak Terencana' || $izinTerlambat->jenis == 'Izin Cuti Terencana')
                            <div class="col-md-6 mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input class="form-control" type="text" name="jabatan" id="jabatan"
                                    value="{{ $jabatanUser }}" readonly>
                            </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pengajuan</label>
                            <input class="form-control @error('tanggal') is-invalid @enderror custom-placeholder"
                                type="date" name="tanggal" id="tanggal"
                                value="{{ date('Y-m-d', strtotime($izinTerlambat->tanggal)) }}" readonly>
                        </div>
                        @if ($izinTerlambat->jenis == 'Izin Lembur')
                            <div class="col-md-6 mb-3">
                                <label for="JamLembur" class="form-label">Jam Lembur</label>
                                @php
                                    $jam = explode(':', $izinTerlambat->jam);
                                    $formattedJam = ltrim($jam[0], '0'); // Menghapus angka 0 di depan jam
                                @endphp
                                <input class="form-control @error('JamLembur') is-invalid @enderror custom-placeholder"
                                    type="text" name="JamLembur" id="JamLembur" value="{{ $formattedJam }} Jam" readonly>
                            </div>
                        @endif
                        @if (
                            $izinTerlambat->jenis !== 'Izin Sakit' &&
                                $izinTerlambat->jenis !== 'Izin Lembur' &&
                                $izinTerlambat->jenis !== 'Izin Cuti Tidak Terencana' &&
                                $izinTerlambat->jenis !== 'Izin Cuti Terencana')
                            <div class="col-md-6 mb-3">
                                <label for="waktu" class="form-label">Jam Izin</label>
                                <input class="form-control @error('waktu') is-invalid @enderror custom-placeholder"
                                    type="text" name="waktu" id="waktu" value="{{ $izinTerlambat->jam }}"
                                    readonly>
                            </div>
                        @endif
                        @if (auth()->user()->hak != 7 &&
                                $izinTerlambat->jenis !== 'Izin Cuti Tidak Terencana' &&
                                $izinTerlambat->jenis !== 'Izin Cuti Terencana')
                            <div class="col-md-6 mb-3">
                                <label for="tgl_app1" class="form-label">Tanggal Approval 1</label>
                                <input class="form-control @error('tgl_app1') is-invalid @enderror custom-placeholder"
                                    type="date" name="tgl_app1" id="tgl_app1"
                                    value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                            </div>
                        @endif
                        @if ($izinTerlambat->jenis !== 'Izin Cuti Tidak Terencana' && $izinTerlambat->jenis !== 'Izin Cuti Terencana')
                            <div class="col-md-12 mb-3">
                                <label for="alasanTerlambat" class="form-label">Alasan</label>
                                <input
                                    class="form-control @error('alasanTerlambat') is-invalid  @enderror custom-placeholder"
                                    type="text" name="alasanTerlambat" id="alasanTerlambat"
                                    value="{{ $izinTerlambat->alasan }}" readonly>
                            </div>
                        @endif
                        @if ($izinTerlambat->jenis == 'Izin Cuti Tidak Terencana' || $izinTerlambat->jenis == 'Izin Cuti Terencana')
                            <div class="col-md-6 mb-3">
                                <label for="tgl_awal" class="form-label">Tanggal Awal Cuti</label>
                                <input class="form-control @error('tgl_awal') is-invalid @enderror custom-placeholder"
                                    type="date" name="tgl_awal" id="tgl_awal" value="{{ $izinTerlambat->tgl_awal }}"
                                    readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_akhir" class="form-label">Tanggal Akhir Cuti</label>
                                <input class="form-control @error('tgl_akhir') is-invalid @enderror custom-placeholder"
                                    type="date" name="tgl_akhir" id="tgl_akhir"
                                    value="{{ $izinTerlambat->tgl_akhir }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_cuti" class="form-label">Jumlah Hari</label>
                                <input class="form-control @error('jumlah_cuti') is-invalid @enderror custom-placeholder"
                                    type="text" name="jumlah_cuti" id="jumlah_cuti"
                                    value="{{ $izinTerlambat->hari }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input class="form-control @error('kategori') is-invalid @enderror custom-placeholder"
                                    type="text" name="kategori" id="kategori"
                                    value="{{ $izinTerlambat->kategori }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pengganti" class="form-label">Pengganti</label>
                                <input class="form-control @error('pengganti') is-invalid @enderror custom-placeholder"
                                    type="text" name="pengganti" id="pengganti"
                                    value="{{ $izinTerlambat->pengganti }}" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="alasanCuti" class="form-label">Alasan</label>
                                <input class="form-control @error('alasanCuti') is-invalid  @enderror custom-placeholder"
                                    type="text" name="alasanCuti" id="alasanCuti"
                                    value="{{ $izinTerlambat->alasan }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_app3" class="form-label">Tanggal Persetujuan 1</label>
                                <input class="form-control @error('tgl_app3') is-invalid @enderror custom-placeholder"
                                    type="date" name="tgl_app3" id="tgl_app3"
                                    value="{{ date('Y-m-d', strtotime($izinTerlambat->tgl_app3)) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="persetujuan1" class="form-label">Persetujuan 1 Oleh</label>
                                <input class="form-control @error('persetujuan1') is-invalid @enderror custom-placeholder"
                                    type="text" name="persetujuan1" id="persetujuan1"
                                    value="{{ $izinTerlambat->pengganti }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="approval3" class="form-label">Status Persetujuan 1</label>
                                <input class="form-control @error('approval3')is-invalid @enderror" type="text"
                                    name="approval3" id="approval3" placeholder="Masukkan Nama"
                                    value="{{ $izinTerlambat->approval3 }}" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="alasan3" class="form-label">Alasan Persetujuan 1</label>
                                <input class="form-control @error('alasan3') is-invalid  @enderror custom-placeholder"
                                    type="text" name="alasan3" id="alasan3" value="{{ $izinTerlambat->alasan3 }}"
                                    readonly>
                            </div>
                        @endif
                        @if ($izinTerlambat->jenis == 'Izin Sakit')
                            <div class="col-md-6 mb-3">
                                <label for="tgl_awal" class="form-label">Tanggal Awal Sakit</label>
                                <input class="form-control @error('tgl_awal') is-invalid @enderror custom-placeholder"
                                    type="date" name="tgl_awal" id="tgl_awal"
                                    value="{{ $izinTerlambat->tgl_awal }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_akhir" class="form-label">Tanggal Akhir Sakit</label>
                                <input class="form-control @error('tgl_akhir') is-invalid @enderror custom-placeholder"
                                    type="date" name="tgl_akhir" id="tgl_akhir"
                                    value="{{ $izinTerlambat->tgl_akhir }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_sakit" class="form-label">Jumlah Hari</label>
                                <input class="form-control @error('jumlah_sakit') is-invalid @enderror custom-placeholder"
                                    type="text" name="jumlah_sakit" id="jumlah_sakit"
                                    value="{{ $izinTerlambat->hari }}" readonly>
                            </div>
                            @if ($izinTerlambat->file)
                                <label>File Surat Dokter : <a href="{{ asset('uploads/' . $izinTerlambat->file) }}"
                                        target="_blank">Unduh surat sakit</a></label>
                            @else
                                <p>File Surat Dokter tidak tersedia.</p>
                            @endif
                        @endif
                        @if (auth()->user()->hak != 7)
                            @if ($izinTerlambat->jenis == 'Izin Lembur')
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_app2" class="form-label">Tanggal Persetujuan 2</label>
                                    <input class="form-control @error('tgl_app2') is-invalid @enderror custom-placeholder"
                                        type="date" name="tgl_app2" id="tgl_app2"
                                        value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                                </div>
                            @endif
                            @if ($izinTerlambat->jenis !== 'Izin Lembur')
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_app1" class="form-label">Tanggal Persetujuan 2</label>
                                    <input class="form-control @error('tgl_app1') is-invalid @enderror custom-placeholder"
                                        type="date" name="tgl_app1" id="tgl_app1"
                                        value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                                </div>
                            @endif
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="diterima"
                                        value="Diterima" checked>
                                    <label class="form-check-label" for="diterima">
                                        Diterima
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="ditolak"
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
                        @endif
                        @if (auth()->user()->hak == 7)
                            @if ($izinTerlambat->jenis == 'Izin Lembur')
                                <div class="col-md-6 mb-3">
                                    <label for="persetujuan1" class="form-label">Persetujuan 1 Oleh</label>
                                    @if ($departemen == 'service')
                                        <input class="form-control @error('persetujuan1')is-invalid @enderror"
                                            type="text" name="persetujuan1" id="persetujuan1"
                                            placeholder="Masukkan Nama" value="{{ $kabeng }}" readonly>
                                    @else
                                        <input class="form-control @error('persetujuan1')is-invalid @enderror"
                                            type="text" name="persetujuan1" id="persetujuan1"
                                            placeholder="Masukkan Nama" value="{{ $penilai2Name }}" readonly>
                                    @endif
                                </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="tgl_app1" class="form-label">Tanggal Persetujuan 1</label>
                                    <input class="form-control @error('tgl_app1') is-invalid @enderror custom-placeholder"
                                        type="date" name="tgl_app1" id="tgl_app1"
                                        value="{{ $izinTerlambat->tgl_app1 }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="approval1" class="form-label">Status Persetujuan 1</label>
                                    <input class="form-control @error('approval1')is-invalid @enderror" type="text"
                                        name="approval1" id="approval1" placeholder="Masukkan Nama"
                                        value="{{ $izinTerlambat->approval1 }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alasan1" class="form-label">Alasan Persetujuan 1</label>
                                    <input class="form-control @error('alasan1') is-invalid  @enderror custom-placeholder"
                                        type="text" name="alasan1" id="alasan1"
                                        value="{{ $izinTerlambat->alasan1 }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_app2" class="form-label">Tanggal Persetujuan 2</label>
                                    <input class="form-control @error('tgl_app2') is-invalid @enderror custom-placeholder"
                                        type="date" name="tgl_app2" id="tgl_app2"
                                        value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                                </div>
                            @endif
                            @if ($izinTerlambat->jenis == 'Izin Cuti Tidak Terencana' || $izinTerlambat->jenis == 'Izin Cuti Terencana')
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_app1" class="form-label">Tanggal Persetujuan 2</label>
                                    <input class="form-control @error('tgl_app1') is-invalid @enderror custom-placeholder"
                                        type="date" name="tgl_app1" id="tgl_app1"
                                        value="{{ $izinTerlambat->tgl_app1 }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="persetujuan1" class="form-label">Persetujuan 2 Oleh</label>
                                    <input class="form-control @error('persetujuan1')is-invalid @enderror" type="text"
                                        name="persetujuan1" id="persetujuan1" placeholder="Masukkan Nama"
                                        value="{{ $penilai2Name }}" readonly>
                                </div>
                            @endif
                            @if (
                                $izinTerlambat->jenis !== 'Izin Lembur' &&
                                    $izinTerlambat->jenis !== 'Izin Cuti Tidak Terencana' &&
                                    $izinTerlambat->jenis !== 'Izin Cuti Terencana')
                                <div class="col-md-6 mb-3">
                                    <label for="persetujuan1" class="form-label">Persetujuan 1 Oleh</label>
                                    <input class="form-control @error('persetujuan1')is-invalid @enderror" type="text"
                                        name="persetujuan1" id="persetujuan1" placeholder="Masukkan Nama"
                                        value="{{ $penilai2Name }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_app1" class="form-label">Tanggal Persetujuan 1</label>
                                    <input class="form-control @error('tgl_app1') is-invalid @enderror custom-placeholder"
                                        type="date" name="tgl_app1" id="tgl_app1"
                                        value="{{ date('Y-m-d', strtotime($izinTerlambat->tgl_app1)) }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="approval1" class="form-label">Status Persetujuan 1</label>
                                    <input class="form-control @error('approval1')is-invalid @enderror" type="text"
                                        name="approval1" id="approval1" placeholder="Masukkan Nama"
                                        value="{{ $izinTerlambat->approval1 }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alasan1" class="form-label">Alasan Persetujuan 1</label>
                                    <input class="form-control @error('alasan1') is-invalid  @enderror custom-placeholder"
                                        type="text" name="alasan1" id="alasan1"
                                        value="{{ $izinTerlambat->alasan1 }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_persetujuan" class="form-label">Tanggal Persetujuan 2</label>
                                    <input
                                        class="form-control @error('tanggal_persetujuan') is-invalid @enderror custom-placeholder"
                                        type="date" name="tanggal_persetujuan" id="tanggal_persetujuan"
                                        value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                                </div>
                            @endif
                            {{-- @if ($izinTerlambat->jenis !== 'Izin Cuti Tidak Terencana' && $izinTerlambat->jenis !== 'Izin Cuti Terencana')
                                <div class="col-md-6 mb-3">
                                    <label for="approval1" class="form-label">Status Persetujuan 1</label>
                                    <input class="form-control @error('approval1')is-invalid @enderror" type="text"
                                        name="approval1" id="approval1" placeholder="Masukkan Nama"
                                        value="{{ $izinTerlambat->approval1 }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alasan1" class="form-label">Alasan Persetujuan 1</label>
                                    <input class="form-control @error('alasan1') is-invalid  @enderror custom-placeholder"
                                        type="text" name="alasan1" id="alasan1"
                                        value="{{ $izinTerlambat->alasan1 }}" readonly>
                                </div>
                            @endif --}}
                            @if ($izinTerlambat->jenis == 'Izin Cuti Tidak Terencana' || $izinTerlambat->jenis == 'Izin Cuti Terencana')
                                <div class="col-md-6 mb-3">
                                    <label for="approval1" class="form-label">Status Persetujuan 2</label>
                                    <input class="form-control @error('approval1')is-invalid @enderror" type="text"
                                        name="approval1" id="approval1" placeholder="Masukkan Nama"
                                        value="{{ $izinTerlambat->approval1 }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alasan1" class="form-label">Alasan Persetujuan 2</label>
                                    <input class="form-control @error('alasan1') is-invalid  @enderror custom-placeholder"
                                        type="text" name="alasan1" id="alasan1"
                                        value="{{ $izinTerlambat->alasan1 }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_persetujuan" class="form-label">Tanggal Persetujuan 3</label>
                                    <input
                                        class="form-control @error('tanggal_persetujuan') is-invalid @enderror custom-placeholder"
                                        type="date" name="tanggal_persetujuan" id="tanggal_persetujuan"
                                        value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                                </div>
                            @endif
                            {{-- @if ($izinTerlambat->jenis !== 'Izin Cuti Tidak Terencana' && $izinTerlambat->jenis !== 'Izin Cuti Terencana')
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_persetujuan" class="form-label">Tanggal Persetujuan 2</label>
                                    <input
                                        class="form-control @error('tanggal_persetujuan') is-invalid @enderror custom-placeholder"
                                        type="date" name="tanggal_persetujuan" id="tanggal_persetujuan"
                                        value="{{ $dateInGMTPlus7->format('Y-m-d') }}" readonly>
                                </div>
                            @endif --}}
                            <div class="col-md-6 mb-3">
                                <label for="status2" class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status2" id="diterima"
                                        value="Diterima" checked>
                                    <label class="form-check-label" for="diterima">
                                        Diterima
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status2" id="ditolak"
                                        value="Ditolak">
                                    <label class="form-check-label" for="ditolak">
                                        Ditolak
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="alasan2" class="form-label">Alasan Diterima</label>
                                <textarea class="form-control @error('alasan2') is-invalid @enderror" type="text" name="alasan2" id="alasan2"
                                    value="{{ old('alasan2') }}" placeholder="Alasan Terlambat" style="height:100px"></textarea>
                            </div>
                        @endif

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

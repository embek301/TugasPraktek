@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    @if (auth()->user()->hak == 7 || auth()->user()->hak == 10)
        <ul class="list-inline mb-2 float-end">
            <li class="list-inline-item">
                <a href="{{ route('user.create') }}" class="btn btn-gold">
                    <i class="fa fa-id-badge me-1"></i> Tambahkan Karyawan
                </a>
            </li>
        </ul>
        <button id="toggleActive" class="btn btn-gold">
            <a href="{{ route('user.inactive') }}" class="text-light">
                <i id="toggleIcon" class="fa fa-toggle-on me-1"></i>
                <span id="toggleText">Karyawan Aktif</span>
            </a>
        </button>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="employeeTable">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Cabang</th>
                        <th>jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr data-aktif="{{ $user->aktif }}">
                            <td align="center">{{ $index + 1 }}</td>
                            <td><a href="{{ route('user.edit', $user->id) }}">{{ $user->nik }}</a></td>
                            <td>{{ $user->who }}</td>
                            <td>
                                @if ($user->dept == null)
                                @else
                                    {{ $user->dept }}
                                @endif
                            </td>
                            <td>
                                @if ($user->cab == null)
                                @else
                                    {{ $user->cab }}
                                @endif
                            </td>
                            <td>
                                @if ($user->jabatan == null)
                                @else
                                    {{ $user->jabatan }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#employeeTable').DataTable();
        });
        $(document).ready(function() {
            const button = $('#toggleActive');
            const toggleIcon = $('#toggleIcon');
            const toggleText = $('#toggleText');

            button.hover(
                function() { // Mouseenter event
                    toggleIcon.removeClass('fa-toggle-on').addClass('fa-toggle-off');
                    toggleText.text('Karyawan Tidak Aktif');
                },
                function() { // Mouseleave event
                    toggleIcon.removeClass('fa-toggle-off').addClass('fa-toggle-on');
                    toggleText.text('Karyawan Aktif');
                }
            );
        });
    </script>
@endpush

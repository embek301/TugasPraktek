@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    @if (auth()->user()->hak != 10)
        <h2>Anda bukan admin</h2>
    @endif
    @if (auth()->user()->hak == 5 ||
            auth()->user()->hak == 6 ||
            auth()->user()->hak == 7 ||
            auth()->user()->hak == 8 ||
            auth()->user()->hak == 9 ||
            auth()->user()->hak == 10)
        <button id="toggleInactive" class="btn btn-gold mb-2">
            <a href="{{ route('user.index') }}" class="text-light">
                <i id="toggleIcon" class="fa fa-toggle-on me-1"></i>
                <span id="toggleText">Karyawan Tidak Aktif</span>
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
                    </tr>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td><a href="{{ route('user.edit', $user->id) }}">{{ $user->nik }}</a></td>
                            <td>{{ $user->who }}</td>
                            <td>
                                @if ($user->depts == null)
                                @else
                                    {{ $user->depts->name }}
                                @endif
                            </td>
                            <td>
                                @if ($user->cabs == null)
                                @else
                                    {{ $user->cabs->name }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </thead>

            </table>
        </div>
    @endif
    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#employeeTable').DataTable();
            });
             $(document).ready(function() {
            const button = $('#toggleInactive');
            const toggleIcon = $('#toggleIcon');
            const toggleText = $('#toggleText');

            button.hover(
                function() { // Mouseenter event
                    toggleIcon.removeClass('fa-toggle-on').addClass('fa-toggle-off');
                    toggleText.text('Karyawan Aktif');
                },
                function() { // Mouseleave event
                    toggleIcon.removeClass('fa-toggle-off').addClass('fa-toggle-on');
                    toggleText.text('Karyawan Tidak Aktif');
                }
            );
        });
        </script>
    @endpush
@endsection

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
        <ul class="list-inline mb-2 float-end">
            <li class="list-inline-item">
                <a href="{{ route('user.create') }}" class="btn btn-gold">
                    <i class="fa fa-id-badge me-1"></i> Tambahkan Karyawan
                </a>
            </li>
        </ul>
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
        </script>
    @endpush
@endsection

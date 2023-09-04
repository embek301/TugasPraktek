@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    @if (auth()->user()->hak == 5 ||
            auth()->user()->hak == 6 ||
            auth()->user()->hak == 7 ||
            auth()->user()->hak == 8 ||
            auth()->user()->hak == 9 ||
            auth()->user()->hak == 10)
        <ul class="list-inline mb-2 float-end">
            <li class="list-inline-item">
                <a href="{{ route('jab.create') }}" class="btn btn-primary">
                    <i class="fa fa-id-badge me-1"></i> Tambahkan Jabatan
                </a>
            </li>
        </ul>
        <div class="table-responsive border p-3 rounded-3 bg-dark text-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="employeeTable">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($jab as $index => $jab)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td>
                                {{ $jab->name }}
                            </td>
                            <td>@include('content.KPI.Master.Jabatan.action')</td>
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

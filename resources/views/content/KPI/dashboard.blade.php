@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ URL::PREVIOUS() }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>
    </h2>
    <div class="container">
        <div class="table-responsive border p-3 rounded-3 bg-light">
            <table class="table table-bordered table-hover mb-0 datatable" id="jajanTable">
                <thead>
                    <tr class="text-white"style="background-color: #9E7676">
                        <th>no</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Hak</th>
                        <th>Cabang</th>
                    </tr>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td><a href="">{{ $user->nik }}</a></td>
                            <td>{{ $user->who }}</td>
                            <td>
                                {{ $user->hak }}
                            </td>
                            <td>
                                @if ($user->input_cabang == null)
                                @else
                                    {{ $user->input_cabang->name }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
@endsection

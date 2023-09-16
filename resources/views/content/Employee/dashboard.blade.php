@extends('layouts.employee-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    <h5 class="mb-4">Selamat Datang {{ Auth::user()->who }}</h5>
    @include('content.Employee.izin.approval-1.index')
    {{-- <div class="mt-0">
        @include('content.Employee.izin.approval-1.tes2')
    </div> --}}
@endsection

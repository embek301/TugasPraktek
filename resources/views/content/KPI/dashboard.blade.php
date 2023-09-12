@extends('layouts.kpi-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
    @if (auth()->user()->hak != 10)
        <h2>Anda bukan admin</h2>
    @endif
    @if (auth()->user()->hak == 10)
        <h2>Anda Admin</h2>
    @endif
@endsection

@extends('layouts.employee-layout')

@section('content')
    <h2 class="mb-4">
        <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back To ASW</a>
    </h2>
   <h2 class="mb-4">Employee Form {{ Auth::user()->who }}</h2>
    <div class="container">
        <div class="row">
             <div class="col-6 col-sm-3"><a href="{{ route('izin.index') }}"><img src="{{ Vite::asset('resources/images/Logoizin.png') }}"
                        alt="" style="width:100%"></a>
            </div>
            <div class="col-6 col-sm-3"><a href=""><img src="{{ Vite::asset('resources/images/Logocuti.png') }}"
                        alt="" style="width:100%"></a>
            </div>
            <div class="col-6 col-sm-3"> <a href=""><img src="{{ Vite::asset('resources/images/Laporan.png') }}"
                        alt="" style="width:100%"></a>
            </div>
        </div>
    </div>
@endsection

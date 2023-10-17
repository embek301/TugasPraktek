@extends('layouts.app')
@section('content')
    <style>
        .container.background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
            /* Atur tingkat opacity gambar */
        }
    </style>

    <body>
        <h2 class="mb-4">selamat datang {{ Auth::user()->who }}</h2>
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-3"><a href="{{ route('employee-form.index') }}"><img
                            src="{{ Vite::asset('resources/images/employee.png') }}" alt="" style="width:100%"></a>
                </div>
                <div class="col-6 col-sm-3"><a href=""><img src="{{ Vite::asset('resources/images/purchasing.png') }}"
                            alt="" style="width:100%"></a>
                </div>
                <div class="col-6 col-sm-3"> <a href=""><img src="{{ Vite::asset('resources/images/helpdesk.png') }}"
                            alt="" style="width:100%"></a>
                </div>
                {{-- <div class="w-100"></div> --}}
                <div class="col-6 col-sm-3"> <a href=""><img src="{{ Vite::asset('resources/images/CC.png') }}"
                            alt="" style="width:100%"></a>
                </div>
                <div class="col-6 col-sm-3"> <a href=""><img src="{{ Vite::asset('resources/images/td.png') }}"
                            alt="" style="width:100%"></a>
                </div>
                <div class="col-6 col-sm-3"><a href="{{ route('kpi.index') }}"><img
                            src="{{ Vite::asset('resources/images/KPI.png') }}" alt="" style="width:100%"></a>
                </div>
            </div>
        </div>
    </body>
@endsection

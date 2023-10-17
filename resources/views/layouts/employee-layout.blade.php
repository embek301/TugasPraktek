<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net"> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="icon" href="{{ Vite::asset('resources/images/asw.png') }}" type="image/icon type">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Scripts -->
    @vite('resources/sass/app.scss')
    @vite('resources/css/home.css')
    <style>
        /* Define a custom CSS class to style the placeholder color */
        .custom-placeholder::placeholder {
            color: #a7a4a4;
            /* Set your desired color */
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="{{ route('home') }}" class="logo"><img
                        src="{{ Vite::asset('resources/images/asrimotor-logo.png') }}" alt=""
                        style="width: 100%"></a></h1>
            <ul class="navbar-nav list-unstyled components mb-5">
                @php
                    $currentRouteName = Route::currentRouteName();
                @endphp
                <li class="sidebar-item @if ($currentRouteName == 'employee-form.index') active @endif">
                    <a href="{{ route('employee-form.index') }}" class="nav-link">
                        <span class="fa fa-home mr-2"></span>
                        Home
                    </a>
                </li>
                @include('layouts.form-employee.izin')
                @include('layouts.form-employee.cuti')
                @include('layouts.form-employee.absensi')
                @if (auth()->user()->hak == 7 || auth()->user()->hak == 10)
                    @include('layouts.form-employee.approval')
                    @include('layouts.data-laporan.index')
                @endif
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
            @vite('resources/js/main.js')
            @vite('resources/js/app.js')
            @include('sweetalert::alert')
            @stack('scripts')
        </div>
    </div>
    @vite('resources/js/main.js')
    @vite('resources/js/app.js')
</body>


</html>

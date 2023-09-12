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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    @vite('resources/sass/app.scss')
    @vite('resources/css/home.css')

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
            <h1>
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ vite::asset('resources/images/asrimotor-logo.png') }}" style="width: 100%">
                </a>
            </h1>
            <div>
                <ul class="navbar-nav list-unstyled components mb-5">
                    @php
                        $currentRouteName = Route::currentRouteName();
                    @endphp
                    <li class="sidebar-item @if ($currentRouteName == 'kpi.index') active @endif">
                        <a href="{{ route('kpi.index') }}" class="nav-link">
                            <span class="fa fa-home mr-2"></span>
                            Home
                        </a>
                    </li>
                    @if (auth()->user()->hak == 10)
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#master"
                                aria-expanded="false" aria-controls="aumasterth" onclick="toggleMaster()">
                                <i class="fa fa-gear pe-2"></i>
                                Master Data
                            </a>
                            <ul id="master" class="sidebar-dropdown list-unstyled collapse"
                                data-bs-parent="#sidebar">
                                <li class="sidebar-item @if ($currentRouteName == 'user.index') active @endif">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <span class="fa fa-users mr-2"></span> Master Karyawan
                                    </a>
                                </li>
                                <li class="sidebar-item @if ($currentRouteName == 'cabang.index') active @endif">
                                    <a href="{{ route('cabang.index') }}" class="nav-link">
                                        <span class="fa fa-industry mr-2"></span> Master Cabang
                                    </a>
                                </li>
                                <li class="sidebar-item @if ($currentRouteName == 'departement.index') active @endif">
                                    <a href="{{ route('departement.index') }}" class="nav-link">
                                        <span class="fa fa-industry mr-2"></span> Master Departement
                                    </a>
                                </li>
                                <li class="sidebar-item @if ($currentRouteName == 'jabatan.index') active @endif">
                                    <a href="{{ route('jabatan.index') }}" class="nav-link">
                                        <span class="fa fa-industry mr-2"></span> Master Jabatan
                                    </a>
                                </li>
                                <li class="sidebar-item @if ($currentRouteName == 'penilai2.index') active @endif">
                                    <a href="{{ route('penilai2.index') }}" class="nav-link">
                                        <span class="fa fa-industry mr-2"></span> Master Penilai 2
                                    </a>
                                </li>
                                <li class="sidebar-item @if ($currentRouteName == 'penilai3.index') active @endif">
                                    <a href="{{ route('penilai3.index') }}" class="nav-link">
                                        <span class="fa fa-industry mr-2"></span> Master Penilai 3
                                    </a>
                                </li>
                                <li class="sidebar-item @if ($currentRouteName == 'penilai4.index') active @endif">
                                    <a href="{{ route('penilai4.index') }}" class="nav-link">
                                        <span class="fa fa-industry mr-2"></span> Master Penilai 4
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="sidebar-item">
                        <a href="" class="nav-link">
                            <span class="fa fa-gear mr-2"></span>
                            Input KPI
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="" class="nav-link">
                            <span class="fa fa-gear mr-2"></span>
                            Input KPI Atasan
                        </a>
                    </li>
                </ul>
                <script>
                    // Function to open the "Master Data" submenu
                    function openMasterDataSubMenu() {
                        var submenu = document.getElementById("master");
                        submenu.classList.add("show");
                    }
                    // Add a class to the "Master Data" link based on the current route name
                    @if (in_array($currentRouteName, [
                            'user.index',
                            'user.inactive',
                            'cabang.index',
                            'departement.index',
                            'jabatan.index',
                            'penilai2.index',
                            'penilai3.index',
                            'penilai4.index',
                        ]))
                        openMasterDataSubMenu();
                    @endif
                </script>
                </ul>
            </div>
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
</body>

</html>

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
    {{-- @vite('resources/css/nav.css') --}}
    <style>
        .multiselect-dropdown {
            width: 100% !important;
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
            <h1>
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ vite::asset('resources/images/asrimotor-logo.png') }}" style="width: 100%">
                </a>
            </h1>
            <div>
                <ul class="navbar-nav list-unstyled components mb-5 ">
                    @php
                        $currentRouteName = Route::currentRouteName();
                    @endphp
                    <li class="nav-item ">
                        <a href="{{ route('kpi.index') }}"
                            class="nav-link @if ($currentRouteName == 'kpi.index') active @endif">
                            <span class="fa fa-home mr-2"></span>
                            Home
                        </a>
                    </li>
                    @if (auth()->user()->hak == 5 ||
                            auth()->user()->hak == 6 ||
                            auth()->user()->hak == 7 ||
                            auth()->user()->hak == 8 ||
                            auth()->user()->hak == 9 ||
                            auth()->user()->hak == 10)
                        {{-- <li>
                        <a href=""><span class="fa fa-users mr-2"></span>Daftar
                            Karyawan</a>
                    </li> --}}
                        <ul>
                            <li>
                                <a href="#">Item 1</a>
                                <ul class="dropdown">
                                    <li><a href="#">Subitem 1</a></li>
                                    <li><a href="#">Subitem 2</a></li>
                                    <li><a href="#">Subitem 3</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Item 2</a>
                                <!-- Add more items with dropdowns as needed -->
                            </li>
                        </ul>

                        <li class="nav-item">
                            <a href="{{ route('cabang.index') }} "
                                class="nav-link @if ($currentRouteName == 'cabang.index')  @endif">
                                <span class="fa fa-gear mr-2"></span>
                                Master Cabang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departement.index') }} "
                                class="nav-link @if ($currentRouteName == 'departement.index')  @endif">
                                <span class="fa fa-gear mr-2"></span>Master Departement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jab.index') }} "
                                class="nav-link @if ($currentRouteName == 'jab.index')  @endif">
                                <span class="fa fa-gear mr-2"></span>Master Jabatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pen2.index') }} "
                                class="nav-link @if ($currentRouteName == 'pen2.index')  @endif">
                                <span class="fa fa-gear mr-2"></span>Master Penilai 2
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pen3.index') }} "
                                class="nav-link @if ($currentRouteName == 'pen3.index')  @endif">
                                <span class="fa fa-gear mr-2"></span>Master Penilai 3
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pen4.index') }} "
                                class="nav-link @if ($currentRouteName == 'pen4.index')  @endif">
                                <span class="fa fa-gear mr-2"></span>Master Penilai 4
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <script>
                document.addEventListener("click", function(e) {
                    const dropdowns = document.querySelectorAll(".dropdown");
                    dropdowns.forEach((dropdown) => {
                        if (!dropdown.contains(e.target)) {
                            dropdown.style.display = "none";
                        }
                    });
                });
            </script>
            <style>
                /* Hide the dropdown by default */
                .dropdown {
                    display: none;
                }

                /* Style the main list items */
                .dropdown-item {
                    list-style: none;
                    display: inline;
                    margin-right: 20px;
                    /* Add spacing between items */
                    cursor: pointer;
                    /* Change cursor to indicate clickability */
                }

                /* Style the main item links */
                .dropdown-item>a {
                    text-decoration: none;
                    color: #333;
                }

                /* Style the dropdown items */
                .dropdown li {
                    background-color: #fff;
                    display: block;
                    margin-right: 10px;
                    /* Add spacing between sub-items */
                }

                /* Style the dropdown menu when it's open */
                .open .dropdown {
                    display: block;
                    position: absolute;
                }
            </style>
            <script>
                // Get all dropdown items
                const dropdownItems = document.querySelectorAll('.dropdown-item');

                // Add a click event listener to each dropdown item
                dropdownItems.forEach((item) => {
                    item.addEventListener('click', () => {
                        // Toggle the "open" class on the clicked item
                        item.classList.toggle('open');

                        // Close other open dropdowns
                        dropdownItems.forEach((otherItem) => {
                            if (otherItem !== item && otherItem.classList.contains('open')) {
                                otherItem.classList.remove('open');
                            }
                        });
                    });
                });

                // Close dropdowns when clicking outside of them
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.dropdown-item')) {
                        dropdownItems.forEach((item) => {
                            item.classList.remove('open');
                        });
                    }
                });
            </script>

        </nav>
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
            @vite('resources/js/multiselect-dropdown.js')
            @vite('resources/js/main.js')
            @vite('resources/js/app.js')

            @stack('scripts')
        </div>
    </div>

</body>

</html>

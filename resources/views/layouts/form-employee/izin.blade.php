<li class="sidebar-item">
    <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#izin" aria-expanded="false"
        onclick="toggleIzin()">
        <i class="fa fa-envelope pe-2"></i>
        Izin
    </a>
    <ul id="izin" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item @if ($currentRouteName == 'izin-terlambat.index') active @endif">
            <a href="{{ route('izin-terlambat.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Izin Terlambat
            </a>
        </li>
        <li class="sidebar-item @if ($currentRouteName == 'izin-pulang-awal.index') active @endif">
            <a href="{{ route('izin-pulang-awal.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Izin Pulang Awal
            </a>
        </li>
        <li class="sidebar-item @if ($currentRouteName == 'izin-clock-in.index') active @endif">
            <a href="{{ route('izin-clock-in.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Izin No Clock In
            </a>
        </li>
        <li class="sidebar-item @if ($currentRouteName == 'izin-clock-out.index') active @endif">
            <a href="{{ route('izin-clock-out.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Izin No Clock Out
            </a>
        </li>
        <li class="sidebar-item @if ($currentRouteName == 'izin-sakit.index') active @endif">
            <a href="{{ route('izin-sakit.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Izin Sakit
            </a>
        </li>
        <li class="sidebar-item ">
            <a href="" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Izin Lembur
            </a>
        </li>
    </ul>
</li>
<script>
    // Function to open the "Master Data" submenu
    function openIzinDataSubMenu() {
        var submenu = document.getElementById("izin");
        submenu.classList.add("show");
    }
    // Add a class to the "Master Data" link based on the current route name
    @if (in_array($currentRouteName, [
            'izin-terlambat.index',
            'izin-pulang-awal.index',
            'izin-clock-in.index',
            'izin-clock-out.index',
            'izin-sakit.index',
        ]))
        openIzinDataSubMenu();
    @endif
</script>

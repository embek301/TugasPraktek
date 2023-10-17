<li class="sidebar-item">
    <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#data-laporan" aria-expanded="false"
        onclick="toggleDataLaporan()">
        <i class="fa fa-envelope pe-2"></i>
        Data Laporan
    </a>
    <ul id="data-laporan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item @if ($currentRouteName == 'data-terlambat.index') active @endif">
            <a href="{{ route('data-terlambat.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin Terlambat
            </a>
        </li>
        <li class="sidebar-item @if ($currentRouteName == 'data-pulangAwal.index') active @endif">
            <a href="{{ Route('data-pulangAwal.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin Pulang Awal
            </a>
        </li>
        <li class="sidebar-item  @if ($currentRouteName == 'data-clockIn.index') active @endif">
            <a href="{{ route('data-clockIn.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin No Clock In
            </a>
        </li>
        <li class="sidebar-item  @if ($currentRouteName == 'data-clockOut.index') active @endif">
            <a href="{{ route('data-clockOut.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin No Clock Out
            </a>
        </li>
        <li class="sidebar-item  @if ($currentRouteName == 'data-Sakit.index') active @endif">
            <a href="{{ route('data-Sakit.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin Sakit
            </a>
        </li>
        <li class="sidebar-item  @if ($currentRouteName == 'data-Lembur.index') active @endif">
            <a href="{{ route('data-Lembur.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin Lembur
            </a>
        </li>
        <li class="sidebar-item  @if ($currentRouteName == 'data-Cuti.index') active @endif">
            <a href="{{ route('data-Cuti.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Izin Cuti
            </a>
        </li>
        <li class="sidebar-item  @if ($currentRouteName == 'data-Rekapitulasi.index') active @endif">
            <a href="{{ route('data-Rekapitulasi.index') }}" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span>
                Data Rekapitulasi
            </a>
        </li>
    </ul>
    <script>
        // Function to open the "Master Data" submenu
        function openDataLaporanDataSubMenu() {
            var submenu = document.getElementById("data-laporan");
            submenu.classList.add("show");
        }
        // Add a class to the "Master Data" link based on the current route name
        @if (in_array($currentRouteName, [
                'data-terlambat.index',
                'data-pulangAwal.index',
                'data-clockOut.index',
                'data-clockIn.index',
                'data-Sakit.index',
                'data-Lembur.index',
                'data-Cuti.index',
                'data-Rekapitulasi.index',
            ]))
            openDataLaporanDataSubMenu();
        @endif
    </script>

<li class="sidebar-item">
    <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#cuti" aria-expanded="false"
        onclick="toggleCuti()">
        <i class="fa fa-envelope pe-2"></i>
        Cuti
    </a>
    <ul id="cuti" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item ">
            <a href="" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Cuti Terencana
            </a>
        </li>
        <li class="sidebar-item ">
            <a href="" class="nav-link">
                <span class="fa fa-clipboard mr-2"></span> Cuti Tidak Terencana
            </a>
        </li>
    </ul>
</li>
<script>
    // Function to open the "Master Data" submenu
    function openCutiDataSubMenu() {
        var submenu = document.getElementById("cuti");
        submenu.classList.add("show");
    }
    // Add a class to the "Master Data" link based on the current route name
    @if (in_array($currentRouteName, []))
        openCutiDataSubMenu();
    @endif
</script>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a style="text-decoration: none; color:aliceblue;   " href="{{ route('admin.dashboard') }}">
        <h2><i class="fa fa-leaf bg-green"></i> Bloggify</h2>
    </a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="margin-left:45px;" id="sidebarToggle"
        href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

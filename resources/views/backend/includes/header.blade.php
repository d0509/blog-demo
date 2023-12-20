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
                {{-- href="{{ route('logout') }}" --}}
                <li><a  class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a></li>
                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-house"></i> Go to website</a></li>
            </ul>
        </li>
    </ul>
</nav>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1> --}}
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to logout?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="{{ route('logout')}}" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </div>
  </div>

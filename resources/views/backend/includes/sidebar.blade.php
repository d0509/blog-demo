<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.users.index' ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Users
                    </a>
                    <a class="nav-link {{in_array(Route::currentRouteName(), ['admin.categories.index', 'admin.categories.edit','admin.categories.create']) ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                        Categories
                    </a>
                    <a class="nav-link {{in_array(Route::currentRouteName(), ['admin.tags.index','admin.categories.create']) ? 'active' : '' }}"
                        href="{{ route('admin.tags.index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                        Tags
                    </a>
                    <a class="nav-link {{in_array(Route::currentRouteName(), ['admin.blogs.index', 'admin.blogs.edit','admin.blogs.create','admin.blogs.show']) ? 'active' : '' }}"
                        href="{{ route('admin.blogs.index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                        Blogs
                    </a>
                </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        @yield('content')
    </div>
</div>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">
            <span style="color: #eca233;">
                <strong>Addon</strong>
            </span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is(['dashboard']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->is(['user']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('addon.index') }}"
                        class="nav-link {{ request()->is(['addon']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cloud-download-alt"></i>
                        <p>
                            Apk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('trans.index') }}"
                        class="nav-link {{ request()->is(['trans']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transaction
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('route.index') }}"
                        class="nav-link {{ request()->is(['route']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-route"></i>
                        <p>
                            Plug-Route
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

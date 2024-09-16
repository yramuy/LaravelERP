<?php
// Check if the request is HTTP or HTTPS
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Get the server name
$server_name = $_SERVER['SERVER_NAME'];

// Get the request URI
$request_uri = $_SERVER['REQUEST_URI'];

// Construct the full URL
$current_url = $protocol . $server_name . $request_uri;

// Output the current URL
$url = explode('/', $current_url);


?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">

        <span class="brand-text font-weight-light">Portfolio Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user8-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">

                <a href="#" class="d-block">
                    @if (session()->has('email'))
                        {{ auth()->user()->name }}
                    @endif
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href={{ route('dashboard') }} class="nav-link <?php echo $url[3] == 'dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link <?php echo $url[3] == 'user' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href={{ route('about') }} class="nav-link <?php echo $url[3] == 'about' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            About
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link <?php echo $url[3] == 'user' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>
                            Projects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('service') }}" class="nav-link <?php echo $url[3] == 'service' ? 'active' : ''; ?>">
                        <i class="nav-icon fab fa-servicestack"></i>
                        <p>
                            Services
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blogs.index')}}" class="nav-link <?php echo $url[3] == 'blogs' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Blog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('image.create')}}" class="nav-link <?php echo isset($url[4]) && $url[4] == 'create' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Image Crop
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('image.resize-create')}}" class="nav-link <?php echo isset($url[4]) && $url[4] == 'resize-create' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Image Crop and Resize
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
        width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fas fa-power-off"></i>
                </a>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Aplaranja</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jalan.index') }}"
                        class="nav-link {{ Request::routeIs('jalan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-solid fa-road"></i>
                        <p>
                            Jalan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('panel.index') }}"
                        class="nav-link {{ Request::routeIs('panel.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Panel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tiang.index') }}"
                        class="nav-link {{ Request::routeIs('tiang.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bolt"></i>
                        <p>
                            Tiang
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('lampu.index') }}"
                        class="nav-link {{ Request::routeIs('lampu.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-lightbulb"></i>
                        <p>
                            Lampu
                        </p>
                    </a>
                </li> --}}
                <li
                    class="nav-item {{ Request::routeIs('riwayatPanel.*') || Request::routeIs('riwayatTiang*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::routeIs('riwayatPanel.*') || Request::routeIs('riwayatTiang*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Riwayat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('riwayatPanel.index') }}"
                                class="nav-link {{ Request::routeIs('riwayatPanel.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Panel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riwayatTiang.index') }}"
                                class="nav-link {{ Request::routeIs('riwayatTiang.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Tiang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('regu.index') }}"
                        class="nav-link {{ Request::routeIs('regu.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Regu
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('info.index') }}"
                        class="nav-link {{ Request::routeIs('info.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Info Umum
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Page Content -->

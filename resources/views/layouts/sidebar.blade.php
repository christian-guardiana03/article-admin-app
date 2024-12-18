<!-- Sidebar -->
@php
    $currentRoute = Route::currentRouteName();
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text">Article Admin Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menus
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Route::is('dashboard.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Route::is('articles.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('articles.index') }}">
            <i class="fas fa-fw fa-sticky-note"></i>
            <span>All Media</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::user()->can('manage user') || Auth::user()->can('manage company'))
        <!-- Heading -->
        <div class="sidebar-heading">
            Settings
        </div>
        @can('manage company')
        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Route::is('companies.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('companies.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Company</span></a>
        </li>
        @endcan

        @can('manage user')
        <li class="nav-item {{ Route::is('user-management.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user-management.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span></a>
        </li>
        @endcan

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
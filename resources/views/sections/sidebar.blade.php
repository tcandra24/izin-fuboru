<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logo.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ (request()->is('/dashboard')) ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->is('/dashboard')) ? 'active' : '' }}" href="/dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Transaksi</span>
                </li>
                <li class="sidebar-item {{ (request()->segment(1) . '/' . request()->segment(2) == 'transactions/izin-keluar') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->segment(1) . '/' . request()->segment(2) == 'transactions/izin-keluar') ? 'active' : '' }}" href="/transactions/izin-keluar" aria-expanded="false">
                        <span>
                            <i class="ti ti-database"></i>
                        </span>
                        <span class="hide-menu">Izin Keluar</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Approval</span>
                </li>
                <li class="sidebar-item {{ (request()->segment(1) == 'izin-keluar') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->segment(1) == 'izin-keluar') ? 'active' : '' }}" href="/izin-keluar" aria-expanded="false">
                        <span>
                            <i class="ti ti-lock"></i>
                        </span>
                        <span class="hide-menu">Izin Keluar</span>
                    </a>
                </li>
                <li class="sidebar-item {{ (request()->is('/log-approval')) ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->is('/log-approval')) ? 'active' : '' }}" href="/log-approval" aria-expanded="false">
                        <span>
                            <i class="ti ti-notes"></i>
                        </span>
                        <span class="hide-menu">Log Approval</span>
                    </a>
                </li>
                @hasrole('admin')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengaturan</span>
                </li>
                <li class="sidebar-item {{ (request()->is('/pengguna')) ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->is('/pengguna')) ? 'active' : '' }}" href="/pengguna" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item {{ (request()->is('/permissions')) ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->is('/permissions')) ? 'active' : '' }}" href="/permissions" aria-expanded="false">
                        <span>
                            <i class="ti ti-door"></i>
                        </span>
                        <span class="hide-menu">Ijin</span>
                    </a>
                </li>
                <li class="sidebar-item {{ (request()->is('/roles')) ? 'selected' : '' }}">
                    <a class="sidebar-link {{ (request()->is('/roles')) ? 'active' : '' }}" href="/roles" aria-expanded="false">
                        <span>
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Role</span>
                    </a>
                </li>
                @endhasrole
            </ul>
        </nav>
    </div>
</aside>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-primary"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link {{ request()->routeIs('doctor-schedule') ? 'active' : '' }}"
                    href="{{ route('doctor-schedule') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-calendar text-primary"></i></div>
                    Schedule
                </a>
                <a class="nav-link {{ request()->routeIs('doctor-appointment') ? 'active' : '' }}"
                    href="{{ route('doctor-appointment') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-file text-primary"></i></div>
                    Appointment
                </a>
                <a class="nav-link {{ request()->routeIs('doctor-patient') ? 'active' : '' }}"
                    href="{{ route('doctor-patient') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users text-primary"></i></div>
                    Patient
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <i class="fa fa-user-md text-primary"></i> Dr. {{ Auth::user()->name }}
        </div>
    </nav>
</div>

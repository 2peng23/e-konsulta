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
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa fa-hospital text-primary"></i></div>
                    Healthcare
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ request()->routeIs(['doctor', 'package']) ? 'show' : '' }}" id="collapseLayouts"
                    aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->routeIs('doctor') ? 'active' : '' }}"
                            href="{{ route('doctor') }}">Doctor</a>
                        <a class="nav-link {{ request()->routeIs('package') ? 'active' : '' }}"
                            href="{{ route('package') }}">Package</a>
                    </nav>
                </div>
                <a class="nav-link {{ request()->routeIs('patient') ? 'active' : '' }}" href="{{ route('patient') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users text-primary"></i></div>
                    Patient
                </a>
                <a class="nav-link {{ request()->routeIs('appointment') ? 'active' : '' }}"
                    href="{{ route('appointment') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-calendar text-primary"></i></div>
                    Appointment
                </a>
                <a class="nav-link {{ request()->routeIs('account') ? 'active' : '' }}" href="{{ route('account') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-user-circle text-primary"></i></div>
                    Account
                </a>
                <div class="sb-sidenav-menu-heading">Report</div>
                <a class="nav-link" href="{{ route('report') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-file text-primary"></i></div>
                    Report
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <span class="text-primary">{{ Auth::user()->name }}</span>
        </div>
    </nav>
</div>

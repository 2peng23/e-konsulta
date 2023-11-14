<!-- Header Area -->
<header class="header">

    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-4 col-md-2 col-12">
                        <!-- Start Logo -->
                        <div class="logo">
                            <a href="/">
                                <h3 class="text-primary">E-<span class="text-dark">Konsulta </span><i
                                        class="fa fa fa-stethoscope"></i>
                                </h3>
                                {{-- <img src="user/img/logo.png" alt="#"> --}}
                            </a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-8 col-md-10 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu" id="listing">
                                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="">
                                        <a href="#about-section">About</a>
                                    </li>
                                    @if (Auth::check())
                                        <li
                                            class="nav-item dropdown {{ request()->routeIs('my-appointment', 'my-doctor') ? 'active' : '' }}">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                My Appointments
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item {{ request()->routeIs('my-appointment') ? 'active text-white' : 'text-dark' }}"
                                                    href="{{ route('my-appointment') }}">Appointment</a>
                                                <a class="dropdown-item {{ request()->routeIs('my-doctor') ? 'active text-white' : 'text-dark' }}"
                                                    href="#doctor-section">Doctor</a>
                                            </div>
                                        </li>
                                    @else
                                        <li><a href="#doctor-section">Doctor</a></li>
                                    @endif
                                    <li><a href="#services-section">Services </a></li>

                                    <li><a href="#package-section">Package</a></li>
                                    @if (Auth::check())
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="dropdown-item text-primary" href="#" data-toggle="modal"
                                                    data-target="#logoutModal" :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    <button class="bn632-hover bn26">Logout</button>
                                                </a>
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <a href="/login"><button class="bn632-hover bn26">Login</button></a>
                                        </li>
                                        <li>
                                            <a href="/register"><button class="bn632-hover bn26">Register</button></a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->

<!-- Header Area -->
<header class="header">

    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-4 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo">
                            <a href="index.html">
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
                    <div class="col-lg-8 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu" id="listing">
                                    <li class="active"><a href="/">Home</i></a></li>
                                    <li class=""><a href="/#about-section">About</i></a></li>
                                    <li><a href="/#doctor-section">Doctors </a></li>
                                    <li><a href="/#services-section">Services </a></li>
                                    <li><a href="/#footer-section">Contact Us</a></li>
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

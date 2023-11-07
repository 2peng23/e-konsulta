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
                                <h3>E-<span class="text-primary">Konsulta</span> </h3>
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
                                <ul class="nav menu">
                                    <li class="active"><a href="#">Home <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="index.html">Home Page 1</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Doctos </a></li>
                                    <li><a href="#">Services </a></li>
                                    {{-- <li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="404.html">404 Error</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Blogs <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="blog-single.html">Blog Details</a></li>
                                        </ul>
                                    </li> --}}
                                    <li><a href="contact.html">Contact Us</a></li>
                                    @if (Auth::check())
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="dropdown-item text-primary" href="#" data-toggle="modal"
                                                    data-target="#logoutModal" :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Logout
                                                </a>
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('login') }}" class="text-primary fw-bolder">Login</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('register') }}"
                                                class="text-primary fw-bolder">Register</a>
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

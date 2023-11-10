<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Konsulta</title>
    <link rel="icon" href="user/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    {{-- owl carousel --}}
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    {{-- aniamte css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .bn632-hover {
            width: 80px;
            /* font-size: 16px; */
            /* font-weight: 600; */
            color: #fff;
            cursor: pointer;
            /* margin: 20px;
            height: 55px; */
            text-align: center;
            border: none;
            background-size: 300% 100%;
            border-radius: 50px;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .bn632-hover:hover {
            background-position: 100% 0;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .bn632-hover:focus {
            outline: none;
        }

        .bn632-hover.bn26 {
            background-image: linear-gradient(to right,
                    #25aae1,
                    #4481eb,
                    #04befe,
                    #3f86ed);
            box-shadow: 0 4px 15px 0 rgba(65, 132, 234, 0.75);
        }

        /* red btn */
        .bn632-hover {
            width: 80px;
            /* font-size: 16px;
            font-weight: 600; */
            color: #fff;
            cursor: pointer;
            /* margin: 20px;
            height: 55px; */
            text-align: center;
            border: none;
            background-size: 300% 100%;
            border-radius: 50px;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .bn632-hover:hover {
            background-position: 100% 0;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .bn632-hover:focus {
            outline: none;
        }

        .bn632-hover.bn27 {
            background-image: linear-gradient(to right,
                    #ed6ea0,
                    #ec8c69,
                    #f7186a,
                    #fbb03b);
            box-shadow: 0 4px 15px 0 rgba(236, 116, 149, 0.75);
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/dashboard">E-<span class="text-primary">Konsulta</span></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            {{-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div> --}}
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    {{-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li> --}}
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li class="d-flex justify-content-evenly align-items-center">
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
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        @include('admin.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb my-4">
                        <li class="breadcrumb-item">
                            <a href="/dashboard" class="text-decoration-none text-uppercase ">Admin</a>
                        </li>
                        <li class="breadcrumb-item text-primary text-uppercase">{{ \Request::route()->getName() }}</li>
                    </ol>
                    @yield('content')

                    {{-- Chart --}}
                    {{-- <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%"
                                            height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%"
                                            height="40"></canvas></div>
                                </div>
                            </div>
                        </div> --}}
                    {{-- End Chart --}}

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center fw-bold">
                        <div class="text-muted">Copyright &copy; E-Konsulta 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="admin/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="admin/assets/demo/chart-area-demo.js"></script>
    <script src="admin/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="admin/js/datatables-simple-demo.js"></script>
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- owl carousel --}}
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel();
        });
    </script>
    {{-- animate css --}}
    @yield('scripts')
</body>

</html>

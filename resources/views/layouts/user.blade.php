<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>E-Konsulta</title>

    <!-- Favicon -->
    <link rel="icon" href="user/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <base href="/dashboard">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="user/css/bootstrap.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="user/css/nice-select.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="user/css/font-awesome.min.css">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="user/css/icofont.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="user/css/slicknav.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="user/css/owl-carousel.css">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="user/css/datepicker.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="user/css/animate.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="user/css/magnific-popup.css">

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="user/css/normalize.css">
    <link rel="stylesheet" href="user/style.css">
    <link rel="stylesheet" href="user/css/responsive.css">
    <style>
        /* button */
        .bn632-hover {
            width: 80px;
            /* font-size: 16px;
            font-weight: 600; */
            color: #fff;
            cursor: pointer;
            /* margin: 10px; */
            height: 30px;
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

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator">
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->



    @include('default.header')

    @yield('content')



    @include('default.footer')

    <!-- jquery Min JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jquery Migrate JS -->
    <script src="user/js/jquery-migrate-3.0.0.js"></script>
    <!-- jquery Ui JS -->
    <script src="user/js/jquery-ui.min.js"></script>
    <!-- Easing JS -->
    <script src="user/js/easing.js"></script>
    <!-- Color JS -->
    <script src="user/js/colors.js"></script>
    <!-- Popper JS -->
    <script src="user/js/popper.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="user/js/bootstrap-datepicker.js"></script>
    <!-- Jquery Nav JS -->
    <script src="user/js/jquery.nav.js"></script>
    <!-- Slicknav JS -->
    <script src="user/js/slicknav.min.js"></script>
    <!-- ScrollUp JS -->
    <script src="user/js/jquery.scrollUp.min.js"></script>
    <!-- Niceselect JS -->
    <script src="user/js/niceselect.js"></script>
    <!-- Tilt Jquery JS -->
    <script src="user/js/tilt.jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="user/js/owl-carousel.js"></script>
    <!-- counterup JS -->
    <script src="user/js/jquery.counterup.min.js"></script>
    <!-- Steller JS -->
    <script src="user/js/steller.js"></script>
    <!-- Wow JS -->
    <script src="user/js/wow.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="user/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="user/js/bootstrap.min.js"></script>
    <!-- Main JS -->
    <script src="user/js/main.js"></script>
    {{-- jquery --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    {{-- li active --}}


    <!-- Bootstrap JS and Popper.js (required for Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var listItems = document.querySelectorAll("#listing li");

        listItems.forEach(function(item) {
            item.addEventListener('click', function() {
                listItems.forEach(function(li) {
                    li.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
    @yield('scripts')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pendaftaran Les</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href={{ asset('assets/flex-start/img/favicon.png') }} rel="icon">
    <link href={{ asset('assets/flex-start/img/apple-touch-icon.png') }} rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{ asset('assets/flex-start/vendors/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/flex-start/vendors/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
    <link href={{ asset('assets/flex-start/vendors/aos/aos.css') }} rel="stylesheet">
    <link href={{ asset('assets/flex-start/vendors/glightbox/css/glightbox.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/flex-start/vendors/swiper/swiper-bundle.min.css') }} rel="stylesheet">

    <!-- Main CSS File -->
    <link href={{ asset('assets/flex-start/css/main.css') }} rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src={{ asset('assets/flex-start/img/logo.png') }} alt="">
                <h1 class="sitename">Course</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#courses">Kursus</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (Auth::check())
                <a class="btn-getstarted flex-md-shrink-0"
                    href={{ url(Auth::user()->level . '/dashboard') }}>Dashboard</a>
            @else
                <a class="btn-getstarted flex-md-shrink-0" href={{ route('login') }}>Login</a>
            @endif
        </div>
    </header>


    @yield('content')


    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">FlexStart</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src={{ asset('assets/flex-start/vendors/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/php-email-form/validate.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/aos/aos.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/glightbox/js/glightbox.min.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/purecounter/purecounter_vanilla.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/isotope-layout/isotope.pkgd.min.js') }}></script>
    <script src={{ asset('assets/flex-start/vendors/swiper/swiper-bundle.min.js') }}></script>

    <!-- Main JS File -->
    <script src={{ asset('assets/flex-start/js/main.js') }}></script>

</body>

</html>

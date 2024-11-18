<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pendaftaran Les</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ url('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/vendor-niceadmin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor-niceadmin/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor-niceadmin/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor-niceadmin/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor-niceadmin/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor-niceadmin/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor-niceadmin/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">

    {{-- Sweet Alert CSS --}}
    <link rel="stylesheet" href="{{ url('assets/sweetalert2/dist-alert/sweetalert2.min.css') }}">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ url('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Batuah</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                                Halo, {{ Auth::user()->username }}
                            </h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href={{ route('logout') }}>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('peserta/dashboard') ? 'active' : 'collapsed' }}"
                    href="{{ url('peserta/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('peserta/akun*') ? 'active' : 'collapsed' }}"
                    href="{{ url('peserta/akun') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/#courses') }}">
                    <i class="bi bi-search"></i>
                    <span>Cari Kursus</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('peserta/kursus*') ? 'active' : 'collapsed' }}"
                    href="{{ url('peserta/kursus') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Kursus Saya</span>
                </a>
            </li>
        </ul>
    </aside><!-- End Sidebar-->

    {{-- Awal Content --}}
    <main id="main" class="main">
        @yield('content')
    </main>
    {{-- Akhir Content --}}


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('assets/vendor-niceadmin/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/quill/quill.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('assets/vendor-niceadmin/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    {{-- Sweetalert --}}
    <script src="{{ url('assets/sweetalert2/dist-alert/sweetalert2.min.js') }}"></script>


    @yield('script')
</body>

</html>

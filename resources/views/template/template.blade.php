<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $appname ?? 'Manajemen Praktikum' }}</title>

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon.png') }}" rel="apple-touch-icon">

    <!-- Core CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Additional Styles -->
    @stack('styles')
    @stack('header_scripts')
</head>

<body class="sb-nav-fixed">
    <!-- Top Navigation Bar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Brand -->
        <a class="navbar-brand ps-3" href="{{ url('/dashboard') }}">Manajemen Praktikum</a>

        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Search Form -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>

        <!-- User Navigation -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Main Layout -->
    <div id="layoutSidenav">
        <!-- Sidebar Navigation -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Main Menu Header -->
                        <div class="sb-sidenav-menu-heading">Menu Utama</div>

                        <!-- Dashboard Link -->
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <!-- Kepala Lab Menu -->
                        @if (Auth::user()->role == 'kepala_lab')
                            <a class="nav-link" href="{{ url('/laboran') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-cog me-2"></i></div>
                                Kelola Laboran
                            </a>
                        @endif

                        <!-- Laboran Menu -->
                        @if (Auth::user()->role == 'laboran')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                               data-bs-target="#collapseLayouts" aria-expanded="false"
                               aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Praktikum
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                 data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('/mata_kuliah_praktikum') }}">
                                        Mata Kuliah Praktikum
                                    </a>
                                    <a class="nav-link" href="{{ url('/asisten_praktikum') }}">
                                        Asisten Praktikum
                                    </a>
                                    <a class="nav-link" href="{{ url('/mahasiswa_praktikum') }}">
                                        Mahasiswa Praktikum
                                    </a>
                                </nav>
                            </div>
                        @endif

                        <!-- Shared Menu for Laboran and Kepala Lab -->
                        @if (Auth::user()->role == 'laboran' || Auth::user()->role == 'kepala_lab')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                               data-bs-target="#collapseLaporan" aria-expanded="false"
                               aria-controls="collapseLaporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLaporan" aria-labelledby="headingTwo"
                                 data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('/absensi_praktikum') }}">
                                        Laporan Presensi
                                    </a>
                                    <a class="nav-link" href="{{ url('/laporan_praktikum') }}">
                                        Laporan Praktikum
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link" href="{{ url('/penilaian_praktikum') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                                Penilaian Praktikum
                            </a>
                        @endif

                        <!-- Asisten Dosen Menu -->
                        @if (Auth::user()->role == 'asisten_dosen')
                            <a class="nav-link" href="{{ url('/absensi_praktikum') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                Absensi Praktikum
                            </a>
                            <a class="nav-link" href="{{ url('/laporan_praktikum') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Laporan Praktikum
                            </a>
                            <a class="nav-link" href="{{ url('/penilaian_praktikum') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                                Penilaian Praktikum
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistem Informasi UNIB 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>

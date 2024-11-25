<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $appname ?? 'Manajemen Praktikum' }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Additional Styles -->
    @stack('styles')
    @stack('header_scripts')
</head>

<body class="sb-nav-fixed">
    <!-- Top Navigation -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Brand -->
        <a class="navbar-brand ps-3" href="{{ url('/dashboard') }}">
            Manajemen Praktikum
        </a>

        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Top Navigation Right Side -->
        <div class="d-flex ms-auto">
            <!-- Search Form -->
            <form class="d-none d-md-inline-block form-inline me-0 me-md-3 my-2 my-md-0"></form>

            <!-- User Navigation -->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/profile') }}">
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                               data-bs-target="#logoutModal">
                                {{ __('Log Out') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>

                        <!-- Role-Based Navigation -->
                        @if (Auth::user()->role == 'kepala_lab')
                            <!-- Kepala Lab Menu -->
                            <a class="nav-link" href="{{ url('/laboran') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-users-cog me-2"></i>
                                </div>
                                Kelola Laboran
                            </a>
                        @endif

                        @if (Auth::user()->role == 'laboran')
                            <!-- Laboran Menu -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                               data-bs-target="#collapseLayouts" aria-expanded="false"
                               aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Praktikum
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
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

                        @if (Auth::user()->role == 'laboran' || Auth::user()->role == 'kepala_lab')
                            <!-- Shared Menu for Laboran and Kepala Lab -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                               data-bs-target="#collapseLaporan" aria-expanded="false"
                               aria-controls="collapseLaporan">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
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
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                Penilaian Praktikum
                            </a>
                        @endif

                        @if (Auth::user()->role == 'asisten_dosen')
                            <!-- Asisten Dosen Menu -->
                            <a class="nav-link" href="{{ url('/absensi_praktikum') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                Absensi Praktikum
                            </a>
                            <a class="nav-link" href="{{ url('/laporan_praktikum') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                Laporan Praktikum
                            </a>
                            <a class="nav-link" href="{{ url('/penilaian_praktikum') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-star"></i>
                                </div>
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
                        <div class="text-muted">
                            Copyright &copy; Sistem Informasi UNIB 2024
                        </div>
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

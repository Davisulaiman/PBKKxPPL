@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>

        @if (Auth::user()->role == 'kepala_lab')
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang Kepala Laboran</li>
            </ol>
            <div class="row">
                <!-- Kelola Laboran Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card bg-secondary text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users-cog me-2"></i>
                                Kelola Laboran
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola data laboran</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/laboran') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Presensi Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>
                                Laporan Presensi
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola laporan presensi praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/laporan_presensi') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Praktikum Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-file-alt me-2"></i>
                                Laporan Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola laporan hasil praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/laporan_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Praktikum Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-star me-2"></i>
                                Penilaian Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola penilaian praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/penilaian_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->role == 'laboran')
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang Laboran</li>
            </ol>
            <div class="row">
                <!-- Mata Kuliah Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-book-open me-2"></i>
                                Mata Kuliah Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola data mata kuliah praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/mata_kuliah_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Asisten Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2"></i>
                                Asisten Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola data asisten praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/asisten_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Mahasiswa Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-graduate me-2"></i>
                                Mahasiswa Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola data mahasiswa praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/mahasiswa_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Presensi Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>
                                Laporan Presensi
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola laporan presensi praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/laporan_presensi') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-file-alt me-2"></i>
                                Laporan Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola laporan hasil praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/laporan_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-star me-2"></i>
                                Penilaian Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola penilaian praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/penilaian_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->role == 'asisten_dosen')
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang Asisten Dosen</li>
            </ol>
            <div class="row">
                <!-- Absensi Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>
                                Absensi Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola absensi mahasiswa praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/absensi_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-file-alt me-2"></i>
                                Laporan Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola pengumpulan dan review laporan praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/laporan_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Praktikum Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-star me-2"></i>
                                Penilaian Praktikum
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Kelola penilaian akhir praktikum</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/penilaian_praktikum') }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

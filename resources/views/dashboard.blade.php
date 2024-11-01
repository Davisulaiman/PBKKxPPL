@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        @if (Auth::user()->role == 'laboran' || Auth::user()->role == 'kepala_lab')
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang Laboran</li>
            </ol>
            <div class="row">
                <!-- Blue (Primary) Card -->
                <div class="col-xl-4 col-md-8">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Mata Kuliah Praktikum</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ url('/mata_kuliah_praktikum') }}">View
                                Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Red (Danger) Card -->
                <div class="col-xl-4 col-md-8">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Asisten Praktikum</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ url('/asisten_praktikum') }}">View
                                Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Yellow (Warning) Card -->
                <div class="col-xl-4 col-md-8">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Mahasiswa Praktikum</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ url('/mahasiswa_praktikum') }}">View
                                Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Blue (Primary) Card -->
                <div class="col-xl-4 col-md-8">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Laporan Presensi</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ url('/laporan_presensi') }}">View
                                Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Red (Danger) Card -->
                <div class="col-xl-4 col-md-8">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Laporan Praktikum</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ url('/laporan_praktikum') }}">View
                                Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Yellow (Warning) Card -->
                <div class="col-xl-4 col-md-8">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Penilaian Praktikum</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ url('/penilaian_praktikum') }}">View
                                Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    @endif
@endsection

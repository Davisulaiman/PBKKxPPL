@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang Kepala Laboran</li>
        </ol>

        <div class="row">
            <!-- Loop through mataKuliahPraktikum collection -->
            @foreach($mataKuliahPraktikum as $mataKuliah)
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $mataKuliah->nama_mata_kuliah }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Kode Mata Kuliah:</strong> {{ $mataKuliah->kode_mata_kuliah }}<br>
                                <strong>Kelas:</strong> {{ $mataKuliah->kelas }}<br>
                                <strong>SKS:</strong> {{ $mataKuliah->sks }}<br>
                                <strong>Tanggal Praktikum:</strong> {{ $mataKuliah->tanggal_praktikum }}<br>
                                <strong>Status Aktif:</strong> {{ $mataKuliah->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white text-decoration-none" href="{{ url('/absensi_praktikum/' . $mataKuliah->id) }}">
                                Absensi
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

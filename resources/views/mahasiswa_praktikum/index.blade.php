@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mata Kuliah Praktikum</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Mata Kuliah Praktikum</li>
        </ol>
        <div class="row">
            @forelse ($mataKuliahPraktikum as $mk)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card mb-4 shadow-sm" style="border-radius: 10px; overflow: hidden; transition: transform 0.3s;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title m-0">{{ $mk->nama_mata_kuliah }}</h5>
                        </div>
                        <div class="card-body bg-light text-dark">
                            <p class="card-text">Kode: {{ $mk->kode_mata_kuliah }}</p>
                            <p class="card-text">Kelas: {{ $mk->kelas }}</p>
                            <p class="card-text">SKS: {{ $mk->sks }}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between bg-primary text-white">
                            <a class="small text-white stretched-link" href="{{ route('mahasiswa_praktikum.show', $mk->id) }}">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        Tidak ada mata kuliah praktikum yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-header, .card-footer {
            font-weight: bold;
        }
    </style>
@endsection

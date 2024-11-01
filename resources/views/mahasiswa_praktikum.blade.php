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
                    <div class="card bg-light text-dark mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mk->nama_mata_kuliah }}</h5>
                            <p class="card-text">Kode: {{ $mk->kode_mata_kuliah }}</p>
                            <p class="card-text">Kelas: {{ $mk->kelas }}</p>
                            <p class="card-text">SKS: {{ $mk->sks }}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" href="{{ route('mahasiswa_praktikum.show', $mk->kode_mata_kuliah) }}">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
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
@endsection

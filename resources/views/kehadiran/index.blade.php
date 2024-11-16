@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Praktikum</h1>

        <!-- Tampilkan mata kuliah hanya terkait dengan asisten dosen yang login -->
        <div class="row">
            @forelse($mataKuliahPraktikum as $mataKuliah)
                <div class="col-xl-6 col-md-6 mb-4">
                    <a href="{{ url('/absensi_praktikum/' . $mataKuliah->id) }}" class="text-decoration-none">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">{{ $mataKuliah->nama_mata_kuliah }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>Kode Mata Kuliah:</strong> {{ $mataKuliah->kode_mata_kuliah }}<br>
                                    <strong>Kelas:</strong> {{ $mataKuliah->kelas }}<br>
                                    <strong>SKS:</strong> {{ $mataKuliah->sks }}<br>
                                    <strong>Tanggal Praktikum:</strong> {{ $mataKuliah->tanggal_praktikum }}<br>
                                    <strong>Status:</strong>
                                    <span class="badge {{ $mataKuliah->status_aktif ? 'bg-success' : 'bg-danger' }}">
                                        {{ $mataKuliah->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">
                        Tidak ada mata kuliah yang tersedia untuk Anda.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

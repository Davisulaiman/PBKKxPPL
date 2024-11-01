@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mahasiswa dalam Mata Kuliah: {{ $mataKuliah->nama_mata_kuliah }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa_praktikum.index') }}">Mata Kuliah</a></li>
            <li class="breadcrumb-item active">Detail Mahasiswa</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Daftar Mahasiswa</h5>
                <p>Kode Mata Kuliah: {{ $mataKuliah->kode_mata_kuliah }}</p>
                <p>Kelas: {{ $mataKuliah->kelas }}</p>
                <p>SKS: {{ $mataKuliah->sks }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mahasiswas as $index => $mahasiswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>{{ $mahasiswa->npm }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada mahasiswa terdaftar untuk mata kuliah ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

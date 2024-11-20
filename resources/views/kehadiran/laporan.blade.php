@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan Presensi Pertemuan {{ $pertemuan }}</h1>
        <h2 class="mt-2">{{ $mataKuliah->nama }}</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Laporan Presensi</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-check me-1"></i>
                Presensi Mahasiswa
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswaStatusAbsensi as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['mahasiswa']->npm }}</td>
                                <td>{{ $data['mahasiswa']->nama }}</td>
                                <td>{{ $data['statusMahasiswa'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


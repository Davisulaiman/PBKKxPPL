@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Rekap Laporan Absensi - {{ $mataKuliah->nama_mata_kuliah }}</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Rekap Absensi</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Rekap Absensi Mahasiswa
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            @for ($i = 1; $i <= 16; $i++)
                                <th>P{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswaStatusAbsensi as $index => $mahasiswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mahasiswa['npm'] }}</td>
                                <td>{{ $mahasiswa['nama'] }}</td>
                                @foreach ($mahasiswa['rekap'] as $kehadiran)
                                    <td>
                                        @if ($kehadiran === \App\Models\AbsensiMahasiswaMataKuliahPraktikum::STATUS_HADIR)
                                            ✓
                                        @elseif ($kehadiran === \App\Models\AbsensiMahasiswaMataKuliahPraktikum::STATUS_SAKIT)
                                            S
                                        @elseif ($kehadiran === \App\Models\AbsensiMahasiswaMataKuliahPraktikum::STATUS_IZIN)
                                            I
                                        @elseif ($kehadiran === \App\Models\AbsensiMahasiswaMataKuliahPraktikum::STATUS_ALPA)
                                            A
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

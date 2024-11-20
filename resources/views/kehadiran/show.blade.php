@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi - {{ $mataKuliah->nama_mata_kuliah }}</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Absensi</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Absensi Pertemuan 1-16
            </div>
            <div class="card-body">
                <!-- Rekap Laporan Absensi Button -->
                <a href="{{ url('/rekap_laporan_absensi/' . $mataKuliah->id) }}" class="btn btn-secondary mt-3">
                    Rekap Laporan Absensi
                </a>

                <!-- Table for Attendance -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Pertemuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $pertemuanField = 'pertemuan_' . $i;
                            @endphp
                            <tr>
                                <td>Pertemuan {{ $i }}</td>
                                <td>
                                    <!-- Absensi button visible only for Asisten Dosen -->
                                    @if (Auth::user()->role == 'asisten_dosen')
                                        <a class="text-white text-decoration-none btn btn-primary"
                                            href="{{ url('/absensi_praktikum/' . $mataKuliah->id . '/' . $pertemuanField) }}">
                                            Absensi Pertemuan
                                        </a>
                                    @endif

                                    <!-- Laporan Absensi button visible only for Kepala Lab & Laboran -->
                                    @if (Auth::user()->role == 'kepala_lab' || Auth::user()->role == 'laboran')
                                        <a href="{{ url('/laporan_absensi/' . $mataKuliah->id) }}"
                                            class="btn btn-info mt-3">
                                            Lihat Laporan Absensi
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

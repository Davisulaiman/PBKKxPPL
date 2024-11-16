@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan Praktikum - {{ $mataKuliah->nama_mata_kuliah }}</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Laporan Praktikum</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Laporan Pertemuan 1-16
            </div>
            <div class="card-body">
                <table class="table table-bordered">
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
                                    <a class="text-white text-decoration-none btn btn-primary"
                                       href="{{ url('/laporan_praktikum/' . $mataKuliah->id . '/' . $i) }}">
                                        Lihat Laporan
                                    </a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

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
                Absensi Pertemuan 1-10
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
                                @for ($i = 1; $i <= 10; $i++)
                                    @php
                                        $pertemuanField = 'pertemuan_' . $i;
                                    @endphp
                                    <tr>
                                        <td>Pertemuan {{ $i }}</td>
                                        <td>
                                            {{$pertemuanField}}
                                            <a class="text-white text-decoration-none btn btn-primary" href="{{ url('/absensi_praktikum/' . $mataKuliah->id . "/". $pertemuanField) }}">
                                                Absensi Pertemuan
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

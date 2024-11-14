@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Pertemuan {{ $pertemuan }} - {{ $mataKuliah->nama_mata_kuliah }}</h1>

        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card bg-success text-white border">
                    <div class="card-body">
                        <h5 class="card-title">Hadir</h5>
                        <p class="card-text h3">
                            {{ $mahasiswaStatusAbsensi->where('statusMahasiswa', 'Hadir')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card bg-info text-white border">
                    <div class="card-body">
                        <h5 class="card-title">Sakit</h5>
                        <p class="card-text h3">
                            {{ $mahasiswaStatusAbsensi->where('statusMahasiswa', 'Sakit')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card bg-warning text-dark border">
                    <div class="card-body">
                        <h5 class="card-title">Izin</h5>
                        <p class="card-text h3">
                            {{ $mahasiswaStatusAbsensi->where('statusMahasiswa', 'Izin')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card bg-danger text-white border">
                    <div class="card-body">
                        <h5 class="card-title">Alpa</h5>
                        <p class="card-text h3">
                            {{ $mahasiswaStatusAbsensi->where('statusMahasiswa', 'Alpa')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card bg-secondary text-white border">
                    <div class="card-body">
                        <h5 class="card-title">Tanpa Ket.</h5>
                        <p class="card-text h3">
                            {{ $mahasiswaStatusAbsensi->where('statusMahasiswa', null)->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-check me-1"></i>
                Daftar Mahasiswa
                <a class="text-white text-decoration-none btn btn-primary" href="{{ url('/absensi_praktikum/' . $mataKuliah->id . '/' . $pertemuan . '/print') }}">
                    Print Pertemuan
                </a>
            </div>
            <div class="card-body">
                <form action="{{ url('/update_absensi/' . $mataKuliah->id . '/' . $pertemuan) }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th style="min-width: 400px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswaStatusAbsensi as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data['mahasiswa']->nama }}</td>
                                    <td>{{ $data['mahasiswa']->npm }}</td>
                                    <td>
                                        <div class="d-flex gap-1 status-cards">
                                            @foreach(\App\Models\AbsensiMahasiswaMataKuliahPraktikum::getStatuses() as $status)
                                                <input type="radio"
                                                       class="btn-check"
                                                       name="status[{{ $data['mahasiswa']->id }}]"
                                                       id="status_{{ $data['mahasiswa']->id }}_{{ $status }}"
                                                       value="{{ $status }}"
                                                       {{ $data['statusMahasiswa'] == $status ? 'checked' : '' }}>
                                                <label class="status-card btn {{ $status == 'Hadir' ? 'btn-success' :
                                                                   ($status == 'Sakit' ? 'btn-info' :
                                                                   ($status == 'Izin' ? 'btn-warning' :
                                                                   ($status == 'Alpa' ? 'btn-danger' :
                                                                   'btn-secondary'))) }}"
                                                       for="status_{{ $data['mahasiswa']->id }}_{{ $status }}">
                                                    {{ $status }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-3">Update Absensi</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .status-cards {
            display: flex;
            gap: 1px;
        }
        .status-card {
            font-size: 12px !important;
            padding: 4px 8px;
            margin: 0;
            border-radius: 4px;
            flex: 1;
            text-align: center;
            border: 1px solid #ddd;
        }
        .btn-check:checked + .status-card {
            opacity: 1;
            font-weight: bold;
        }
        .btn-check:not(:checked) + .status-card {
            opacity: 0.7;
        }
        .btn-check:not(:checked) + .status-card:hover {
            opacity: 0.9;
            cursor: pointer;
        }
        .btn-warning {
            color: #000 !important;
        }
        .btn-info, .btn-success, .btn-danger, .btn-secondary {
            color: #fff !important;
        }
    </style>
@endsection

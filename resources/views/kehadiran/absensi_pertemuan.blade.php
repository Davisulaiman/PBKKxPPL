@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Pertemuan {{ $pertemuan }} - {{ $mataKuliah->nama_mata_kuliah }}</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Update Absensi Mahasiswa</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-check me-1"></i>
                Daftar Mahasiswa

                <a class="text-white text-decoration-none btn btn-primary" href="{{ url('/absensi_praktikum/' . $mataKuliah->id . "/". $pertemuan . '/print') }}">
                    Print Pertemuan
                </a>
            </div>
            <div class="card-body">
                <form action="{{ url('/update_absensi/' . $mataKuliah->id . '/' . $pertemuan) }}" method="POST">
                    @csrf
                    @method('POST')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswaStatusAbsensi as $data)
                                <tr>
                                    <td>{{ $data['mahasiswa']->nama }}</td>
                                    <td>{{ $data['mahasiswa']->npm }}</td>
                                    <td>
                                        <select name="status[{{ $data['mahasiswa']->id }}]" class="form-select">
                                            @foreach(\App\Models\AbsensiMahasiswaMataKuliahPraktikum::getStatuses() as $status)
                                                <option value="{{ $status }}"
                                                        {{$data['statusMahasiswa'] == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
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
@endsection

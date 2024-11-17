@extends('template.template')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Penilaian Praktikum</h2>

                <!-- Tombol Tambah Penilaian Praktikum (Hanya untuk Asisten Dosen) -->
                @if (Auth::user()->role == 'asisten_dosen')
                    <a href="{{ route('penilaian_praktikum.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Tambah Penilaian Praktikum
                    </a>

                    <!-- Tombol Download Template Excel -->
                <a href="{{ route('penilaian_praktikum.download_template') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-download"></i> Download Template Penilaian Praktikum
                </a>
                @endif

                <!-- Tabel Penilaian Praktikum dengan Responsiveness -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Google Drive Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penilaianPraktikum as $index => $penilaian)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penilaian->mataKuliahPraktikum->nama_mata_kuliah }}</td>
                                    <td>
                                        <a href="{{ $penilaian->google_drive_link }}" target="_blank">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Jika Tidak Ada Data -->
                @if($penilaianPraktikum->isEmpty())
                    <div class="alert alert-warning">
                        Tidak ada data penilaian praktikum.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

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
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Lihat Penilaian Praktikum</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penilaianPraktikum as $index => $penilaian)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penilaian->mataKuliahPraktikum->kode_mata_kuliah }}</td>
                                    <td>{{ $penilaian->mataKuliahPraktikum->nama_mata_kuliah }}</td>
                                    <td>{{ $penilaian->mataKuliahPraktikum->kelas }}</td>
                                    <td>
                                        <a href="{{ $penilaian->google_drive_link }}" target="_blank">View</a>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit (Hanya untuk Asisten Dosen) -->
                                        @if (Auth::user()->role == 'asisten_dosen')
                                            <a href="{{ route('penilaian_praktikum.edit', $penilaian->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif

                                        <!-- Tombol Hapus (Dapat Diakses Semua Role) -->
                                        <form action="{{ route('penilaian_praktikum.destroy', $penilaian->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
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

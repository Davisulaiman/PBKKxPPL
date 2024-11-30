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

                    <!-- Section for Downloading Template with Styling -->
                    <div class="mb-3 p-3 bg-light border rounded shadow-sm">
                        <p class="mb-2"><strong>Unduh Template:</strong> Untuk kemudahan penginputan, Anda dapat mengunduh
                            template penilaian praktikum dengan mengklik tombol di bawah:</p>
                        <a href="{{ route('penilaian_praktikum.download_template') }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Unduh Template Penilaian Praktikum
                        </a>
                    </div>
                @endif

                @if(auth()->user()->role === 'asisten_dosen')
    <a href="{{ route('penilaian_praktikum.template') }}" class="btn btn-primary">Download Template Penilaian Praktikum</a>
@endif

@if(in_array(auth()->user()->role, ['laboran', 'kepala_lab']))
    <a href="{{ route('penilaian_praktikum.editTemplate') }}" class="btn btn-success">Kelola Template Penilaian</a>
@endif


                <!-- Tombol Export PDF (Hanya untuk Laboran dan Kepala Lab) -->
                @if (in_array(Auth::user()->role, ['laboran', 'kepala_lab']))
                    <a href="{{ route('penilaian_praktikum.export_pdf') }}" class="btn btn-info mb-3">
                        <i class="fas fa-file-pdf"></i> Export PDF
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
                            @foreach ($penilaianPraktikum as $index => $penilaian)
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
                                            <a href="{{ route('penilaian_praktikum.edit', $penilaian->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif

                                        <!-- Tombol Hapus (Dapat Diakses Semua Role) -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $penilaian->id }}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $penilaian->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $penilaian->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $penilaian->id }}">
                                                            Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah kamu yakin ingin menghapus penilaian praktikum
                                                        <strong>{{ $penilaian->mataKuliahPraktikum->nama_mata_kuliah }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('penilaian_praktikum.destroy', $penilaian->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Jika Tidak Ada Data -->
                @if ($penilaianPraktikum->isEmpty())
                    <div class="alert alert-warning">
                        Tidak ada data penilaian praktikum.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

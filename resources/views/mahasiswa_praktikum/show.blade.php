@extends('template.template')

@section('content')
    <style>
        /* Custom CSS untuk tombol dan container */
        .action-container {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .action-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .import-section {
            margin-bottom: 25px;
        }

        .import-form {
            display: flex;
            gap: 10px;
        }

        .import-form .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px;
            flex: 1;
        }

        .import-form .form-control:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f8fafc;
        }

        .delete-btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Mahasiswa dalam Mata Kuliah: {{ $mataKuliah->nama_mata_kuliah }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa_praktikum.index') }}">Mata Kuliah</a></li>
            <li class="breadcrumb-item active">Detail Mahasiswa</li>
        </ol>

        <div class="action-container">
            <div class="import-section">
                <h2 class="action-title">Import Mahasiswa Praktikum</h2>
                <form action="{{ route('import.mahasiswa', $mataKuliah->id) }}" method="POST" enctype="multipart/form-data"
                    class="import-form">
                    @csrf
                    <input type="file" name="file" class="form-control" required>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-file-import"></i>
                        Import
                    </button>
                </form>
                <!-- Tampilkan pesan error jika file bukan format Excel -->
                @error('file')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
                <small class="text-muted text-danger">*Harap unggah file dengan format .xlsx atau .xls yang
                    diperbolehkan</small>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header table-header">
                <div>
                    <h5>Daftar Mahasiswa</h5>
                    <p>Kode Mata Kuliah: {{ $mataKuliah->kode_mata_kuliah }}</p>
                    <p>Kelas: {{ $mataKuliah->kelas }}</p>
                    <p>SKS: {{ $mataKuliah->sks }}</p>
                </div>
                <a href="{{ route('mahasiswa_praktikum.create', $mataKuliah->id) }}" class="btn btn-success">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mahasiswas as $index => $mahasiswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mahasiswa->npm }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('mahasiswa_praktikum.edit', $mahasiswa->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $mahasiswa->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>

                                        <a href="{{ route('attendance.index', $mahasiswa->pivot->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-check"></i> Presensi
                                        </a>

                                        <!-- Modal Konfirmasi Hapus Mahasiswa -->
                                        <div class="modal fade" id="deleteModal{{ $mahasiswa->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $mahasiswa->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $mahasiswa->id }}">
                                                            Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah kamu yakin ingin menghapus data mahasiswa
                                                        <strong>{{ $mahasiswa->nama }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('mahasiswa_praktikum.destroy', $mahasiswa->id) }}"
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
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada mahasiswa terdaftar untuk mata kuliah
                                        ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="delete-btn-container">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
                <i class="fas fa-trash-alt"></i>
                Hapus Semua Data
            </button>
        </div>

        <!-- Modal Konfirmasi Hapus Semua Data -->
        <div class="modal fade" id="deleteAllModal" tabindex="-1" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllModalLabel">Konfirmasi Hapus Semua Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin ingin menghapus semua data mahasiswa pada mata kuliah
                        <strong>{{ $mataKuliah->nama_mata_kuliah }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('mahasiswa_praktikum.deleteAll', $mataKuliah->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus Semua</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

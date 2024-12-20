@extends('template.template')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Mata Kuliah Praktikum</h2>

                <!-- Tombol Tambah Mata Kuliah dengan Icon dan Warna Hijau -->
                <a href="{{ route('mata_kuliah_praktikum.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Tambah Mata Kuliah <!-- Icon for adding mata kuliah -->
                </a>

                <!-- Notifikasi Pesan Sukses -->
                @if (session('success'))
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Tabel Data Mata Kuliah Praktikum dengan Responsiveness -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>SKS</th>
                                <th>Tanggal Praktikum</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cek Data Mata Kuliah Praktikum -->
                            @forelse ($mataKuliahPraktikum as $index => $mk)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mk->kode_mata_kuliah }}</td>
                                    <td>{{ $mk->nama_mata_kuliah }}</td>
                                    <td>{{ $mk->kelas }}</td>
                                    <td>{{ $mk->sks }}</td>
                                    <td>{{ $mk->tanggal_praktikum }}</td>
                                    <td>{{ $mk->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    <td>
                                        <!-- Tombol Edit dengan Icon dan Warna Warning -->
                                        <a class="btn btn-warning"
                                            href="{{ route('mata_kuliah_praktikum.edit', $mk->kode_mata_kuliah) }}"
                                            title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus dengan Icon: Memicu Modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $mk->id }}" title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $mk->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $mk->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $mk->id }}">
                                                            Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah kamu yakin ingin menghapus mata kuliah
                                                        <strong>{{ $mk->nama_mata_kuliah }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('mata_kuliah_praktikum.destroy', $mk->kode_mata_kuliah) }}"
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
                                <!-- Jika Tidak Ada Data -->
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data mata kuliah praktikum.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

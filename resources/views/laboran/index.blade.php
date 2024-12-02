<!-- resources/views/laboran/index.blade.php -->
@extends('template.template')

@section('content')
<div class="container mt-4">
    <h2>Daftar Laboran</h2>

    <!-- Tombol Tambah Laboran -->
    <a href="{{ route('laboran.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Tambah Laboran <!-- Menggunakan ikon sesuai format asisten_praktikum -->
    </a>

    <!-- Notifikasi Pesan Error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabel Data Laboran -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laborans as $index => $laboran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $laboran->nama }}</td>
                <td>{{ $laboran->username }}</td>
                <td>{{ $laboran->user->email }}</td>
                <td>
                    <!-- Tombol Edit dengan Icon dan Teks -->
                    <a href="{{ route('laboran.edit', $laboran->id) }}" class="btn btn-warning" title="Edit">
                        <i class="fas fa-edit"></i> Edit <!-- Icon dan teks untuk edit -->
                    </a>

                    <!-- Tombol Hapus dengan Icon dan Teks: Memicu Modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $laboran->id }}" title="Hapus">
                        <i class="fas fa-trash"></i> Hapus <!-- Icon dan teks untuk hapus -->
                    </button>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="deleteModal{{ $laboran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $laboran->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $laboran->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus laboran <strong>{{ $laboran->nama }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('laboran.destroy', $laboran->id) }}" method="POST" style="display:inline;">
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
                <td colspan="5" class="text-center">Tidak ada data laboran.</td> <!-- Adjusted colspan sesuai jumlah kolom -->
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

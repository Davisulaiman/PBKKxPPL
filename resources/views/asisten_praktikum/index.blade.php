@extends('template.template')

@section('content')
<div class="container mt-4">
    <h2>Daftar Asisten Praktikum</h2>
    <a href="{{ route('asisten_praktikum.create') }}" class="btn btn-primary mb-3">Tambah Asisten Praktikum</a>

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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Praktikan</th>
                <th>Username</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($asistenPraktikum as $index => $asisten)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $asisten->npm }}</td>
                <td>{{ $asisten->user->name }}</td>
                <td>{{ $asisten->username }}</td>
                <td>
                    @if($asisten->mataKuliahPraktikum->isNotEmpty())
                        @foreach($asisten->mataKuliahPraktikum as $mataKuliah)
                            {{ $mataKuliah->nama_mata_kuliah }} <br>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('asisten_praktikum.edit', $asisten->id) }}" class="btn btn-warning" title="Edit">
                        <i class="fas fa-edit"></i> <!-- Using Font Awesome edit icon -->
                    </a>

                    <!-- Tombol Hapus dengan Icon: Memicu Modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $asisten->id }}" title="Hapus">
                        <i class="fas fa-trash"></i> <!-- Using Font Awesome trash icon -->
                    </button>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="deleteModal{{ $asisten->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $asisten->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $asisten->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus asisten praktikum <strong>{{ $asisten->user->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('asisten_praktikum.destroy', $asisten->id) }}" method="POST" style="display:inline;">
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
                <td colspan="6" class="text-center">Tidak ada data asisten praktikum.</td> <!-- Adjusted colspan -->
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

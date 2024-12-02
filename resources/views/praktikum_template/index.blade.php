@extends('template.template')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Template Penilaian Praktikum</h2>

    <a href="{{ route('praktikum_template.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Tambah Template Baru
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Link Google Drive</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($templates as $key => $template)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ $template->google_drive_link }}" target="_blank">
                            Lihat Template
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('praktikum_template.edit', $template->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <!-- Tombol untuk membuka modal hapus -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $template->id }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>

                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="deleteModal{{ $template->id }}" tabindex="-1"
                     aria-labelledby="deleteModalLabel{{ $template->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $template->id }}">
                                    Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus template ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('praktikum_template.destroy', $template->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada template tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('template.template')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Manajemen Template Penilaian Praktikum</h2>

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
                        <form action="{{ route('praktikum_template.destroy', $template->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Anda yakin ingin menghapus template ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
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

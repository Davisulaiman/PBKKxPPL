@extends('template.template')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Tambah Template Baru</h2>

    <form action="{{ route('praktikum_template.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="google_drive_link" class="form-label">Link Google Drive</label>
            <input type="url" class="form-control" id="google_drive_link" name="google_drive_link"
                   pattern="https://drive\.google\.com/.*" placeholder="https://drive.google.com/..." required>
            <small class="form-text text-muted">
                Pastikan link adalah link Google Drive yang dapat diakses.
            </small>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Template
        </button>
    </form>
</div>
@endsection

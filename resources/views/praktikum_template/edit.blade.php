@extends('template.template')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Edit Template Praktikum</h2>

    <form action="{{ route('praktikum_template.update', $template->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menambahkan method PUT untuk melakukan update -->

        <div class="mb-3">
            <label for="google_drive_link" class="form-label">Link Google Drive</label>
            <input type="url" class="form-control" id="google_drive_link" name="google_drive_link"
                   pattern="https://drive\.google\.com/.*" placeholder="https://drive.google.com/..." required
                   value="{{ old('google_drive_link', $template->google_drive_link) }}">
            <small class="form-text text-muted">
                Pastikan link adalah link Google Drive yang dapat diakses.
            </small>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection

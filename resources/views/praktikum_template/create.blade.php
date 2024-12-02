@extends('template.template')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Tambah Template Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('praktikum_template.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="google_drive_link" class="form-label">Link Google Drive/Docs/Bit.ly</label>
            <input type="url" class="form-control @error('google_drive_link') is-invalid @enderror"
                   id="google_drive_link"
                   name="google_drive_link"
                   value="{{ old('google_drive_link') }}"
                   placeholder="https://drive.google.com/... atau https://docs.google.com/... atau https://bit.ly/..."
                   required>

            @error('google_drive_link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <small class="form-text text-muted">
                Pastikan link adalah link Google Drive, Docs, atau Bit.ly yang dapat diakses.
            </small>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Template
        </button>
    </form>
</div>
@endsection

<!-- resources/views/mahasiswa_praktikum/create.blade.php -->
@extends('template.template')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mahasiswa_praktikum.index') }}" class="text-decoration-none">
                            <i class="bi bi-house-door"></i> Mata Kuliah
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Mahasiswa</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Mahasiswa Praktikum</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa_praktikum.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="mata_kuliah_praktikum_id" value="{{ $mataKuliahPraktikum->id }}">

                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input
                                type="text"
                                name="npm"
                                class="form-control @error('npm') is-invalid @enderror"
                                id="npm"
                                max="10"
                                value="{{ old('npm') }}"
                                required
                            >
                            @error('npm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input
                                type="text"
                                name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                id="nama"
                                value="{{ old('nama') }}"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
                            </button>
                            <a href="{{ route('mahasiswa_praktikum.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

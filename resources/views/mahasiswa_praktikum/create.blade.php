@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Mahasiswa Praktikum</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa_praktikum.index') }}">Mata Kuliah</a></li>
            <li class="breadcrumb-item active">Tambah Mahasiswa</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Form Tambah Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa_praktikum.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" value="{{ old('npm') }}" required>
                        @error('npm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
                    <a href="{{ route('mahasiswa_praktikum.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

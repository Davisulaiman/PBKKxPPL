<!-- resources/views/mata_kuliah_praktikum/create.blade.php -->
@extends('template.template')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Mata Kuliah Praktikum</h4>
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

                    <form action="{{ route('mata_kuliah_praktikum.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kode_mata_kuliah" class="form-label">Kode Mata Kuliah</label>
                            <input
                                type="text"
                                name="kode_mata_kuliah"
                                class="form-control @error('kode_mata_kuliah') is-invalid @enderror"
                                id="kode_mata_kuliah"
                                value="{{ old('kode_mata_kuliah') }}"
                                required
                            >
                            @error('kode_mata_kuliah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_mata_kuliah" class="form-label">Nama Mata Kuliah</label>
                            <input
                                type="text"
                                name="nama_mata_kuliah"
                                class="form-control @error('nama_mata_kuliah') is-invalid @enderror"
                                id="nama_mata_kuliah"
                                value="{{ old('nama_mata_kuliah') }}"
                                required
                            >
                            @error('nama_mata_kuliah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select
                                name="kelas"
                                class="form-select @error('kelas') is-invalid @enderror"
                                id="kelas"
                            >
                                <option value="A" {{ old('kelas') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('kelas') == 'B' ? 'selected' : '' }}>B</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sks" class="form-label">Jumlah SKS</label>
                            <input
                                type="number"
                                name="sks"
                                class="form-control @error('sks') is-invalid @enderror"
                                id="sks"
                                value="{{ old('sks') }}"
                                required
                            >
                            @error('sks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_praktikum" class="form-label">Tanggal Praktikum</label>
                            <input
                                type="date"
                                name="tanggal_praktikum"
                                class="form-control @error('tanggal_praktikum') is-invalid @enderror"
                                id="tanggal_praktikum"
                                value="{{ old('tanggal_praktikum') }}"
                                required
                            >
                            @error('tanggal_praktikum')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status_aktif" class="form-label">Status Aktif</label>
                            <select
                                name="status_aktif"
                                class="form-select @error('status_aktif') is-invalid @enderror"
                                id="status_aktif"
                            >
                                <option value="1" {{ old('status_aktif') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status_aktif') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status_aktif')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('mata_kuliah_praktikum.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

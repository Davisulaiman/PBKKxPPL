@extends('template.template')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('laporan_praktikum.index') }}" class="text-decoration-none">
                            <i class="bi bi-house-door"></i> Daftar Laporan Praktikum
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Buat Laporan Praktikum</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Buat Laporan Praktikum untuk Mata Kuliah: {{ $mataKuliahPraktikum->nama_mata_kuliah }}</h4>
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

                    <form action="{{ route('laporan_praktikum.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="mata_kuliah_praktikum_id" class="form-label">Mata Kuliah Praktikum:</label>
                            <p>{{ $mataKuliahPraktikum->nama_mata_kuliah }}</p>
                            <input type="hidden" name="mata_kuliah_praktikum_id" value="{{ $mataKuliahPraktikum->id }}">
                        </div>

                        <div class="mb-3">
                            <label for="pertemuan" class="form-label">Pertemuan:</label>
                            <input
                                type="number"
                                name="pertemuan"
                                min="1"
                                max="16"
                                class="form-control @error('pertemuan') is-invalid @enderror"
                                value="{{ old('pertemuan', $pertemuan) }}"
                                required
                            >
                            @error('pertemuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="materi" class="form-label">Materi:</label>
                            <input
                                type="text"
                                name="materi"
                                class="form-control @error('materi') is-invalid @enderror"
                                value="{{ old('materi') }}"
                                required
                            >
                            @error('materi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_praktikum" class="form-label">Tanggal Praktikum:</label>
                            <input
                                type="date"
                                name="tanggal_praktikum"
                                class="form-control @error('tanggal_praktikum') is-invalid @enderror"
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
                            <label for="bukti_praktikum" class="form-label">Foto (Link Google Drive):</label>
                            <input
                                type="url"
                                name="bukti_praktikum"
                                class="form-control @error('bukti_praktikum') is-invalid @enderror"
                                value="{{ old('bukti_praktikum') }}"
                            >
                            @error('bukti_praktikum')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('laporan_praktikum.index') }}" class="btn btn-secondary">
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

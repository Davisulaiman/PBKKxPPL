@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Laporan Praktikum - Pertemuan {{ $laporanPraktikum->pertemuan }}</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Form Edit Laporan Praktikum
            </div>
            <div class="card-body">
                <form action="{{ route('laporan_praktikum.update', $laporanPraktikum->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="pertemuan" class="form-label">Pertemuan</label>
                        <input type="number" class="form-control @error('pertemuan') is-invalid @enderror" id="pertemuan" name="pertemuan" value="{{ old('pertemuan', $laporanPraktikum->pertemuan) }}" min="1" max="16">
                        @error('pertemuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="materi" class="form-label">Materi</label>
                        <textarea class="form-control @error('materi') is-invalid @enderror" id="materi" name="materi" rows="3">{{ old('materi', $laporanPraktikum->materi) }}</textarea>
                        @error('materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bukti_praktikum" class="form-label">Bukti Praktikum (URL Google Drive)</label>
                        <input type="url" class="form-control @error('bukti_praktikum') is-invalid @enderror" id="bukti_praktikum" name="bukti_praktikum" value="{{ old('bukti_praktikum', $laporanPraktikum->bukti_praktikum) }}">
                        @error('bukti_praktikum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('laporan_praktikum.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

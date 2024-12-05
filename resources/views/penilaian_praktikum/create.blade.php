@extends('template.template')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Penilaian Praktikum</h4>
                    </div>

                    <div class="card-body">
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form for Creating Penilaian Praktikum -->
                        <form action="{{ route('penilaian_praktikum.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="mata_kuliah_praktikum" class="form-label">Mata Kuliah Praktikum</label>
                                <select name="mata_kuliah_praktikum_id" id="mata_kuliah_praktikum" class="form-select @error('mata_kuliah_praktikum_id') is-invalid @enderror" required>
                                    @foreach($mataKuliahPraktikum as $mataKuliah)
                                        <option value="{{ $mataKuliah->id }}" {{ old('mata_kuliah_praktikum_id') == $mataKuliah->id ? 'selected' : '' }}>
                                            {{ $mataKuliah->nama_mata_kuliah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mata_kuliah_praktikum_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="google_drive_link" class="form-label">Google Drive / Bit.ly / Docs Link</label>
                                <input type="url" name="google_drive_link" id="google_drive_link" class="form-control @error('google_drive_link') is-invalid @enderror" required value="{{ old('google_drive_link', $penilaianPraktikum->google_drive_link ?? '') }}">
                                @error('google_drive_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                                <a href="{{ route('penilaian_praktikum.index') }}" class="btn btn-secondary">
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

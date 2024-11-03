@extends('template.template')
@section('content')
    <div class="container mt-4">
        <h2>Edit Mata Kuliah Praktikum</h2>
        <form action="{{ route('mata_kuliah_praktikum.update', $id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kode Mata Kuliah:</label>
                <input type="text" name="kode_mata_kuliah" class="form-control @error('kode_mata_kuliah') is-invalid @enderror" value="{{ old('kode_mata_kuliah', $mata_kuliah_praktikum['kode_mata_kuliah']) }}" required>
                @error('kode_mata_kuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Mata Kuliah:</label>
                <input type="text" name="nama_mata_kuliah" class="form-control @error('nama_mata_kuliah') is-invalid @enderror" value="{{ old('nama_mata_kuliah', $mata_kuliah_praktikum['nama_mata_kuliah']) }}" required>
                @error('nama_mata_kuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Kelas:</label>
                <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                    <option value="A" {{ old('kelas', $mata_kuliah_praktikum['kelas']) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('kelas', $mata_kuliah_praktikum['kelas']) == 'B' ? 'selected' : '' }}>B</option>
                </select>
                @error('kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Jumlah SKS:</label>
                <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks', $mata_kuliah_praktikum['sks']) }}" required>
                @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Praktikum:</label>
                <input type="date" name="tanggal_praktikum" class="form-control @error('tanggal_praktikum') is-invalid @enderror" value="{{ old('tanggal_praktikum', $mata_kuliah_praktikum['tanggal_praktikum']) }}" required>
                @error('tanggal_praktikum')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Status Aktif:</label>
                <select name="status_aktif" class="form-control @error('status_aktif') is-invalid @enderror">
                    <option value="1" {{ old('status_aktif', $mata_kuliah_praktikum['status_aktif']) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status_aktif', $mata_kuliah_praktikum['status_aktif']) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status_aktif')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection

@extends('template.template')
@section('content')
    <div class="container mt-4">
        <h2>Edit Mata Kuliah Praktikum</h2>
        <form action="{{ route('mata_kuliah_praktikum.update', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Mata Kuliah:</label>
                <input type="text" name="kode_mata_kuliah" class="form-control" value="{{ $mata_kuliah_praktikum['kode_mata_kuliah'] }}" required>
            </div>
            <div class="form-group">
                <label>Nama Mata Kuliah:</label>
                <input type="text" name="nama_mata_kuliah" class="form-control" value="{{ $mata_kuliah_praktikum['nama_mata_kuliah'] }}" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <select name="kelas" class="form-control">
                    <option value="A" {{ $mata_kuliah_praktikum['kelas'] == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $mata_kuliah_praktikum['kelas'] == 'B' ? 'selected' : '' }}>B</option>
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah SKS:</label>
                <input type="number" name="sks" class="form-control" value="{{ $mata_kuliah_praktikum['sks'] }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal Praktikum:</label>
                <input type="date" name="tanggal_praktikum" class="form-control" value="{{ $mata_kuliah_praktikum['tanggal_praktikum'] }}" required>
            </div>
            <div class="form-group">
                <label>Status Aktif:</label>
                <select name="status_aktif" class="form-control">
                    <option value="1" {{ $mata_kuliah_praktikum['status_aktif'] == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $mata_kuliah_praktikum['status_aktif'] == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection

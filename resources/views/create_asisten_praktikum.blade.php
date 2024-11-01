@extends('template.template')
@section('content')
<div class="container mt-4">
    <h2>Tambah Asisten Praktikum</h2>
    <form action="{{ route('asisten_praktikum.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>NPM:</label>
            <input type="text" name="npm" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Praktikan:</label>
            <input type="text" name="nama_praktikan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mata Kuliah Praktikum:</label>
            <select name="mata_kuliah_praktikum_id[]" class="form-control" multiple>
                @foreach($mataKuliahPraktikum as $mataKuliah)
                    <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }} ({{ $mataKuliah->kode_mata_kuliah }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection

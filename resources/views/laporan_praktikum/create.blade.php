@extends('template.template')

@section('content')
    <h1>Buat Laporan Praktikum</h1>
    <form action="{{ route('laporan_praktikum.store') }}" method="POST">
        @csrf
        <label for="mata_kuliah_praktikum_id">Mata Kuliah Praktikum:</label>
        <select name="mata_kuliah_praktikum_id" required>
            @foreach($mataKuliahPraktikum as $mk)
                <option value="{{ $mk->id }}">{{ $mk->nama_mata_kuliah }}</option>
            @endforeach
        </select>

        <label for="pertemuan">Pertemuan:</label>
        <input type="number" name="pertemuan" min="1" max="16" required>

        <label for="materi">Materi:</label>
        <input type="text" name="materi" required>

        <label for="foto_link">Foto (Link Google Drive):</label>
        <input type="url" name="foto_link">

        <button type="submit">Simpan</button>
    </form>
@endsection

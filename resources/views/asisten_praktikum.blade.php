@extends('template.template')
@section('content')
<div class="container mt-4">
    <h2>Daftar Asisten Praktikum</h2>
    <a href="{{ route('asisten_praktikum.create') }}" class="btn btn-primary mb-3">Tambah Asisten Praktikum</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>ID</th>
                <th>Nama Praktikan</th>
                <th>Username</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistenPraktikum as $index => $asisten)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $asisten->id }}</td>
                <td>{{ $asisten->npm }}</td>
                <td>{{ $asisten->nama_praktikan }}</td>
                <td>{{ $asisten->username }}</td>
                <td>{{ $asisten->mataKuliahPraktikum->nama_mata_kuliah ?? '-' }}</td>
                <td>
                    <a href="{{ route('asisten_praktikum.edit', $asisten->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('asisten_praktikum.destroy', $asisten->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8" class="text-center">Tidak ada data asisten praktikum.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

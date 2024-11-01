@extends('template.template')
@section('content')
<div class="container mt-4">
    <h2>Daftar Asisten Praktikum</h2>
    <a href="{{ route('asisten_praktikum.create') }}" class="btn btn-primary mb-3">Tambah Asisten Praktikum</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>NPM</th>
                <th>Nama Praktikan</th>
                <th>Username</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($asistenPraktikum as $index => $asisten)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $asisten->id }}</td>
                <td>{{ $asisten->npm }}</td>
                <td>{{ $asisten->user->name }}</td>
                <td>{{ $asisten->username }}</td>
                <td>
                    @if($asisten->mataKuliahPraktikum->isNotEmpty())
                        @foreach($asisten->mataKuliahPraktikum as $mataKuliah)
                            {{ $mataKuliah->nama_mata_kuliah }} <br>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('asisten_praktikum.edit', $asisten->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('asisten_praktikum.destroy', $asisten->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus asisten praktikum ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data asisten praktikum.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

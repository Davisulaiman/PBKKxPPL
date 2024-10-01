{{-- View: resources/views/mata_kuliah_praktikum/index.blade.php --}}
@props(['mataKuliahPraktikum'])
<x-layout appname="Laboratorium Sistem Informasi UNIB">

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Mata Kuliah Praktikum</h2>

                <a href="{{ route('mata_kuliah_praktikum.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>SKS</th>
                            <th>Tanggal Praktikum</th>
                            <th>Status Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($mataKuliahPraktikum)
                        @foreach ($mataKuliahPraktikum as $mk)
                            <tr>
                                <td>{{ $mk->nomor }}</td>
                                <td>{{ $mk->kode_mata_kuliah }}</td>
                                <td>{{ $mk->nama_mata_kuliah }}</td>
                                <td>{{ $mk->kelas }}</td>
                                <td>{{ $mk->sks }}</td>
                                <td>{{ $mk->tanggal_praktikum }}</td>
                                <td>{{ $mk->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('mata_kuliah_praktikum.edit', $mk->kode_mata_kuliah) }}">Edit</a>
                                    <form action="{{ route('mata_kuliah_praktikum.destroy', $mk->kode_mata_kuliah) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data mata kuliah praktikum.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>

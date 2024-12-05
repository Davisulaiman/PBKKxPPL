@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan Praktikum - Pertemuan {{ $pertemuan }}</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-file-alt me-1"></i>
                Detail Laporan Praktikum
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Mata Kuliah Praktikum ID</th>
                        <td>{{ $mata_kuliah_id }}</td>
                    </tr>
                    <tr>
                        <th>Pertemuan</th>
                        <td>{{ $pertemuan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Praktikum</th>
                        <td>{{ $laporan->tanggal_praktikum ?? 'Tidak tersedia' }}</td>
                    </tr>
                    <tr>
                        <th>Materi</th>
                        <td>{{ $laporan->materi ?? 'Tidak tersedia' }}</td>
                    </tr>
                    <tr>
                        <th>Bukti Praktikum</th>
                        <td>
                            @if(!empty($laporan->bukti_praktikum))
                                <a href="{{ $laporan->bukti_praktikum }}" target="_blank">Lihat Bukti Praktikum</a>
                            @else
                                Tidak ada bukti praktikum
                            @endif
                        </td>
                    </tr>
                </table>

                @if(Auth::user()->role === 'asisten_dosen')
                <div class="mt-3">
                    <a href="{{ route('laporan_praktikum.edit', ['mata_kuliah_id' => $mata_kuliah_id, 'pertemuan' => $pertemuan]) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Laporan
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

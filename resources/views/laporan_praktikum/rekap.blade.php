@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Rekap Laporan Praktikum</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Rekap Laporan Praktikum
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Mata Kuliah:</strong> {{ $mataKuliah->kode_mata_kuliah }} - {{ $mataKuliah->nama_mata_kuliah }}<br>
                    <strong>Kelas:</strong> {{ $mataKuliah->kelas }}
                </div>
                <div class="mb-3">
                    <a href="{{ route('rekap.pdf', $mataKuliah->id) }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-file-pdf"></i> Export Rekap Laporan Praktikum
                    </a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertemuan</th>
                            <th>Tanggal Praktikum</th>
                            <th>Materi</th>
                            <th>Bukti Praktikum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pertemuan }}</td>
                                <td>{{ $item->tanggal_praktikum ?? 'Tidak tersedia' }}</td>
                                <td>{{ $item->materi ?? 'Tidak tersedia' }}</td>
                                <td>
                                    @if(!empty($item->bukti_praktikum))
                                        <a href="{{ $item->bukti_praktikum }}" target="_blank">Lihat Bukti Praktikum</a>
                                    @else
                                        Tidak ada bukti praktikum
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data laporan praktikum</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan Absensi Praktikum - {{ $mataKuliah->nama_mata_kuliah }}</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Laporan Presensi Mahasiswa
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            @for ($i = 1; $i <= 16; $i++)
                                <th>Pertemuan {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswaStatusAbsensi as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['mahasiswa']->npm }}</td>
                                <td>{{ $data['mahasiswa']->nama }}</td>
                                @for ($i = 1; $i <= 10; $i++)
                                    @php
                                        $pertemuanField = 'pertemuan_' . $i;
                                        $status = $data['statusMahasiswa'][$pertemuanField] ?? 'Tidak Ada Keterangan';
                                        $symbol = match ($status) {
                                            'Hadir' => '✓',
                                            'Sakit' => 's',
                                            'Izin' => 'i',
                                            'Alpa' => 'a',
                                            default => 'x',
                                        };
                                    @endphp
                                    <td>{{ $symbol }}</td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

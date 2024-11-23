@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            <i class="fas fa-clipboard-list me-2"></i>
            Absensi - {{ $mataKuliah->nama_mata_kuliah }}
        </h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Absensi</li>
        </ol>

        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-calendar-check me-1"></i>
                Absensi Pertemuan 1-16
            </div>
            <div class="card-body">
                <!-- Tombol Rekap Laporan Absensi -->
                <a href="{{ url('/rekap_laporan_absensi/' . $mataKuliah->id) }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-file-alt me-1"></i>
                    Rekap Laporan Absensi
                </a>

                <!-- Tabel Daftar Absensi -->
                <div class="table-responsive">
                    <table id="absensiTable" class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="7%">
                                   <i class="fas fa-hashtag me-1"></i> No
                                </th>
                                <th width="33%">
                                    <i class="fas fa-list-ol me-1"></i> Pertemuan
                                </th>
                                <th width="60%">
                                    <i class="fas fa-cogs me-1"></i> Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 16; $i++)
                                @php
                                    $pertemuanField = 'pertemuan_' . $i;
                                @endphp
                                <tr>
                                    <td class="align-middle text-center">{{ $i }}</td>
                                    <td class="align-middle">Pertemuan {{ $i }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group">
                                            <!-- Tombol Absensi hanya untuk Asisten Dosen -->
                                            @if (Auth::user()->role === 'asisten_dosen')
                                                <a href="{{ url('/absensi_praktikum/' . $mataKuliah->id . '/' . $pertemuanField) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-user-check me-1"></i>
                                                    Absensi Pertemuan
                                                </a>
                                            @endif

                                            <!-- Tombol Lihat Laporan hanya untuk Kepala Lab & Laboran -->
                                            @if (in_array(Auth::user()->role, ['kepala_lab', 'laboran']))
                                                <a href="{{ url('/laporan_absensi/' . $mataKuliah->id . '/' . $pertemuanField) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-file-signature me-1"></i>
                                                    Lihat Laporan
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

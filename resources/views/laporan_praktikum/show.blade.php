@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            <i class="fas fa-book-open me-2"></i>
            Laporan Praktikum - {{ $mataKuliah->nama_mata_kuliah }}
        </h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                <i class="fas fa-clipboard-list me-1"></i>
                Daftar Laporan Praktikum
            </li>
        </ol>

        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-file-alt me-1"></i>
                Laporan Pertemuan 1-16
            </div>
            <div class="card-body">
                <a href="{{ url('/rekap_laporan_praktikum/' . $mataKuliah->id) }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-file-alt me-1"></i>
                    Rekap Laporan Praktikum
                </a>


                <div class="table-responsive">
                    <table id="laporanTable" class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="10%"><i class="fas fa-hashtag me-1"></i> Nomor</th>
                                <th width="30%"><i class="fas fa-calendar-day me-1"></i> Pertemuan</th>
                                <th width="60%"><i class="fas fa-cogs me-1"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 16; $i++)
                                <tr>
                                    <td class="text-center align-middle">{{ $i }}</td>
                                    <td class="align-middle">
                                        <i class="fas fa-chalkboard me-1"></i>
                                        Pertemuan {{ $i }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if (Auth::user()->role == 'asisten_dosen')
                                                <a href="{{ route('laporan_praktikum.create', ['mata_kuliah_id' => $mataKuliah->id, 'pertemuan' => $i]) }}"
                                                   class="btn btn-success btn-sm me-2">
                                                    <i class="fas fa-plus-circle me-1"></i>
                                                    Buat Laporan
                                                </a>
                                            @endif

                                            <a class="btn btn-primary btn-sm"
                                               href="{{ url('/laporan_praktikum/' . $mataKuliah->id . '/' . $i) }}">
                                                <i class="fas fa-eye me-1"></i>
                                                Lihat Laporan
                                            </a>
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

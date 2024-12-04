@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Mahasiswa Praktikum</h1>
        <form action="{{ route('attendance.update', $mahasiswaMataKuliahId) }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Update Absensi</h5>

                    <a href="{{ route('attendance.print', $mahasiswaMataKuliahId) }}"
                        class="btn btn-info btn-sm">
                        <i class="fas fa-paper-plane"></i> Print
                    </a>
                    
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pertemuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 16; $i++)
                                <tr>
                                    <td>Pertemuan {{ $i }}</td>
                                    <td>
                                        <select name="pertemuan_{{ $i }}" id="pertemuan_{{ $i }}" class="form-control">
                                            <option value="Hadir" {{ ($attendance->{'pertemuan_' . $i} ?? 'Tidak Ada Keterangan') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Sakit" {{ ($attendance->{'pertemuan_' . $i} ?? 'Tidak Ada Keterangan') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                            <option value="Izin" {{ ($attendance->{'pertemuan_' . $i} ?? 'Tidak Ada Keterangan') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                            <option value="Alpa" {{ ($attendance->{'pertemuan_' . $i} ?? 'Tidak Ada Keterangan') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                                            <option value="Tidak Ada Keterangan" {{ ($attendance->{'pertemuan_' . $i} ?? 'Tidak Ada Keterangan') == 'Tidak Ada Keterangan' ? 'selected' : '' }}>Tidak Ada Keterangan</option>
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Update Absensi</button>
                </div>
            </div>
        </form>
    </div>
@endsection

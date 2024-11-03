@extends('template.template')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Mahasiswa Praktikum</h1>
        <form action="{{ route('attendance.update', $mahasiswaMataKuliahId) }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Update Absensi</h5>
                </div>
                <div class="card-body">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="form-group">
                            <label for="pertemuan_{{ $i }}">Pertemuan {{ $i }}</label>
                            <select name="pertemuan_{{ $i }}" id="pertemuan_{{ $i }}" class="form-control">
                                <option value="Hadir" {{ $attendance->{'pertemuan_' . $i} == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="Sakit" {{ $attendance->{'pertemuan_' . $i} == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="Izin" {{ $attendance->{'pertemuan_' . $i} == 'Izin' ? 'selected' : '' }}>Izin</option>
                                <option value="Alpa" {{ $attendance->{'pertemuan_' . $i} == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                                <option value="Tidak Ada Keterangan" {{ $attendance->{'pertemuan_' . $i} == 'Tidak Ada Keterangan' ? 'selected' : '' }}>Tidak Ada Keterangan</option>
                            </select>
                        </div>
                    @endfor
                    <button type="submit" class="btn btn-primary">Update Absensi</button>
                </div>
            </div>
        </form>
    </div>
@endsection

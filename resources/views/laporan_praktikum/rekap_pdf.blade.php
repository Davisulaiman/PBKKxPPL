<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Praktikum - {{ $mataKuliah->nama_mata_kuliah }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 40%;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Rekap Laporan Praktikum</h1>
    <p><strong>Mata Kuliah:</strong> {{ $mataKuliah->kode_mata_kuliah }} - {{ $mataKuliah->nama_mata_kuliah }}</p>
    <p><strong>Kelas:</strong> {{ $mataKuliah->kelas }}</p>
    <table class="table">
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
                            <a href="{{ $item->bukti_praktikum }}">{{ $item->bukti_praktikum }}</a>
                        @else
                            Tidak ada bukti praktikum
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data laporan praktikum</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Tanda Tangan -->
    <div class="signature">
        <div>
            <p>Asisten Dosen 1</p>
            <br><br><br>
            <p>________________________</p>
            <p>{{ $asistenDosen1->name ?? $asistenDosen1->nama ?? 'Asisten 1 Tidak Tersedia' }}</p>
            <p>NPM: </p>
        </div>
        <div>
            <p>Asisten Dosen 2</p>
            <br><br><br>
            <p>________________________</p>
            <p>{{ $asistenDosen2->name ?? $asistenDosen2->nama ?? 'Asisten 2 Tidak Tersedia' }}</p>
            <p>NPM: </p>
        </div>
    </div>
</body>
</html>

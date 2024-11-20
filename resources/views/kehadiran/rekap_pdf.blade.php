<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan Absensi</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path("fonts/DejaVuSans.ttf") }}') format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        .tanda-centang {
            font-size: 16px;
            font-weight: bold;
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
    <h2 style="text-align: center;">Rekap Laporan Absensi</h2>
    <h3 style="text-align: center;">{{ $mataKuliah->nama }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama</th>
                @for ($i = 1; $i <= 16; $i++)
                    <th>P{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswaStatusAbsensi as $index => $mahasiswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mahasiswa['npm'] }}</td>
                    <td>{{ $mahasiswa['nama'] }}</td>
                    @foreach ($mahasiswa['rekap'] as $status)
                        <td class="status">{{ $status }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Keterangan -->
    <div class="keterangan">
        <p><strong>Keterangan:</strong></p>
        <p>
            ✓: Hadir<br>
            S: Sakit<br>
            I: Izin<br>
            A: Alpa<br>
            -: Tidak Ada Keterangan
        </p>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature">
        <div>
            <p>Asisten Dosen 1</p>
            <br><br><br>
            <p>________________________</p>
        </div>
        <div>
            <p>Asisten Dosen 2</p>
            <br><br><br>
            <p>________________________</p>
        </div>
    </div>
</body>
</html>

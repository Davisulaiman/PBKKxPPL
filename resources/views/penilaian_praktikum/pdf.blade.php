<!DOCTYPE html>
<html>
<head>
    <title>Penilaian Praktikum</title>
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        a {
            font-size: 9pt;
            color: blue; /* Optional: Adjust color if necessary */
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Penilaian Praktikum</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Kelas</th>
                <th>Link Penilaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaianPraktikum as $index => $penilaian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $penilaian->mataKuliahPraktikum->kode_mata_kuliah }}</td>
                    <td>{{ $penilaian->mataKuliahPraktikum->nama_mata_kuliah }}</td>
                    <td>{{ $penilaian->mataKuliahPraktikum->kelas }}</td>
                    <td>
                        <a href="{{ $penilaian->google_drive_link }}" target="_blank">{{ $penilaian->google_drive_link }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

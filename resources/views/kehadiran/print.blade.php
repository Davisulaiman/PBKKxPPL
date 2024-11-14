<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pertemuan {{ $pertemuan }} - {{ $mataKuliah->nama_mata_kuliah }}</title>
    <!-- Add any required CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Print-Friendly CSS */
        @media print {
            .no-print {
                display: none;
            }
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid black;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Pertemuan {{ $pertemuan }} - {{ $mataKuliah->nama_mata_kuliah }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Absensi Mahasiswa</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-check me-1"></i>
                Daftar Mahasiswa
            </div>
            <div class="card-body">
                <!-- Print Button (will be hidden when printing) -->
                <button onclick="window.print()" class="btn btn-secondary mb-3 no-print">Print this Page</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NPM</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswaStatusAbsensi as $data)
                            <tr>
                                <td>{{ $data['mahasiswa']->nama }}</td>
                                <td>{{ $data['mahasiswa']->npm }}</td>
                                <td>{{ $data['statusMahasiswa'] }}</td> <!-- Read-Only Status -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Signature Areas -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Mengetahui,</p>
                <div class="signature-line"></div>
                <p>Nama Pemberi Tanda Tangan</p>
            </div>
            <div class="signature-box">
                <p>Mengetahui,</p>
                <div class="signature-line"></div>
                <p>Nama Pemberi Tanda Tangan</p>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (Optional, for any interactive features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

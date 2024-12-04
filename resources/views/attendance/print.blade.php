<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi Mahasiswa Praktikum</title>
    <!-- Add any required CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Print-Friendly CSS */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Mahasiswa Praktikum</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Absensi Mahasiswa</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <h5>Update Absensi</h5>
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
                        @for ($i = 1; $i <= 10; $i++)
                            <tr>
                                <td>Pertemuan {{ $i }}</td>
                                <td>
                                    {{ $attendance->{'pertemuan_' . $i} ?? 'Tidak Ada Keterangan' }}
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    <!-- Bootstrap JS (Optional, for any interactive features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

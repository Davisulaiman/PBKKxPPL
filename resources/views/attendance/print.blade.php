<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi Mahasiswa Praktikum</h1>

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
                                    {{ $attendance->{'pertemuan_' . $i} }}
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>

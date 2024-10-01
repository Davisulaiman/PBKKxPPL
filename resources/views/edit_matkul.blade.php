<x-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    @endpush

    @push('header_scripts')
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @endpush

    @push('scripts')
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    @endpush

<div class="container mt-4">
    <h2>Edit Mata Kuliah Praktikum</h2>
    <form action="{{ route('mata_kuliah_praktikum.update', $mata_kuliah_praktikum->kode_mata_kuliah) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Mata Kuliah:</label>
            <input type="text" name="nama_mata_kuliah" value="{{ $mata_kuliah_praktikum->nama_mata_kuliah }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kelas:</label>
            <select name="kelas" class="form-control">
                <option value="A" {{ $mata_kuliah_praktikum->kelas == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ $mata_kuliah_praktikum->kelas == 'B' ? 'selected' : '' }}>B</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jumlah SKS:</label>
            <input type="number" name="sks" value="{{ $mata_kuliah_praktikum->sks }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Praktikum:</label>
            <input type="date" name="tanggal_praktikum" value="{{ $mata_kuliah_praktikum->tanggal_praktikum }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status Aktif:</label>
            <select name="status_aktif" class="form-control">
                <option value="1" {{ $mata_kuliah_praktikum->status_aktif == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $mata_kuliah_praktikum->status_aktif == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Perbarui</button>
    </form>
</div>

</x-layout>

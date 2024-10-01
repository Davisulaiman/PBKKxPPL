<x-layout appname="Laboratorium Sistem Informasi UNIB">

    <div class="container mt-4">
        <h2>Tambah Mata Kuliah Praktikum</h2>
        <form action="{{ route('mata_kuliah_praktikum.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Mata Kuliah:</label>
                <input type="text" name="kode_mata_kuliah" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Mata Kuliah:</label>
                <input type="text" name="nama_mata_kuliah" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <select name="kelas" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah SKS:</label>
                <input type="number" name="sks" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Praktikum:</label>
                <input type="date" name="tanggal_praktikum" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Status Aktif:</label>
                <select name="status_aktif" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>

</x-layout>

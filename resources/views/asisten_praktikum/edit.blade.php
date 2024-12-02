@extends('template.template')

@section('content')
<div class="container mt-4">
    <h2>Edit Asisten Praktikum</h2>

    <!-- Notifikasi Pesan Error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asisten_praktikum.update', $asisten->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>NPM:</label>
            <input type="text" name="npm" class="form-control" value="{{ old('npm', $asisten->npm) }}" required>
            @error('npm')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Nama Praktikan:</label>
            <input type="text" name="nama_praktikan" class="form-control" value="{{ old('nama_praktikan', $asisten->user->name) }}" required>
            @error('nama_praktikan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $asisten->username) }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $asisten->user->email) }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Password (biarkan kosong jika tidak ingin mengubah):</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Mata Kuliah Praktikum:</label>
            <div class="checkbox-list">
                @foreach($mataKuliahPraktikum as $mataKuliah)
                    <div class="form-check custom-checkbox">
                        <input type="checkbox" class="form-check-input" name="mata_kuliah_praktikum_id[]" value="{{ $mataKuliah->id }}" id="mataKuliah{{ $mataKuliah->id }}"
                        @if (in_array($mataKuliah->id, $selectedMataKuliah)) checked @endif>
                        <label class="form-check-label" for="mataKuliah{{ $mataKuliah->id }}">
                             ({{ $mataKuliah->kode_mata_kuliah }}) {{ $mataKuliah->nama_mata_kuliah }} ({{ $mataKuliah->kelas }})
                        </label>
                    </div>
                @endforeach
            </div>
            @error('mata_kuliah_praktikum_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection

@push('styles')
<style>
    .checkbox-list {
        display: flex;
        flex-direction: column;
        max-height: 300px;
        overflow-y: auto;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-check {
        margin-bottom: 12px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }

    .form-check:hover {
        background-color: #f0f0f0;
    }

    .form-check-input {
        margin-right: 10px;
    }

    .form-check-label {
        color: #333;
        font-size: 0.95rem;
        cursor: pointer;
    }

    .form-check-input:checked + .form-check-label {
        color: #0d6efd; /* Menggunakan warna primary untuk konsistensi dengan tombol update */
        font-weight: 500;
    }

    /* Styling scrollbar */
    .checkbox-list::-webkit-scrollbar {
        width: 8px;
    }

    .checkbox-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .checkbox-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .checkbox-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

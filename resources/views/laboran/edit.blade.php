<!-- resources/views/laboran/edit.blade.php -->
@extends('template.template')

@section('content')
<div class="container mt-4">
    <h2>Edit Laboran</h2>

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

    <form action="{{ route('laboran.update', $laboran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $laboran->nama) }}" required>
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $laboran->username) }}" required>
            @error('username')
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

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('laboran.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection

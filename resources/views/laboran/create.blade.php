<!-- resources/views/laboran/create.blade.php -->
@extends('template.template')

@section('content')
<div class="container">
    <h1>Tambah Laboran</h1>

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

    <form action="{{ route('laboran.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

 

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('laboran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

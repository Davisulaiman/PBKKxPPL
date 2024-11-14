<!-- resources/views/laboran/edit.blade.php -->
@extends('template.template')

@section('content')
<div class="container">
    <h1>Edit Laboran</h1>

    <form action="{{ route('laboran.update', $laboran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ $laboran->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ $laboran->username }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $laboran->email }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('laboran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

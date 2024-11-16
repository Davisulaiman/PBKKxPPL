<!-- resources/views/asisten_praktikum/create.blade.php -->
@extends('template.template')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Asisten Praktikum</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('asisten_praktikum.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input
                                type="text"
                                name="npm"
                                class="form-control @error('npm') is-invalid @enderror"
                                id="npm"
                                value="{{ old('npm') }}"
                                required
                            >
                            @error('npm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_praktikan" class="form-label">Nama Praktikan</label>
                            <input
                                type="text"
                                name="nama_praktikan"
                                class="form-control @error('nama_praktikan') is-invalid @enderror"
                                id="nama_praktikan"
                                value="{{ old('nama_praktikan') }}"
                                required
                            >
                            @error('nama_praktikan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                type="text"
                                name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                id="username"
                                value="{{ old('username') }}"
                                required
                            >
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mata Kuliah Praktikum</label>
                            <div class="checkbox-list">
                                @foreach($mataKuliahPraktikum as $mataKuliah)
                                    <div class="form-check custom-checkbox">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            name="mata_kuliah_praktikum_id[]"
                                            value="{{ $mataKuliah->id }}"
                                            id="mataKuliah{{ $mataKuliah->id }}"
                                            @if (in_array($mataKuliah->id, old('mata_kuliah_praktikum_id', []))) checked @endif
                                        >
                                        <label class="form-check-label" for="mataKuliah{{ $mataKuliah->id }}">
                                            {{ $mataKuliah->nama_mata_kuliah }} ({{ $mataKuliah->kode_mata_kuliah }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('mata_kuliah_praktikum_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('asisten_praktikum.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .checkbox-list {
        display: flex;
        flex-direction: column;
        max-height: 300px;
        overflow-y: auto;
        padding: 1rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.375rem;
        background-color: #f8f9fa;
    }

    .form-check {
        margin-bottom: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        transition: background-color 0.2s ease;
    }

    .form-check:last-child {
        margin-bottom: 0;
    }

    .form-check:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .form-check-input {
        margin-right: 0.625rem;
    }

    .form-check-label {
        color: #495057;
        font-size: 0.95rem;
        cursor: pointer;
    }

    .form-check-input:checked + .form-check-label {
        color: var(--bs-primary);
        font-weight: 500;
    }

    /* Scrollbar styling */
    .checkbox-list::-webkit-scrollbar {
        width: 0.5rem;
    }

    .checkbox-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 0.25rem;
    }

    .checkbox-list::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 0.25rem;
    }

    .checkbox-list::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
</style>
@endpush

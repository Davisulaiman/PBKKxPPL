@extends('template.template')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('Pengaturan Profil') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ __('Pengaturan Profil') }}</li>
    </ol>

    {{-- Profile Information Section --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Informasi Profil') }}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}" class="mt-6" id="profileUpdateForm">
                @csrf
                @method('patch')

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light w-25">{{ __('Nama') }}</th>
                            <td>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Email') }}</th>
                            <td>
                                <input type="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <!-- Button to trigger modal for updating profile -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                        {{ __('Perbarui Profil') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Update Profile Modal --}}
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">{{ __('Konfirmasi Pembaruan Profil') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('Apakah Anda yakin ingin memperbarui informasi profil Anda?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal') }}</button>
                    <button type="submit" form="profileUpdateForm" class="btn btn-primary">{{ __('Ya, Perbarui') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Password Update Section --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ __('Perbarui Kata Sandi') }}</h5>
        </div>
        <div class="card-body">
            @if (session('password_status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('password_status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="post" action="{{ route('password.update') }}" id="passwordUpdateForm">
                @csrf
                @method('put')

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light w-25">{{ __('Kata Sandi Saat Ini') }}</th>
                            <td>
                                <input type="password"
                                       name="current_password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Kata Sandi Baru') }}</th>
                            <td>
                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Konfirmasi Kata Sandi') }}</th>
                            <td>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">
                        {{ __('Perbarui Kata Sandi') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Update Password Modal --}}
    <div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePasswordModalLabel">{{ __('Konfirmasi Pembaruan Kata Sandi') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('Apakah Anda yakin ingin memperbarui kata sandi Anda?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal') }}</button>
                    <button type="submit" form="passwordUpdateForm" class="btn btn-primary">{{ __('Ya, Perbarui') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Account Section --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">{{ __('Hapus Akun') }}</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                {{ __('Setelah akun Anda dihapus, semua data dan sumber daya Anda akan dihapus secara permanen.') }}
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light w-25">{{ __('Konfirmasi Kata Sandi') }}</th>
                            <td>
                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <!-- Button to trigger modal for deleting account -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        {{ __('Hapus Akun') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Account Modal --}}
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">{{ __('Konfirmasi Penghapusan Akun') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('PERHATIAN: Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus akun Anda?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal') }}</button>
                    <button type="submit" form="deleteAccountForm" class="btn btn-danger">{{ __('Hapus Akun') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

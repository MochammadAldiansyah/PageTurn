@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class="fs-85 letter-spacing-2 text-uppercase mb-1">Pengaturan Akun</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">PENGATURAN PROFIL</h2>
</div>

<div class="row g-5 mb-5">
    <!-- Profile Information -->
    <div class="col-lg-6">
        <div class="bg-dark-panel p-4 p-md-5 h-100 border border-secondary border-opacity-10">
            <h4 class="text-white fw-bold mb-1 text-uppercase font-oswald">Informasi Profil</h4>
            <p class="text-secondary fs-85 letter-spacing-1 mb-4">Perbarui nama, email, dan foto profil akun Anda.</p>

            <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="mb-4 d-flex align-items-end gap-3">
                    <div class="position-relative">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle object-fit-cover border border-secondary border-opacity-25" width="80" height="80" alt="">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" class="rounded-circle border border-secondary border-opacity-25" width="80" height="80" alt="">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Ganti Foto Profil</label>
                        <input type="file" name="avatar" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('avatar') is-invalid @enderror" accept="image/*">
                        @error('avatar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-5">
                    <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-light rounded-0 px-4 py-2 letter-spacing-1 text-uppercase fw-bold">Simpan Perubahan</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-success fs-85 letter-spacing-1"><i class="fa-solid fa-check me-1"></i> BERHASIL DISIMPAN</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Update Password -->
    <div class="col-lg-6">
        <div class="bg-dark-panel p-4 p-md-5 h-100 border border-secondary border-opacity-10">
            <h4 class="text-white fw-bold mb-1 text-uppercase font-oswald">Ubah Password</h4>
            <p class="text-secondary fs-85 letter-spacing-1 mb-4">Pastikan akun Anda menggunakan password yang panjang dan acak.</p>

            <form method="post" action="{{ route('password.update') }}" class="mt-4">
                @csrf
                @method('put')

                <div class="mb-4">
                    <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('current_password', 'updatePassword') is-invalid @enderror" required>
                    @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Password Baru</label>
                    <input type="password" name="password" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('password', 'updatePassword') is-invalid @enderror" required>
                    @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-5">
                    <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('password_confirmation', 'updatePassword') is-invalid @enderror" required>
                    @error('password_confirmation', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-outline-light rounded-0 px-4 py-2 letter-spacing-1 text-uppercase">Perbarui Password</button>
                    @if (session('status') === 'password-updated')
                        <span class="text-success fs-85 letter-spacing-1"><i class="fa-solid fa-check me-1"></i> PASSWORD DIPERBARUI</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

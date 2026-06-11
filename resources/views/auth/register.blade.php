@extends('landing.layouts.app')

@section('content')

<section class="auth-section">
    <div class="auth-container">
        {{-- Corner Borders --}}
        <div class="corner-tl"></div>
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="corner-br"></div>

        {{-- Header --}}
        <div class="text-center mb-5">
             <h2 class="auth-title text-white">BUAT AKUN<br>BARU</h2>
             <p class="auth-subtitle">Bergabung dengan PageTurn sekarang.</p>
        </div>

        {{-- Register Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="auth-label">NAMA LENGKAP</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    class="auth-input-line form-control @error('name') is-invalid @enderror"
                    placeholder="Nama Anda"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="auth-label">ALAMAT EMAIL</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="auth-input-line form-control @error('email') is-invalid @enderror"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="auth-label">KATA SANDI</label>
                <div class="position-relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="auth-input-line form-control pe-5 @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="btn-toggle-password position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent text-white-50 p-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="auth-label">KONFIRMASI KATA SANDI</label>
                <div class="position-relative">
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="auth-input-line form-control pe-5"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="btn-toggle-password position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent text-white-50 p-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="auth-btn btn w-100 fw-bold d-flex justify-content-center align-items-center gap-2 mt-4">
                DAFTAR
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
            </button>

            <p class="auth-footer-text text-center mt-4 mb-0">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-white fw-bold text-decoration-none">Masuk</a>
            </p>
        </form>
    </div>
</section>

@endsection

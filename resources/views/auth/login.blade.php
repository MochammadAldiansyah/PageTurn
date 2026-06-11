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
            <h2 class="auth-title text-white">SELAMAT DATANG<br>KEMBALI</h2>
            <p class="auth-subtitle">Masuk ke akun PageTurn Anda.</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
        <div class="alert alert-success text-center mb-4" role="alert">
            {{ session('status') }}
        </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    autofocus
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
                        autocomplete="current-password"
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

                <div class="text-end mt-2">
                    <a href="" class="auth-link-sm text-decoration-none">Lupa kata sandi?</a>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="auth-btn btn w-100 fw-bold d-flex justify-content-center align-items-center gap-2 mt-4">
                MASUK
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
            </button>

            <p class="auth-footer-text text-center mt-4 mb-0">
                Belum punya akun? <a href="{{ route('register') }}" class="text-white fw-bold text-decoration-none">Daftar sekarang</a>
            </p>
        </form>
    </div>
</section>

@endsection

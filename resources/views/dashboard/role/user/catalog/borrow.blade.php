@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class="fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Perpustakaan</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">FORM PEMINJAMAN</h2>
</div>

@if(session('error'))
    <div class="alert alert-danger bg-dark-panel border-danger border-opacity-25 text-danger rounded-0 mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="row g-5 mb-5">
    <!-- Book Info -->
    <div class="col-md-4">
        <div class="bg-dark-panel border border-secondary border-opacity-10 p-0">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-100 object-fit-cover border-bottom border-secondary border-opacity-25 h-350px" alt="Cover">
            @else
                <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center border-bottom border-secondary border-opacity-25 h-350px">
                    <i class="fa-solid fa-image fs-1 opacity-50"></i>
                </div>
            @endif
            <div class="p-4">
                <h4 class="text-white fw-bold mb-1 font-oswald">{{ $book->title }}</h4>
                <p class="fs-85 letter-spacing-1 mb-3">{{ $book->author }}</p>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between border-bottom border-secondary border-opacity-10 pb-2">
                        <span class="fs-85 letter-spacing-1">KATEGORI</span>
                        <span class="text-light fs-85">{{ optional($book->category)->name ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom border-secondary border-opacity-10 pb-2">
                        <span class="fs-85 letter-spacing-1">PENERBIT</span>
                        <span class="text-light fs-85">{{ $book->publisher ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom border-secondary border-opacity-10 pb-2">
                        <span class="fs-85 letter-spacing-1">ISBN</span>
                        <span class="text-light fs-85">{{ $book->isbn ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="fs-85 letter-spacing-1">STOK TERSEDIA</span>
                        <span class="text-light fs-85">{{ $book->stock }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrow Form -->
    <div class="col-md-8">
        <div class="bg-dark-panel border border-secondary border-opacity-10 p-4 p-md-5">
            <div class="border-bottom border-secondary border-opacity-25 pb-3 mb-4">
                <h5 class="text-white fw-bold text-uppercase mb-1 font-oswald">Informasi Peminjam</h5>
                <div class="fs-85 letter-spacing-1">LENGKAPI DATA PEMINJAMAN ANDA</div>
            </div>

            <form action="{{ route('user.catalog.borrow.store', $book->id) }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="fs-85 text-uppercase letter-spacing-1 mb-2">Nama Peminjam</label>
                        <input type="text" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2" value="{{ auth()->user()->name }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-85 text-uppercase letter-spacing-1 mb-2">Email</label>
                        <input type="text" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2" value="{{ auth()->user()->email }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-85 text-uppercase letter-spacing-1 mb-2">Tanggal Peminjaman</label>
                        <input type="text" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2" value="{{ now()->format('d M Y') }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-85 text-uppercase letter-spacing-1 mb-2">Tanggal Pengembalian <span class="text-danger">*</span></label>
                        <input type="date" name="return_date" class="form-control bg-dark border-secondary border-opacity-25 text-white rounded-0 py-2 @error('return_date') is-invalid @enderror" min="{{ now()->addDay()->format('Y-m-d') }}" required>
                        @error('return_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="text-muted fs-85 text-uppercase letter-spacing-1 mb-2">Buku Yang Dipinjam</label>
                        <input type="text" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2" value="{{ $book->title }} — {{ $book->author }}" disabled>
                    </div>

                    <div class="col-12">
                        <label class="text-muted fs-85 text-uppercase letter-spacing-1 mb-2">Alamat Peminjam <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control bg-dark border-secondary border-opacity-25 text-white rounded-0 py-2 @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-5 d-flex gap-3">
                    <button type="submit" class="btn btn-light rounded-0 px-5 py-2 letter-spacing-1 fw-bold">KONFIRMASI PINJAM</button>
                    <a href="{{ route('user.catalog.index') }}" class="btn btn-outline-secondary rounded-0 px-4 py-2 letter-spacing-1">BATAL</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

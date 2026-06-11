@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4 d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
    <div>
        <div class=" fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Perpustakaan</div>
        <h2 class="fw-bold text-white mb-0 display-6 font-oswald">KATALOG BUKU</h2>
    </div>

    <form action="{{ route('user.catalog.index') }}" method="GET" class="search-box position-relative w-full max-w-400px">
        <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 fs-09rem"></i>
        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-dark-panel border-secondary border-opacity-25 text-white ps-5 py-2 rounded-0 fs-85 letter-spacing-1" placeholder="Cari judul, penulis, atau kategori...">
    </form>
</div>

<div class="d-flex overflow-auto gap-2 mb-4 pb-2 white-space-nowrap scrollbar-none">
    <a href="{{ route('user.catalog.index', ['search' => request('search')]) }}" class="btn {{ !request('category') ? 'btn-light text-dark' : 'btn-outline-light' }} rounded-pill px-4 py-2 letter-spacing-1 fs-85">Semua Kategori</a>
    @foreach($categories as $category)
        <a href="{{ route('user.catalog.index', ['category' => $category->id, 'search' => request('search')]) }}" class="btn {{ request('category') == $category->id ? 'btn-light text-dark' : 'btn-outline-light' }} rounded-pill px-4 py-2 letter-spacing-1 fs-85">{{ $category->name }}</a>
    @endforeach
</div>

<div class="row g-4 mb-5">
    @forelse($books as $book)
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card bg-dark-panel border-secondary border-opacity-25 rounded-0 h-100 catalog-card">
            <div class="position-relative d-flex justify-content-center align-items-center" style="height: 280px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, rgba(0,0,0,0) 80%);">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="h-100 w-100 object-fit-contain py-4 px-3" style="filter: drop-shadow(0 15px 25px rgba(0,0,0,0.9));" alt="Cover">
                @else
                    <i class="fa-solid fa-book fs-1 text-secondary opacity-50"></i>
                @endif
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="badge border border-secondary border-opacity-50 text-light bg-black bg-opacity-75 rounded-0 px-3 py-1 fs-85 letter-spacing-1">
                        {{ optional($book->category)->name ?? 'Tanpa Kategori' }}
                    </span>
                </div>
            </div>
            <div class="card-body p-4 d-flex flex-column bg-transparent">
                <h5 class="card-title text-white fw-bold mb-1 fs-5 font-oswald line-clamp-2">{{ $book->title }}</h5>
                <p class="card-text text-white-50 fs-85 letter-spacing-1 mb-4">{{ $book->author }}</p>

                <div class="mt-auto pt-3 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                    <div class="text-light fs-85 fw-semibold d-flex align-items-center">
                        <i class="fa-solid fa-layer-group me-2"></i> Stok: {{ $book->stock }}
                    </div>
                    @if($book->stock > 0)
                        <a href="{{ route('user.catalog.borrow', $book->id) }}" class="btn btn-outline-light btn-sm rounded-0 letter-spacing-1 px-4 py-1">PINJAM</a>
                    @else
                        <button class="btn btn-outline-danger btn-sm rounded-0 letter-spacing-1 px-4 py-1" disabled>HABIS</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="bg-dark-panel p-5 text-center border border-secondary border-opacity-10 d-flex flex-column align-items-center justify-content-center min-h-300px">
            <i class="fa-solid fa-magnifying-glass fs-1 mb-3 opacity-50"></i>
            <h5 class="fw-normal letter-spacing-1 text-uppercase text-white">Buku Tidak Ditemukan</h5>
            <p class="fs-85 opacity-75">Maaf, kami tidak dapat menemukan buku yang cocok dengan pencarian Anda.</p>
            @if(request('search'))
                <a href="{{ route('user.catalog.index') }}" class="btn btn-outline-light rounded-0 px-4 py-2 mt-3 letter-spacing-1 fs-85 text-uppercase">Hapus Pencarian</a>
            @endif
        </div>
    </div>
    @endforelse
</div>

@if($books->hasPages())
<div class="mb-5 d-flex justify-content-center">
    {{ $books->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection

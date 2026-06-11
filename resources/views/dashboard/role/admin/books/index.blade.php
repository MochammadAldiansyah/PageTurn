@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4 d-flex justify-content-between align-items-end">
    <div>
        <div class=" fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Perpustakaan</div>
        <h2 class="fw-bold text-white mb-0 display-6 font-oswald">KATALOG BUKU</h2>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-light rounded-0 px-4 py-2 letter-spacing-1 fw-bold">
        <i class="fa-solid fa-plus me-2"></i> TAMBAH BUKU
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success bg-dark-panel border-success border-opacity-25 text-success rounded-0 mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="recent-activities-section bg-dark-panel p-4 p-md-5 mb-5">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 w-80px">Sampul</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Judul</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Penulis</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Kategori</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Stok</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="rounded object-fit-cover w-50px h-70px">
                        @else
                            <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center w-50px h-70px">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 py-4 text-white fs-90">{{ $book->title }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ $book->author }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">
                        <span class="badge border border-secondary border-opacity-25 text-light rounded-0 px-3 py-1 letter-spacing-1">
                            {{ optional($book->category)->name ?? 'Tanpa Kategori' }}
                        </span>
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ $book->stock }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-end py-4">
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-outline-light btn-sm rounded-0 border-opacity-25 px-3 py-2 me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-0 border-opacity-25 px-3 py-2">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center  py-5">Belum ada buku dalam katalog.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($books->hasPages())
    <div class="mt-5">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection

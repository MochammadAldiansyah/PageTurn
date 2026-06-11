@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class="fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Perpustakaan</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">PINJAMAN SAYA</h2>
</div>

<div class="recent-activities-section mb-5">
    @if($borrowings->isEmpty())
    <div class="bg-dark-panel p-5 text-center border border-secondary border-opacity-10 d-flex flex-column align-items-center justify-content-center min-h-200px">
        <i class="fa-solid fa-book-open-reader fs-1 mb-3 opacity-50"></i>
        <h5 class="fw-normal letter-spacing-1 text-uppercase text-white">TIDAK ADA PINJAMAN</h5>
        <p class="fs-85 opacity-75">Anda belum meminjam buku apapun dari perpustakaan.</p>
        <a href="{{ route('user.catalog.index') }}" class="btn btn-outline-light rounded-0 px-4 py-2 mt-3 letter-spacing-1 fs-85 text-uppercase">Lihat Katalog</a>
    </div>
    @else
    <div class="table-responsive bg-transparent border-0 p-0">
        <table class="table table-dark table-hover align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 w-80px">Sampul</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Judul Buku</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Dipinjam Pada</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Batas Pengembalian</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $detail)
                <tr>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        @if($detail->book && $detail->book->cover_image)
                            <img src="{{ asset('storage/' . $detail->book->cover_image) }}" alt="Cover" class="rounded object-fit-cover w-50px h-70px">
                        @else
                            <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center text-muted w-50px h-70px">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        <div class="text-white fs-90">{{ optional($detail->book)->title ?? 'Buku Tidak Diketahui' }}</div>
                        <div class="fs-85 letter-spacing-1 mt-1">{{ optional($detail->book)->author ?? '-' }}</div>
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90 fw-bold">{{ optional($detail->borrowing)->borrow_date ? $detail->borrowing->borrow_date->format('M d, Y') : '-' }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90 fw-bold">{{ $detail->return_date ? $detail->return_date->format('M d, Y') : '-' }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        @if($detail->status === 'returned')
                            <span class="badge border border-success text-success bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">DIKEMBALIKAN</span>
                        @elseif($detail->status === 'overdue')
                            <span class="badge border border-danger text-danger bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">TERLAMBAT</span>
                        @else
                            <span class="badge badge-active border border-warning text-warning bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">AKTIF</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($borrowings->hasPages())
    <div class="mt-5">
        {{ $borrowings->links('pagination::bootstrap-5') }}
    </div>
    @endif
    @endif
</div>
@endsection

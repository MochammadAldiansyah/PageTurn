@extends('dashboard.layouts.app')

@section('content')
    <!-- Header -->
    <div class="dashboard-header mb-5">
        <h2 class="fw-bold text-white mb-2 display-6 font-oswald">Selamat Datang,
            {{ auth()->user()->name ?? 'User' }}</h2>
        <div class="text-secondary fs-85 letter-spacing-2 text-uppercase">DASHBOARD ANGGOTA</div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-title text-uppercase">Buku Yang Dipinjam</div>
                    <i class="fa-solid fa-book-open stat-icon"></i>
                </div>
                <h3 class="stat-value">{{ str_pad($stats['active_count'], 2, '0', STR_PAD_LEFT) }}</h3>
                <div class="stat-trend text-secondary">ITEM FISIK</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-title text-uppercase text-warning">Segera Jatuh Tempo</div>
                    <i class="fa-regular fa-clock stat-icon text-warning"></i>
                </div>
                <h3 class="stat-value text-warning">{{ str_pad($stats['due_soon_count'], 2, '0', STR_PAD_LEFT) }}</h3>
                <div class="stat-trend text-warning">PERHATIAN MENDESAK</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-title text-uppercase">Total Dipinjam</div>
                    <i class="fa-solid fa-clock-rotate-left stat-icon"></i>
                </div>
                <h3 class="stat-value">{{ str_pad($stats['total_borrowed'], 2, '0', STR_PAD_LEFT) }}</h3>
                <div class="stat-trend text-secondary">RIWAYAT KESELURUHAN</div>
            </div>
        </div>
    </div>

    <!-- Current Books Section -->
    <div class="mb-5">
        <div
            class="d-flex justify-content-between align-items-end border-bottom border-secondary border-opacity-25 pb-3 mb-4">
            <div>
                <h4 class="mb-1 text-white fw-bold text-uppercase font-oswald">Buku Yang
                    Sedang Dipinjam</h4>
                <div class="text-secondary fs-85 letter-spacing-1 text-uppercase">BARANG YANG SEDANG KAMU BAWA</div>
            </div>
            <a href="{{ route('user.borrowings.index') }}"
                class="text-white text-decoration-none fs-85 letter-spacing-1 border-bottom border-white pb-1">LIHAT SEMUA PINJAMAN</a>
        </div>

        @if($activeBorrowings->isEmpty())
        <!-- Empty State -->
        <div class="bg-dark-panel p-5 text-center text-secondary border border-secondary border-opacity-10 d-flex flex-column align-items-center justify-content-center min-h-200px">
            <i class="fa-solid fa-book-open-reader fs-1 mb-3 opacity-50"></i>
            <h5 class="fw-normal letter-spacing-1 text-uppercase text-white">Belum Meminjam Buku Apapun</h5>
            <p class="fs-85 opacity-75">Jelajahi katalog dan temukan buku menarik untuk dipinjam saat ini.</p>
            <a href="{{ route('user.catalog.index') }}"
                class="btn btn-outline-light rounded-0 px-4 py-2 mt-3 letter-spacing-1 fs-85 text-uppercase">Lihat
                Katalog</a>
        </div>
        @else
        <div class="table-responsive bg-transparent border-0 p-0">
            <table class="table table-dark table-hover align-middle custom-table mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Sampul</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Judul Buku</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Dipinjam Pada</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 text-end">Batas Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeBorrowings as $detail)
                    <tr>
                        <td class="border-bottom border-secondary border-opacity-10 py-4 w-80px">
                            @if($detail->book && $detail->book->cover_image)
                                <img src="{{ asset('storage/' . $detail->book->cover_image) }}" alt="Cover" class="rounded object-fit-cover w-50px h-70px">
                            @else
                                <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center w-50px h-70px">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="border-bottom border-secondary border-opacity-10 py-4">
                            <div class="text-white fs-90">{{ optional($detail->book)->title ?? 'Unknown Book' }}</div>
                            <div class="text-secondary fs-85 letter-spacing-1 mt-1">{{ optional($detail->book)->author ?? '-' }}</div>
                        </td>
                        <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90 fw-bold">
                            {{ optional($detail->borrowing)->borrow_date ? $detail->borrowing->borrow_date->format('M d, Y') : '-' }}
                        </td>
                        <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90 fw-bold text-end">
                            {{ $detail->return_date ? $detail->return_date->format('M d, Y') : '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Borrowing History Section -->
    <div class="recent-activities-section mb-5">
        <div class="border-bottom border-secondary border-opacity-25 pb-3 mb-4">
            <h4 class="mb-1 text-white fw-bold text-uppercase font-oswald">HISTORI PEMINJAMAN
            </h4>
            <div class="text-secondary fs-85 letter-spacing-1 text-uppercase">Riwayat peminjaman buku yang telah Anda lakukan.</div>
        </div>

        @if($historyBorrowings->isEmpty())
            <div class="text-center py-5 text-secondary fs-85 letter-spacing-1">Belum ada riwayat peminjaman.</div>
        @else
        <div class="table-responsive bg-transparent border-0 p-0">
            <table class="table table-dark table-hover align-middle custom-table mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">No.</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Judul Buku</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Dipinjam Pada</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Dikembalikan Pada</th>
                        <th class="text-uppercase text-secondary fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 text-end">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historyBorrowings as $detail)
                    <tr>
                        <td class="border-bottom border-secondary border-opacity-10 py-4">{{ $loop->iteration }}</td>
                        <td class="border-bottom border-secondary border-opacity-10 py-4">
                            <div class="text-white fs-90">{{ optional($detail->book)->title ?? 'Buku Tidak Diketahui' }}</div>
                            <div class="text-secondary fs-85 letter-spacing-1 mt-1">{{ optional($detail->book)->author ?? '-' }}</div>
                        </td>
                        <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90 text-uppercase fw-bold">
                            {{ optional($detail->borrowing)->borrow_date ? $detail->borrowing->borrow_date->format('M d, Y') : '-' }}
                        </td>
                        <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90 text-uppercase fw-bold">
                            {{ $detail->updated_at ? $detail->updated_at->format('M d, Y') : '-' }}
                        </td>
                        <td class="border-bottom border-secondary border-opacity-10 text-end py-4">
                            <span class="badge border border-success text-success bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">DIKEMBALIKAN</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if($historyBorrowings->isNotEmpty())
        <div class="text-center mt-5">
            <a href="{{ route('user.borrowings.index') }}" class="text-secondary text-decoration-none fs-85 letter-spacing-2 text-uppercase">TAMPILKAN SELURUH ARSIP</a>
        </div>
        @endif
    </div>
@endsection

@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class="fs-85 letter-spacing-2 text-uppercase mb-1">Terminal Manajemen</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">DASHBOARD MANAJEMEN</h2>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-title text-uppercase">Total Buku</div>
                <i class="fa-solid fa-book stat-icon"></i>
            </div>
            <h3 class="stat-value">{{ number_format($stats['total_books']) }}</h3>
            <div class="stat-trend text-success"><i class="fa-solid fa-arrow-trend-up"></i> INVENTARIS FISIK</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-title text-uppercase">Peminjaman Aktif</div>
                <i class="fa-solid fa-arrow-right-arrow-left stat-icon"></i>
            </div>
            <h3 class="stat-value">{{ number_format($stats['active_borrowings']) }}</h3>
            <div class="stat-trend ">YANG SEDANG DIPINJAM</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-title text-uppercase">Terlambat</div>
                <i class="fa-solid fa-triangle-exclamation stat-icon"></i>
            </div>
            <h3 class="stat-value">{{ number_format($stats['overdue_borrowings']) }}</h3>
            <div class="stat-trend ">! BUKU YANG TERLAMBAT</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-title text-uppercase">Total Pengguna</div>
                <i class="fa-regular fa-user stat-icon"></i>
            </div>
            <h3 class="stat-value">{{ number_format($stats['total_users']) }}</h3>
            <div class="stat-trend ">JUMLAH PENGGUNA</div>
        </div>
    </div>
</div>

<div class="recent-activities-section bg-dark-panel p-4 p-md-5 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom border-secondary border-opacity-25 gap-3">
        <h4 class="mb-0 text-white fw-bold">AKTIFITAS PEMINJAMAN</h4>
        <div class="search-box position-relative w-full max-w-300px">
            <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 fs-08rem"></i>
            <input type="text" class="form-control bg-transparent border-secondary border-opacity-25 text-white ps-5 rounded-0 fs-85 letter-spacing-1" placeholder="CARI AKTIVITAS...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Pengguna</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Judul Buku</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Tanggal Peminjaman</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 text-end">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBorrowings as $detail)
                <tr>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        <div class="d-flex align-items-center">
                            @if(optional($detail->borrowing->user)->avatar)
                                <img src="{{ asset('storage/' . $detail->borrowing->user->avatar) }}" class="rounded-circle me-3 border border-secondary border-opacity-25 object-fit-cover" width="32" height="32" alt="">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(optional($detail->borrowing->user)->name ?? 'Tidak Diketahui') }}&background=random" class="rounded-circle me-3 border border-secondary border-opacity-25" width="32" height="32" alt="">
                            @endif
                            <span class="text-white fs-90">{{ optional($detail->borrowing->user)->name ?? 'Tidak Diketahui' }}</span>
                        </div>
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ optional($detail->book)->title ?? 'Buku Tidak Diketahui' }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">
                        {{ optional($detail->borrowing)->borrow_date ? $detail->borrowing->borrow_date->format('M d, Y') : '-' }}
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-end py-4">
                        @if($detail->status === 'returned')
                            <span class="badge border border-success text-success bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">DIKEMBALIKAN</span>
                        @elseif($detail->status === 'overdue')
                            <span class="badge border border-danger text-danger bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">TERLAMBAT</span>
                        @else
                            <span class="badge border border-warning text-warning bg-transparent badge-active rounded-0 px-3 py-1 letter-spacing-1 fw-normal">AKTIF</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 border-bottom border-secondary border-opacity-10  fs-85 letter-spacing-1">BELUM ADA AKTIFITAS PEMINJAMAN</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($recentBorrowings->isNotEmpty())
    <div class="d-flex justify-content-between align-items-center mt-5">
        <div class="fs-85 text-uppercase letter-spacing-1 ">MENAMPILKAN {{ $recentBorrowings->count() }} TRANSAKSI TERBARU</div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-outline-secondary border-opacity-25 rounded-0 btn-sm text-white px-4 letter-spacing-1">LIHAT SEMUA</a>
        </div>
    </div>
    @endif
</div>
@endsection

@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class=" fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Perpustakaan</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">DETAIL PEMINJAMAN</h2>
</div>

<div class="recent-activities-section bg-dark-panel p-4 p-md-5 mb-5">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Info Pengguna</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Judul Buku</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Batas Pengembalian</th>
                    <th class="text-uppercase  fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 text-end">Status & Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($details as $detail)
                <tr>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        <div class="d-flex align-items-start">
                            @if(optional($detail->borrowing->user)->avatar)
                                <img src="{{ asset('storage/' . $detail->borrowing->user->avatar) }}" class="rounded-circle me-3 border border-secondary border-opacity-25 mt-1 object-fit-cover" width="32" height="32" alt="">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(optional($detail->borrowing->user)->name ?? 'Tidak Diketahui') }}&background=random" class="rounded-circle me-3 border border-secondary border-opacity-25 mt-1" width="32" height="32" alt="">
                            @endif
                            <div>
                                <div class="text-white fs-90 mb-1">{{ optional($detail->borrowing->user)->name ?? 'Tidak Diketahui' }}</div>
                                <div class=" fs-85 lh-sm max-w-250px">{{ optional($detail->borrowing)->address ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ optional($detail->book)->title ?? 'Buku Tidak Diketahui' }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ $detail->return_date ? $detail->return_date->format('M d, Y') : '-' }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-end py-4">
                        <div class="d-flex flex-column align-items-end gap-2">
                            @if($detail->status === 'returned')
                                <span class="badge border border-success text-success bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">DIKEMBALIKAN</span>
                            @elseif($detail->status === 'overdue')
                                <span class="badge border border-danger text-danger bg-transparent rounded-0 px-3 py-1 letter-spacing-1 fw-normal">TERLAMBAT</span>
                            @else
                                <span class="badge border border-warning text-warning bg-transparent badge-active rounded-0 px-3 py-1 letter-spacing-1 fw-normal">AKTIF</span>
                            @endif

                            @if($detail->status !== 'returned')
                            <form action="{{ route('admin.borrowings.return', $detail->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm rounded-0 letter-spacing-1" onclick="return confirm('Tandai buku ini sudah dikembalikan?');">
                                    <i class="fa-solid fa-check me-1"></i> TANDAI DIKEMBALIKAN
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center  py-5">Belum ada data peminjaman buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($details->hasPages())
    <div class="mt-5">
        {{ $details->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection

@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class="text-muted fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Sistem</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">DIREKTORI PENGGUNA</h2>
</div>

@if(session('success'))
    <div class="alert alert-success bg-dark-panel border-success border-opacity-25 text-success rounded-0 mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger bg-dark-panel border-danger border-opacity-25 text-danger rounded-0 mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="recent-activities-section bg-dark-panel p-4 p-md-5 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom border-secondary border-opacity-25 gap-3">
        <h4 class="mb-0 text-white fw-bold">Pengguna Terdaftar</h4>
        <div class="search-box position-relative w-full max-w-300px">
            <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 fs-08rem"></i>
            <input type="text" class="form-control bg-transparent border-secondary border-opacity-25 text-white ps-5 rounded-0 fs-85 letter-spacing-1" placeholder="CARI PENGGUNA...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Pengguna</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Email</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Peran</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85">Tanggal Bergabung</th>
                    <th class="text-uppercase fw-normal letter-spacing-1 pb-3 border-bottom border-secondary border-opacity-25 fs-85 text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="border-bottom border-secondary border-opacity-10 py-4">
                        <div class="d-flex align-items-center">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle me-3 border border-secondary border-opacity-25 object-fit-cover" width="32" height="32" alt="">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle me-3 border border-secondary border-opacity-25" width="32" height="32" alt="">
                            @endif
                            <span class="text-white fs-90">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ $user->email }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">
                        @if($user->hasRole('admin'))
                            <span class="badge bg-warning text-dark rounded-0 px-3 py-1 letter-spacing-1">ADMIN</span>
                        @else
                            <span class="badge bg-secondary text-light rounded-0 px-3 py-1 letter-spacing-1">USER</span>
                        @endif
                    </td>
                    <td class="border-bottom border-secondary border-opacity-10 text-light py-4 fs-90">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="border-bottom border-secondary border-opacity-10 text-end py-4">
                        @if(!$user->hasRole('admin'))
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-0 border-opacity-25 px-3 py-2">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">Belum ada pengguna yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-5">
        <div class="text-muted fs-85 text-uppercase letter-spacing-1">
            MENAMPILKAN {{ $users->firstItem() }} SAMPAI {{ $users->lastItem() }} DARI {{ $users->total() }} PENGGUNA
        </div>
        <div>
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>
@endsection

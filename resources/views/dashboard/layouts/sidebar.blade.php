
@hasrole('admin')
<aside class="sidebar">
    <a href="{{ route('landing')}}" class="sidebar-brand">PAGETURN</a>

    <div class="sidebar-category">SISTEM</div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i> DASHBOARD
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <i class="fa-solid fa-user-group"></i> PENGGUNA
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.borrowings.index') }}" class="sidebar-link {{ request()->routeIs('admin.borrowings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i> DETAIL PINJAMAN
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.books.index') }}" class="sidebar-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i> BUKU
            </a>
        </li>
    </ul>



     <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light rounded-pill px-4 py-2">Keluar</button>
                </form>
            </div>

    <a href="{{ route('profile.edit') }}" class="sidebar-footer text-decoration-none">
    @if(auth()->user()->avatar)
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="sidebar-avatar object-fit-cover">
    @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="{{ auth()->user()->name }}" class="sidebar-avatar">
    @endif
        <div class="sidebar-user-info">
            <span class="sidebar-user-name text-white">{{ auth()->user()->name }}</span>
            <span class="sidebar-user-role text-white-50">ADMIN UTAMA</span>
        </div>
    </a>
</aside>
@endhasrole



@hasrole('user')
<aside class="sidebar">
    <a href="{{ route('landing')}}" class="sidebar-brand">PAGETURN</a>

    <div class="sidebar-category">SISTEM</div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('user.dashboard') }}" class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i> RINGKASAN
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('user.borrowings.index') }}" class="sidebar-link {{ request()->routeIs('user.borrowings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-group"></i> PINJAMAN SAYA
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('user.catalog.index') }}" class="sidebar-link {{ request()->routeIs('user.catalog.*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i> KATALOG
            </a>
        </li>
    </ul>


     <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light rounded-pill px-4 py-2">Keluar</button>
                </form>
            </div>

    <a href="{{ route('profile.edit') }}" class="sidebar-footer text-decoration-none">
    @if(auth()->user()->avatar)
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="sidebar-avatar object-fit-cover">
    @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="{{ auth()->user()->name }}" class="sidebar-avatar">
    @endif
        <div class="sidebar-user-info">
            <span class="sidebar-user-name text-white">{{ auth()->user()->name }}</span>
            <span class="sidebar-user-role text-white-50">Peminjam</span>
        </div>
    </a>
</aside>
@endhasrole

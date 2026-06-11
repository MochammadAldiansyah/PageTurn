<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top pb-3 ">
  <div class="container">
    <a class="navbar-brand" href="{{ route('landing') }}">
        <img src="{{ asset('assets/img/navbar-brand.png') }}" alt="PageTurn Logo" height="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-link fs-5 mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="#hero">Beranda</a>
          </li>
        <li class="nav-item">
          <a class="nav-link "  href="#koleksi">Katalog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#fitur">Fitur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#testi">Testi</a>
        </li>
      </ul>
      <div>
        @auth
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="btn btn-login btn-light rounded-3 px-md-5 py-2 w-100 w-md-auto">DASHBOARD</a>
            @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-login btn-light rounded-3 px-md-5 py-2 w-100 w-md-auto">DASHBOARD</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-login btn-light rounded-3 px-md-5 py-2 w-100 w-md-auto">MASUK</a>
        @endauth
      </div>
    </div>

  </div>
</nav>



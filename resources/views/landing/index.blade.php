@extends('landing.layouts.app')

@section('content')
{{-- hero page --}}
<section id="hero" class="hero-section d-flex align-items-center justify-content-center text-white py-5 text-center position-relative">
    <div class="container">
        <h1 class="hero-title fw-bold mb-4">Ribuan Dunia dan Pengetahuan Baru,<br> Siap Kamu Pinjam Kapan Saja</h1>
        <p class="hero-description lead text-light mb-5 px-3 mx-auto">
            Akses koleksi buku terlengkap untuk menemani membaca dan belajar kamu.
        </p>
        <a href="{{ route('login') }}" class="btn btn-light fw-bold px-5 py-3 text-uppercase hero-btn-custom rounded-pill">MULAI MEMBACA</a>
    </div>
</section>

{{-- Stats Section --}}
<section class="stats-section py-5" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 stat-item border-end">
                <h2 class="display-4 fw-bold mb-1">10k+</h2>
                <p class="text-uppercase letter-spacing-1 mb-0">Pengguna Aktif</p>
            </div>
            <div class="col-md-4 stat-item border-end">
                <h2 class="display-4 fw-bold mb-1">50K+</h2>
                <p class="text-uppercase letter-spacing-1 mb-0">Buku Tersedia</p>
            </div>
            <div class="col-md-4 stat-item">
                <h2 class="display-4 fw-bold mb-1">24/7</h2>
                <p class="text-uppercase letter-spacing-1 mb-0">Akses Digital</p>
            </div>
        </div>
    </div>
</section>

{{-- Koleksi Unggulan --}}
<section id="koleksi" class="py-5" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex flex-column ">
                <div class="mb-5 pb-5">
                    <h2 class="fw-bold display-6 mb-0">Koleksi Unggulan</h2>
                </div>
                <div class="" id="koleksi-content">
                    <h4 class=" fs-4 fw-bold" id="koleksi-title">Stellar Drift</h4>
                    <p class="text-uppercase letter-spacing-1 mb-4" id="koleksi-author">Nova Sterling</p>
                    <p class="mb-5 text-secondary max-w-400 lh-16" id="koleksi-desc">Sebuah novel antariksa yang menggambarkan petualangan di dunia luar angkasa.</p>
                    <a href="#" class="btn btn-light text-dark fw-bold px-4 py-3 rounded-pill text-uppercase letter-spacing-1 fs-90">PINJAM SEKARANG</a>
                </div>
            </div>
            <div class="col-md-6 text-end pe-md-5">
                <img src="{{ asset('assets/img/buku2_mockup.png') }}" alt="Buku Koleksi Unggulan" id="koleksi-img" class="mt-5 img-fluid book-cover-img">
            </div>
        </div>
    </div>
</section>

{{-- Fitur Elit --}}
<section id="fitur" class="py-5" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <h3 class="fw-bold mb-5 fs-2">Fitur</h3>
        <div class="d-flex flex-column gap-4">
            <div class="card card-custom bg-dark-custom border-0  rounded text-white p-4" data-aos="fade-left" data-aos-delay="100">
                <div class="d-flex align-items-start">
                  <img src="{{ asset('assets/img/peminjaman_Icon.png') }}" alt="peminjaman icon" class="me-4 mt-1" width="24" height="24">
                    <div>
                        <h5 class="fw-bold fs-3">Peminjaman Instan</h5>
                        <hr class="border-bottom mb-3">
                        <p class="text-secondary mb-0">Pinjam Buku Favorit Anda Hanya Dalam Satu Klik Tanpa Perlu Mengantri Di Perpustakaan Fisik</p>
                    </div>
                </div>
            </div>
            <div class="card card-custom bg-dark-custom border-0 rounded text-white p-4" data-aos="fade-left" data-aos-delay="200">
                <div class="d-flex align-items-start">
                  <img src="{{ asset('assets/img/akses_Icon.png') }}" alt="akses digital icon" class="me-4 mt-1" width="24" height="24">
                    <div>
                        <h5 class="fw-bold fs-3">Akses Dimana Saja</h5>
                        <hr class="border-bottom mb-3">
                        <p class="text-secondary mb-0">Baca koleksi digital kami melalui smartphone, tablet, atau laptop kapan pun Anda inginkan.</p>
                    </div>
                </div>
            </div>
            <div class="card card-custom bg-dark-custom border-0 rounded text-white p-4" data-aos="fade-left" data-aos-delay="300">
                <div class="d-flex align-items-start">
                   <img src="{{ asset('assets/img/pengingat_Icon.png') }}" alt="pengingat icon" class="me-4 mt-1" width="24" height="24">
                    <div>
                        <h5 class="fw-bold fs-3">Pengingat Otomatis</h5>
                        <hr class="border-bottom mb-3">
                        <p class="text-secondary mb-0">Dapatkan pengingat otomatis tentang jadwal pengembalian buku yang Anda pinjam.</p>
                    </div>
                </div>
            </div>
            <div class="card card-custom bg-dark-custom border-0 rounded text-white p-4" data-aos="fade-left" data-aos-delay="400">
                <div class="d-flex align-items-start">
                  <img src="{{ asset('assets/img/Icon-peminjamn.png') }}" alt="buku baru icon" class="me-4 mt-1" width="24" height="24">
                    <div>
                        <h5 class="fw-bold fs-3">Buku Baru Setiap Minggu</h5>
                        <hr class="border-bottom mb-3">
                        <p class="text-secondary mb-0">Sistem secara otomatis akan menambahkan koleksi buku baru setiap minggu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Testimoni --}}
<section id="testi" class="testimoni-section py-5" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <h3 class="fw-bold mb-5 fs-2">Kata Mereka</h3>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-down" data-aos-delay="100">
                <div class="card card-custom bg-dark-custom border-0 rounded text-white p-4 h-100">
                    <p class="text-secondary mb-4 lh-16">"PageTurn mentransformasi tata kelola perpustakaan kami! Desainnya manis dan sistemnya lebih efisien dan modern di era digital ini."</p>
                    <div class="mt-auto">
                        <h6 class="fw-bold mb-1">Risa Maes</h6>
                        <small class=" text-uppercase fs-70 letter-spacing-1">Kepala Perpustakaan, SMAN 1 Cisarua</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-down" data-aos-delay="200">
                <div class="card card-custom bg-dark-custom border-0 rounded text-white p-4 h-100">
                    <p class="text-secondary mb-4 lh-16">"Sangat mudah dibuat untuk drag and drop dan otomatis! Denda-dendanya jelas dan terstruktur."</p>
                    <div class="mt-auto">
                        <h6 class="fw-bold mb-1">Mimin Seruni</h6>
                        <small class=" text-uppercase fs-70 letter-spacing-1">Administrasi Perpustakaan, SMAN 2 Nusantara</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-down" data-aos-delay="300">
                <div class="card card-custom bg-dark-custom border-0 rounded text-white p-4 h-100">
                    <p class="text-secondary mb-4 lh-16">"Terpilih, efisien dan sangat fungsional untuk mengorganisasi perpustakaan modern jaman now."</p>
                    <div class="mt-auto">
                        <h6 class="fw-bold mb-1">Coki Gunawan</h6>
                        <small class=" text-uppercase fs-70 letter-spacing-1">Pustakawan Sekolah</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class=" cta-section py-5 bg-white text-dark text-center">
    <div class="container py-5 my-md-4">
        <h2 class="cta-title fw-bold mb-5"  data-aos="fade-down" data-aos-duration="1000">Siap Memulai Petualangan <br>Membaca Anda?</h2>
        <a href="{{ route('login') }}" class="btn btn-dark fw-bold px-5 py-3 text-uppercase rounded-pill shadow-lg btn-cta-custom">DAFTAR SEKARANG</a>
    </div>
</section>



@endsection

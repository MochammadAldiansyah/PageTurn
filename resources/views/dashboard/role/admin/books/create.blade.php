@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard-header mb-5 mt-md-0 mt-4">
    <div class=" fs-85 letter-spacing-2 text-uppercase mb-1">Manajemen Perpustakaan</div>
    <h2 class="fw-bold text-white mb-0 display-6 font-oswald">TAMBAH BUKU BARU</h2>
</div>

<div class="bg-dark-panel p-4 p-md-5 mb-5">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Judul Buku</label>
                <input type="text" name="title" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-md-6">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Kategori</label>
                <select name="category_id" class="form-select bg-dark border-secondary border-opacity-25 text-white rounded-0 py-2 @error('category_id') is-invalid @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Penulis</label>
                <input type="text" name="author" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('author') is-invalid @enderror" value="{{ old('author') }}" required>
                @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Penerbit</label>
                <input type="text" name="publisher" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}">
                @error('publisher') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">ISBN</label>
                <input type="text" name="isbn" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}">
                @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Stok</label>
                <input type="number" name="stock" class="form-control bg-transparent border-secondary border-opacity-25 text-white rounded-0 py-2 @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label class=" fs-85 text-uppercase letter-spacing-1 mb-2">Cover Buku</label>
                <input type="file" name="cover_image" class="form-control bg-dark border-secondary border-opacity-25 text-light rounded-0 py-2 @error('cover_image') is-invalid @enderror" accept="image/*">
                <div class="form-text text-secondary fs-85 mt-2">Maksimal 2MB, format .jpg atau .png.</div>
                @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mt-5 d-flex gap-3">
            <button type="submit" class="btn btn-light rounded-0 px-5 py-2 letter-spacing-1 fw-bold">SIMPAN BUKU</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary rounded-0 px-4 py-2 letter-spacing-1">BATAL</a>
        </div>
    </form>
</div>
@endsection

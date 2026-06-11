# PageTurn 📚

PageTurn adalah sebuah aplikasi **Sistem Manajemen Perpustakaan (Library Management System)** berbasis web modern yang dibangun menggunakan framework Laravel. Aplikasi ini dirancang untuk mendigitalkan proses peminjaman buku, mempermudah manajemen perpustakaan bagi pengelola (Admin), serta memberikan pengalaman yang ramah pengguna bagi anggota perpustakaan (User).

Tujuan utama proyek ini adalah menyediakan platform yang terpusat di mana anggota dapat melihat katalog buku, meminjam buku secara *online*, dan admin dapat melacak ketersediaan buku, mengelola data anggota, serta memantau status pengembalian buku.

---

## 👥 Hak Akses & Fitur Aplikasi

Aplikasi ini menggunakan sistem *Role-Based Access Control* (RBAC) dengan dua peran utama: **Admin** dan **User**.

### 1. Fitur Admin (Pengelola Perpustakaan)
Admin memiliki hak akses penuh terhadap sistem manajemen perpustakaan.
- **Dashboard Admin:** Ringkasan statistik perpustakaan (misalnya jumlah buku, pengguna aktif, dan peminjaman yang sedang berlangsung).
- **Manajemen Pengguna (User Management):** Melihat daftar anggota yang terdaftar dan menghapus akun pengguna jika diperlukan.
- **Manajemen Buku (Library Management):** Mengelola katalog buku. Admin dapat menambah buku baru, mengedit informasi buku (judul, kategori, penulis, dll), dan menghapus buku dari sistem.
- **Pelacakan Peminjaman (Borrowing Tracking):** Memantau semua transaksi peminjaman buku oleh anggota. Admin juga berhak memperbarui status buku dari "Dipinjam" menjadi "Dikembalikan" setelah anggota mengembalikan buku fisiknya.

### 2. Fitur User (Anggota Perpustakaan)
User adalah anggota perpustakaan yang telah mendaftar di sistem.
- **Katalog Buku (Book Catalog):** Menelusuri daftar buku yang tersedia di perpustakaan.
- **Peminjaman Buku (Borrow Book):** Melakukan permohonan peminjaman buku langsung dari katalog.
- **Riwayat Peminjaman (Borrowing History):** Melihat status dan riwayat buku yang sedang atau pernah dipinjam.
- **Profil Pengguna:** Mengatur dan memperbarui informasi profil akun.

---

## 🔄 Alur Kerja Sistem (Workflow)

1. **Registrasi/Login:** Pengguna baru mendaftar atau login ke dalam sistem.
2. **Peminjaman:** Anggota (User) melihat Katalog dan memilih buku untuk dipinjam. Sistem akan mencatat detail peminjaman.
3. **Pengambilan Buku Fisik:** Anggota mengambil buku di perpustakaan.
4. **Pengembalian:** Anggota mengembalikan buku ke perpustakaan, lalu Admin akan memperbarui status di sistem (Mark as Returned).

---

## 🛠️ Teknologi yang Digunakan

Aplikasi ini dikembangkan dengan *tech stack* modern untuk memastikan performa, keamanan, dan UI/UX yang dinamis:
- **Backend:** [Laravel](https://laravel.com/) (Framework PHP yang kuat dan aman)
- **Frontend / Styling:** [Bootstrap](https://getbootstrap.com/) (Framework CSS populer untuk desain antarmuka responsif)
- **Interaktivitas UI:** JavaScript Vanilla / jQuery (Sesuai dengan komponen Bootstrap)
- **Otentikasi:** Sistem Autentikasi Laravel
- **Manajemen Hak Akses:** Spatie Laravel Permission
- **Sistem Login/Register:** Laravel breeze
- **Bundler:** Vite (Untuk proses kompilasi asset *frontend*)

---

## ⚙️ Panduan Instalasi (Development)

Ikuti panduan berikut untuk menjalankan proyek ini di *environment* lokal Anda:

### Persyaratan Sistem
- PHP 8.1 atau lebih baru
- Composer
- Node.js & NPM
- MySQL / SQLite / PostgreSQL

### Langkah-langkah

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/MochammadAldiansyah/PageTurn
   cd PageTurn
   ```

2. **Install dependensi PHP melalui Composer:**
   ```bash
   composer install
   ```

3. **Install dependensi Node.js (untuk Frontend asset):**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment:**
   Salin file template `.env` dan konfigurasikan koneksi database Anda:
   ```bash
   cp .env.example .env
   ```
   *Buka file `.env` di teks editor dan sesuaikan kredensial `DB_DATABASE`, `DB_USERNAME`, dll.*

5. **Generate Application Key Laravel:**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi Database:**
   *(Jika Anda memiliki Database Seeder untuk data awal, Anda dapat menambahkan bendera `--seed`)*
   ```bash
   php artisan migrate
   ```

7. **Jalankan Server Lokal & Asset Bundler:**
   Anda perlu membuka dua jendela terminal terpisah:
   ```bash
   # Terminal 1: Menjalankan server backend
   php artisan serve

   # Terminal 2: Menjalankan Vite untuk kompilasi Tailwind & JS
   npm run dev
   ```

8. **Akses Aplikasi:**
   Buka browser web Anda dan kunjungi `http://localhost:8000`.

---

## 📄 Lisensi

Proyek ini bersifat *open-source* dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

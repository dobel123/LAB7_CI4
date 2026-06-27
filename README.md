# Lab 7 Web - CodeIgniter 4 dan VueJS

Repository ini berisi pengerjaan praktikum Pemrograman Web 2 modul 1 sampai 14. Struktur dibuat mengikuti rangkaian modul: backend CodeIgniter 4 untuk halaman, CRUD, login, upload, AJAX, REST API, dan token auth; frontend VueJS untuk konsumsi API, routing, navigation guard, dan Axios interceptor.

## Struktur Folder

- `backend/` - file aplikasi CodeIgniter 4 yang ditempatkan ke project CI4.
- `frontend/` - aplikasi VueJS berbasis CDN.
- `database/lab_ci4.sql` - skema dan data awal MySQL.
- `screenshots/` - tempat menyimpan screenshot hasil praktikum.

## Modul 1 - PHP Framework CodeIgniter

Membuat controller `Page` untuk halaman Home, About, dan Contact. Semua link navigasi memakai layout yang sama lewat view template.

Jawaban tugas: semua menu pada navigasi header sudah diarahkan ke method controller masing-masing dan ditampilkan dengan layout yang sama.

## Modul 2 - CRUD Artikel

Membuat tabel `artikel`, model `ArtikelModel`, controller `Artikel`, halaman daftar artikel, detail, tambah, ubah, dan hapus. Slug dibuat otomatis dari judul.

## Modul 3 - View Layout dan View Cell

Layout utama memakai `renderSection('content')`. Komponen artikel terkini dibuat melalui class `ArtikelTerkini` dan view `components/artikel_terkini.php`.

Jawaban pertanyaan:
- Manfaat View Layout: struktur tampilan lebih konsisten, kode HTML tidak berulang, dan perubahan header/footer cukup dilakukan di satu file.
- Perbedaan View Cell dan view biasa: view biasa dipanggil langsung dari controller/layout, sedangkan View Cell adalah komponen kecil yang punya logic sendiri dan bisa dipakai ulang.
- View Cell sudah mendukung filter kategori lewat parameter `kategori_id`.

## Modul 4 - Login

Membuat model user, controller login/logout, filter autentikasi, dan proteksi route admin.

Akun awal pada SQL:
- Email: `admin@example.com`
- Password: `admin123`

## Modul 5 - Pagination dan Pencarian

Halaman admin artikel mendukung pencarian berdasarkan keyword dan pagination menggunakan fitur model CodeIgniter.

## Modul 6 - Relasi Tabel dan Query Builder

Menambahkan tabel `kategori`, field `id_kategori` pada artikel, join kategori pada query artikel, dan nama kategori pada halaman detail.

## Modul 7 - Upload File Gambar

Form tambah/ubah artikel mendukung upload gambar. File gambar disimpan ke `public/gambar/`, sedangkan nama file disimpan pada kolom `gambar`.

## Modul 8 - AJAX

Endpoint API artikel disediakan untuk kebutuhan AJAX. Frontend dapat menambah, mengubah, dan menghapus data tanpa reload penuh.

## Modul 9 - AJAX Pagination dan Search

Endpoint API menerima parameter `q`, `sort`, `page`, dan `perPage`. Frontend Vue menampilkan indikator loading, pencarian, sorting, dan pagination.

## Modul 10 - API

Membuat REST API `Api/Artikel` untuk operasi `GET /post`, `GET /post/{id}`, `POST /post`, `PUT /post/{id}`, dan `DELETE /post/{id}`.

## Modul 11 - VueJS

Frontend VueJS dibuat di `frontend/` menggunakan CDN Vue 3 dan Axios. Aplikasi menampilkan daftar artikel dari API serta menyediakan form tambah/ubah/hapus.

## Modul 12 - VueJS Komponen dan Routing

Menambahkan Vue Router dan komponen `Home.js`, `Artikel.js`, `About.js`, dan `Login.js`. Route `/about` tersedia dan menampilkan profil singkat. Nama/NIM/Kelas masih placeholder dan bisa diganti di `frontend/assets/js/components/About.js`.

## Modul 13 - Autentikasi dan Navigation Guards

Backend menyediakan endpoint login API di `Api/Auth`. Frontend menyimpan status login dan token di `localStorage`. Route `/artikel` dan `/about` diproteksi dengan `meta: { requiresAuth: true }`.

## Modul 14 - Token Auth dan Axios Interceptors

Backend memiliki `ApiAuthFilter` untuk memeriksa header `Authorization: Bearer <token>`. Frontend memiliki Axios interceptor yang otomatis menambahkan token ke setiap request API.

Kesimpulan:
- Vue Router Navigation Guards melindungi perpindahan halaman di sisi browser, sehingga cocok untuk UX dan pembatasan tampilan.
- CodeIgniter Filters melindungi endpoint di sisi server, sehingga request ilegal dari Postman/Insomnia tetap ditolak.
- Keduanya perlu dipakai bersama agar aplikasi nyaman digunakan sekaligus aman.

## Cara Pakai

1. Buat project CodeIgniter 4.
2. Salin isi folder `backend/` ke root project CI4.
3. Import `database/lab_ci4.sql` ke MySQL.
4. Atur koneksi database pada `.env` CI4.
5. Jalankan backend dan pastikan endpoint API dapat diakses.
6. Buka `frontend/index.html` melalui web server lokal.

## Catatan Screenshot

Modul meminta screenshot setiap langkah. Folder `screenshots/` sudah disiapkan, tetapi screenshot harus diambil dari komputer setelah aplikasi dijalankan di XAMPP/browser.

# Dokumentasi & Panduan Praktikum Pemrograman Web II
### Program Studi Teknik Komputer &bull; Fakultas Teknik &bull; Universitas Jenderal Soedirman

**Identitas Praktikan:**
- **Nama:** Afif Nur Rahman
- **NIM:** H1H024016
- **Program Studi:** S1 Teknik Komputer
- **Tahun Akademik:** 2026/2027
- **Repositori GitHub:** [https://github.com/apipippp/H1H024016-Apip-Pemweb2](https://github.com/apipippp/H1H024016-Apip-Pemweb2)

---

## Daftar Isi
- [Modul 1: Penyiapan Lingkungan Pengembangan Web Modern](#-modul-1-penyiapan-lingkungan-pengembangan-web-modern)
  - [1. Prasyarat & Verifikasi](#1-prasyarat-perangkat-lunak--verifikasi)
  - [2. Proyek Laravel 13](#2-proyek-laravel-13)
  - [3. Proyek Go Fiber v3](#3-proyek-go-fiber-v3)
  - [4. Tugas Mandiri Modul 1](#4-tugas-mandiri-modul-1)
  - [5. Jawaban Pembahasan Modul 1](#5-jawaban-pembahasan-modul-1)
- [Modul 2: Fondasi Laravel 13: Routing, Controller, dan Blade](#-modul-2-fondasi-laravel-13-routing-controller-dan-blade)
  - [1. Ringkasan Teori](#1-ringkasan-teori-modul-2)
  - [2. Langkah Praktikum](#2-langkah-praktikum-modul-2)
  - [3. Tugas Praktikum Mandiri (Matakuliah)](#3-tugas-praktikum-mandiri-modul-2)
  - [4. Jawaban Pembahasan Modul 2](#4-jawaban-pertanyaan-pembahasan-modul-2)
- [Modul 3: Basis Data, Migration, dan Eloquent ORM](#-modul-3-basis-data-migration-dan-eloquent-orm)
  - [1. Ringkasan Teori](#1-ringkasan-teori-modul-3)
  - [2. Langkah Praktikum](#2-langkah-praktikum-modul-3)
  - [3. Tugas Praktikum Mandiri](#3-tugas-praktikum-mandiri-modul-3)
  - [4. Jawaban Pembahasan Modul 3](#4-jawaban-pertanyaan-pembahasan-modul-3)

---

# 📦 MODUL 1: Penyiapan Lingkungan Pengembangan Web Modern

### 1. Prasyarat Perangkat Lunak & Verifikasi
- **PHP 8.4+:** `php --version`
- **Composer 2.7+:** `composer --version`
- **Go 1.23+:** `go version`
- **Ekstensi PHP Wajib:** `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`, `curl`, `fileinfo` (diperiksa via `php -m`).

### 2. Proyek Laravel 13 (`latihan-laravel`)
1. Inisialisasi:
   ```powershell
   composer create-project laravel/laravel:^13.0 latihan-laravel
   ```
2. Konfigurasi `.env` untuk session berbasis file:
   ```env
   SESSION_DRIVER=file
   CACHE_STORE=file
   ```
3. Menjalankan server:
   ```powershell
   php artisan serve
   ```
   Akses di: `http://127.0.0.1:8000`

### 3. Proyek Go Fiber v3 (`latihan-fiber`)
1. Inisialisasi modul & pasang dependensi:
   ```powershell
   mkdir latihan-fiber && cd latihan-fiber
   go mod init latihan-fiber
   go get github.com/gofiber/fiber/v3
   ```
2. Berkas `main.go` memuat endpoint root (`/`), `/api/info`, dan `/api/mahasiswa`.
3. Menjalankan server:
   ```powershell
   go run main.go
   ```
   Akses di: `http://localhost:3000`

### 4. Tugas Mandiri Modul 1
- **Tugas 1 (Fiber):** Endpoint `GET /api/mahasiswa` mengembalikan JSON identitas praktikan:
  ```json
  {"nama":"Afif Nur Rahman","nim":"H1H024016","program_studi":"Teknik Komputer"}
  ```
- **Tugas 2 (Laravel):** Halaman depan `resources/views/welcome.blade.php` diperbarui dengan identitas lengkap (Nama & NIM) serta status lingkungan runtime.
- **Tugas 3 (Git):** Mengunggah kedua proyek ke repositori GitHub.
- **Tugas 4 (Tabel Perbandingan Laravel vs Fiber):**

| No | Aspek | Laravel 13 (PHP) | Fiber v3 (Go) |
|---|---|---|---|
| 1 | **Bahasa & Paradigma** | PHP (Interpreted, OOP dinamis, full-stack MVC). | Go / Golang (Compiled, statically typed, concurrent). |
| 2 | **Filosofi & Fitur** | *Batteries-included*: ORM Eloquent, Blade, auth, migration. | *Microframework*: Minimalis, routing cepat di atas `fasthttp`. |
| 3 | **Ukuran Dependensi** | Besar (folder `vendor/` ratusan MB). | Sangat Ringan (hanya pustaka inti yang dibutuhkan). |
| 4 | **Model Runtime** | Butuh PHP Runtime (interpreter/server perantara). | Menghasilkan **single binary executable** mandiri. |
| 5 | **Kecepatan Startup** | Butuh inisialisasi provider (puluhan milidetik). | Instan (mikrodetik) dengan RPS sangat tinggi. |
| 6 | **Manajer Paket** | `composer.json` & `composer.lock`. | `go.mod` & `go.sum`. |

### 5. Jawaban Pembahasan Modul 1
1. **Penyebab folder `vendor` dan file `.exe` tidak masuk Git:**
   - Mencegah pembengkakan ukuran repositori (*repository bloat*).
   - Dependensi dapat direkonstruksi ulang secara presisi melalui `composer.json` / `go.mod`.
   - Berkas biner Go spesifik sistem operasi (*platform-dependent*).
2. **Fungsi `composer.json` vs `go.mod`:**
   - Keduanya adalah manifes dependensi deklaratif yang mengadopsi standar SemVer dan memiliki file pengunci hash deterministik (`composer.lock` dan `go.sum`).
3. **Perbedaan Port 8000 vs 3000:**
   - Port 8000 adalah PHP CLI built-in development web server (single-threaded, dev only).
   - Port 3000 adalah native web server mandiri aplikasi Go berbasis `fasthttp` yang memanfaatkan goroutine.

---

# 🚀 MODUL 2: Fondasi Laravel 13: Routing, Controller, dan Blade

### 1. Ringkasan Teori Modul 2
- **Alur Permintaan HTTP Laravel:**
  `Peramban` &rarr; `public/index.php` (Front Controller) &rarr; `bootstrap/app.php` &rarr; `Middleware Global` &rarr; `Router` &rarr; `Middleware Rute` &rarr; `Controller` &rarr; `Response / View` &rarr; `Peramban`.
- **Pola MVC (Model-View-Controller):**
  - **Model:** Representasi data & aturan bisnis.
  - **View:** Penyusun antarmuka tampilan untuk pengguna.
  - **Controller:** Penerima permintaan, pemroses logika, dan pemilih tampilan view.
- **Blade Template Engine:** Template engine bawaan Laravel berekstensi `.blade.php` yang dikompilasi menjadi PHP biasa tanpa beban performa.

### 2. Langkah Praktikum Modul 2
- **Langkah 1 & 2:** Rute dasar (`/salam`), rute parameter (`/mahasiswa/{nim}`), dan validasi angka (`whereNumber('angka')`).
- **Langkah 3 s/d 6:** Pembuatan `MahasiswaController` dengan method `index()` dan `show()`.
- **Langkah 7 s/d 9:** Layout utama `layouts/app.blade.php` berbasis Bootstrap dan view mahasiswa.
- **Langkah 10 & 11:** Pembacaan query string via `$request->query()` dan komponen Blade `<x-kartu-info>`.

### 3. Tugas Praktikum Mandiri Modul 2
- **MatakuliahController:** Menyediakan array 5 mata kuliah beserta method `index` (dengan filter pencarian query string `?q=`) dan `show`.
- **Komponen Blade `<x-badge-sks>`:** Menampilkan badge warna hijau untuk SKS &ge; 3 (`bg-success`) dan abu-abu untuk SKS < 3 (`bg-secondary`).
- **View Matakuliah:** Halaman daftar lengkap dengan form pencarian dan halaman detail matakuliah.

### 4. Jawaban Pembahasan Modul 2
1. **Keuntungan Nama Rute (*Named Routes*):** Fleksibilitas refactoring URL secara terpusat, kemudahan penanganan parameter dinamis, dan deteksi dini galat saat rendering.
2. **Perbedaan `{{ }}` dan `{!! !!}`:** `{{ }}` melakukan escaping otomatis via `htmlspecialchars` untuk mencegah serangan XSS. `{!! !!}` mencetak output mentah tanpa sanitasi sehingga rentan XSS.
3. **Alasan Logika Tidak di Berkas Rute:** Menjaga prinsip Separation of Concerns (MVC), mendukung fitur optimasi `php artisan route:cache`, serta menjaga kemudahan pengujian dan pemeliharaan kode.

---

# 🗄️ MODUL 3: Basis Data, Migration, dan Eloquent ORM

### 1. Ringkasan Teori Modul 3
- **ORM (Object Relational Mapping):** Memetakan tabel database menjadi objek PHP (Eloquent), memungkinkan penulisan query berorientasi objek yang lebih aman dari SQL Injection.
- **Migration:** Manajemen skema database berbasis kode (version control untuk database) sehingga struktur tabel seragam di seluruh tim.
- **Relasi Database:**
  - *One to Many:* Program Studi memiliki banyak Mahasiswa (`hasMany` & `belongsTo`).
  - *Many to Many:* Mahasiswa mengambil banyak Mata Kuliah melalui tabel pivot `mahasiswa_matakuliah` (`belongsToMany`).
- **Seeder & Factory:** Mengisi data awal master dan menghasilkan data uji (*dummy data*) secara otomatis.

---

### 2. Langkah Praktikum Modul 3

#### Langkah 1 & 2: Setup Database & Koneksi `.env`
1. Membuat database di MySQL:
   ```sql
   CREATE DATABASE pemweb2_praktikum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. Konfigurasi pada `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pemweb2_praktikum
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Uji koneksi: `php artisan db:show`

#### Langkah 3 s/d 5: Migration `program_studis` dan `mahasiswas`
- Tabel `program_studis`: `id`, `kode` (unique), `nama`, `jenjang`, `timestamps`.
- Tabel `mahasiswas`: `id`, `program_studi_id` (FK cascade), `nim` (unique), `nama`, `email` (unique), `angkatan`, `ipk`, `aktif`, `timestamps`.
- Eksekusi: `php artisan migrate`

#### Langkah 6 s/d 9: Model, Factory, Seeder, dan Tinker
- Model `ProgramStudi` (`app/Models/ProgramStudi.php`) dengan relasi `hasMany(Mahasiswa::class)`.
- Model `Mahasiswa` (`app/Models/Mahasiswa.php`) dengan relasi `belongsTo(ProgramStudi::class)` dan trait `HasFactory`.
- Factory `MahasiswaFactory` menghasilkan data dummy acak menggunakan `fake()`.
- Seeder `ProgramStudiSeeder` dan `DatabaseSeeder` mengisi 3 program studi dan 30 data mahasiswa dummy.
- Eksekusi:
  ```powershell
  php artisan migrate:fresh --seed
  ```
- Pengujian query melalui `php artisan tinker`.

#### Langkah 10 s/d 12: Controller Resource, Pagination, dan Masalah N+1
- Controller: `MahasiswaWebController` dengan method `index()` menggunakan `paginate(10)`.
- Konfigurasi pagination Bootstrap di `AppServiceProvider.php`:
  ```php
  Paginator::useBootstrapFive();
  ```
- View: `resources/views/mahasiswa/data.blade.php` menampilkan tabel berpaginasi.
- **Pengamatan Masalah N+1:** Penggunaan `Mahasiswa::with('programStudi')` (*Eager Loading*) hanya menghasilkan 2 kueri SQL di `storage/logs/laravel.log`, terhindar dari pemborosan kueri (*Lazy Loading N+1*).

---

### 3. Tugas Praktikum Mandiri Modul 3

#### 1. Tabel, Model, dan Seeder Matakuliah
- **Migration:** `create_matakuliahs_table` memuat kolom `kode`, `nama`, `sks`, dan `semester`.
- **Model:** `app/Models/Matakuliah.php`.
- **Seeder:** `MatakuliahSeeder.php` mengisi data 5 mata kuliah.

#### 2. Relasi Many to Many via Tabel Pivot
- **Migration Pivot:** `create_mahasiswa_matakuliah_table` memuat `mahasiswa_id`, `matakuliah_id`, dan kolom tambahan **`nilai`**.
- **Definisi Relasi:**
  - Pada `Mahasiswa.php`:
    ```php
    public function matakuliah(): BelongsToMany
    {
        return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah')
                    ->withPivot('nilai')
                    ->withTimestamps();
    }
    ```
  - Pada `Matakuliah.php`:
    ```php
    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah')
                    ->withPivot('nilai')
                    ->withTimestamps();
    }
    ```
- **Seeder Pivot:** Mengaitkan 2–4 mata kuliah beserta nilai acak (`A`, `AB`, `B`, `BC`, `C`) ke setiap mahasiswa.

#### 3. Tampilan Halaman Detail Mahasiswa & Nilai Matakuliah
- **Controller:** Method `show($id)` di `MahasiswaWebController`:
  ```php
  $mahasiswa = Mahasiswa::with(['programStudi', 'matakuliah'])->findOrFail($id);
  ```
- **Rute:** `/mahasiswa-data/{id}`
- **View:** `resources/views/mahasiswa/detail.blade.php` menampilkan kartu informasi mahasiswa dan tabel mata kuliah yang diambil beserta nilai huruf dari kolom pivot (`$mk->pivot->nilai`).

#### 4. Kueri Eloquent Top 10 Mahasiswa Teknik Komputer (IPK Tertinggi)
- **Kueri Eloquent:**
  ```php
  $topMahasiswa = Mahasiswa::whereHas('programStudi', function ($q) {
      $q->where('nama', 'Teknik Komputer');
  })
  ->orderBy('ipk', 'desc')
  ->take(10)
  ->get();
  ```
- **Tampilan Web:** Diakses melalui rute `/mahasiswa-top` pada berkas view `resources/views/mahasiswa/top.blade.php`.

---

### 4. Jawaban Pertanyaan Pembahasan Modul 3

#### 1. Fungsi Properti `$fillable` dan Risiko Jika Diabaikan:
- **Fungsi:** Bekerja sebagai *whitelist* untuk menentukan kolom mana saja yang diizinkan untuk diisi secara massal (*Mass Assignment*) melalui method seperti `Model::create($data)` atau `$model->update($data)`.
- **Risiko Jika Diabaikan:** Aplikasi rentan terhadap serangan **Mass Assignment Injection**. Pengguna jahat dapat memanipulasi payload HTTP dengan menyisipkan field terlarang seperti `is_admin = 1` atau `role = 'admin'` (*Privilege Escalation*). Secara default, jika `$fillable` tidak didefinisikan, Laravel akan melempar galat `MassAssignmentException`.

#### 2. Perbedaan `migrate:fresh`, `migrate:refresh`, dan `migrate:rollback`:
- **`migrate:rollback`:** Membatalkan (*revert*) batch migrasi terakhir dengan mengeksekusi method `down()`.
- **`migrate:refresh`:** Membatalkan seluruh migrasi dari awal menggunakan method `down()`, lalu mengeksekusi ulang seluruh method `up()`.
- **`migrate:fresh`:** Menghapus seluruh tabel secara paksa (*DROP ALL TABLES*) tanpa menjalankan method `down()`, lalu menjalankan seluruh migrasi dari awal (`up()`). Sangat bersih dan cepat untuk kebutuhan reset database lokal.

#### 3. Masalah N Plus 1 dan Cara Mengatasinya:
- **Masalah:** Terjadi saat relasi dipanggil secara lambat (*Lazy Loading*) di dalam perulangan. 1 kueri awal dijalankan untuk mengambil data induk (misal 10 mahasiswa), dan $N$ kueri tambahan (10 kali) dijalankan untuk mengambil relasi masing-masing mahasiswa. Total kueri menjadi $1 + 10 = 11$ kueri.
- **Pengamatan Langkah 12:** Saat menggunakan Eager Loading `Mahasiswa::with('programStudi')`, Laravel hanya menjalankan **2 kueri SQL** (satu kueri mahasiswa dan satu kueri `WHERE in` untuk seluruh program studi terkait).
- **Solusi:** Selalu gunakan **Eager Loading** via klausa `with(['namaRelasi'])` ketika mengambil data relasi yang akan ditampilkan berulang.

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

---

### 2. Langkah Praktikum Modul 2

#### Langkah 1: Rute Dasar
Menambahkan rute teks langsung pada [routes/web.php](file:///c:/laragon/www/KULIAHHH/SEMESTER%205/PRAK.%20PEMWEB%20II/pemweb2/latihan-laravel/routes/web.php):
```php
Route::get('/salam', function () {
    return 'Selamat datang di Pemrograman Web II';
});
```
*Uji:* `http://127.0.0.1:8000/salam`

#### Langkah 2 & 3: Rute dengan Parameter & Validasi Format
```php
// Rute dengan parameter wajib:
Route::get('/mahasiswa/{nim}', function (string $nim) {
    return 'Data mahasiswa dengan NIM ' . $nim;
});

// Pembatasan parameter angka (regex whereNumber):
Route::get('/semester/{angka}', function (int $angka) {
    return 'Semester ke ' . $angka;
})->whereNumber('angka');
```
*Uji:* `http://127.0.0.1:8000/mahasiswa/H1A123456` dan `http://127.0.0.1:8000/semester/5` (jika diisi huruf akan menghasilkan 404).

#### Langkah 4: Melihat Daftar Rute
```powershell
php artisan route:list
```

#### Langkah 5 & 6: Membuat MahasiswaController & Routing
Membuat controller:
```powershell
php artisan make:controller MahasiswaController
```
Menambahkan method `index()` dan `show()` di `app/Http/Controllers/MahasiswaController.php`, lalu menghubungkan rute di `routes/web.php`:
```php
use App\Http\Controllers\MahasiswaController;

Route::get('/data-mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/data-mahasiswa/{nim}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
```

#### Langkah 7: Membuat Layout Blade (`layouts/app.blade.php`)
Membuat berkas `resources/views/layouts/app.blade.php` sebagai kerangka utama halaman berbasis Bootstrap 5.

#### Langkah 8 & 9: View Daftar & Detail Mahasiswa
- `resources/views/mahasiswa/index.blade.php`: Menampilkan tabel mahasiswa menggunakan direktif `@forelse`.
- `resources/views/mahasiswa/show.blade.php`: Menampilkan kartu detail NIM mahasiswa terpilih.

#### Langkah 10: Membaca Data dari Request (Query String)
Method `cari(Request $request)` di `MahasiswaController`:
```php
public function cari(Request $request)
{
    $kataKunci = $request->query('q', '');
    return response()->json([
        'kata_kunci' => $kataKunci,
        'metode' => $request->method(),
        'path' => $request->path(),
    ]);
}
```
*Uji:* `http://127.0.0.1:8000/cari-mahasiswa?q=andi`

#### Langkah 11: Membuat Komponen Blade `KartuInfo`
1. Generate komponen:
   ```powershell
   php artisan make:component KartuInfo
   ```
2. Konstruktor di `app/View/Components/KartuInfo.php`:
   ```php
   public function __construct(public string $judul) {}
   ```
3. Tampilan di `resources/views/components/kartu-info.blade.php`:
   ```html
   <div class="card mb-3">
       <div class="card-header">{{ $judul }}</div>
       <div class="card-body">{{ $slot }}</div>
   </div>
   ```
4. Digunakan di `resources/views/mahasiswa/index.blade.php`:
   ```html
   <x-kartu-info judul="Informasi">
       Data pada halaman ini masih berupa array statis. Pada modul berikutnya data akan diambil dari basis data.
   </x-kartu-info>
   ```

---

### 3. Tugas Praktikum Mandiri Modul 2

#### 1. MatakuliahController (`app/Http/Controllers/MatakuliahController.php`)
Menyediakan data array 5 mata kuliah beserta method `index` (dengan pencarian) dan `show`:
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    private array $dataMatakuliah = [
        ['kode' => 'TK2101', 'nama' => 'Pemrograman Web II', 'sks' => 3, 'semester' => 5],
        ['kode' => 'TK2102', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3],
        ['kode' => 'TK2103', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 5],
        ['kode' => 'TK2104', 'nama' => 'Praktikum Jaringan Komputer', 'sks' => 1, 'semester' => 5],
        ['kode' => 'TK2105', 'nama' => 'Bahasa Inggris Teknik', 'sks' => 2, 'semester' => 1],
    ];

    public function index(Request $request)
    {
        $daftarMatakuliah = $this->dataMatakuliah;
        $kataKunci = $request->query('q', '');

        if (!empty($kataKunci)) {
            $daftarMatakuliah = array_filter($daftarMatakuliah, function ($mk) use ($kataKunci) {
                return stripos($mk['nama'], $kataKunci) !== false || stripos($mk['kode'], $kataKunci) !== false;
            });
        }

        return view('matakuliah.index', [
            'daftarMatakuliah' => $daftarMatakuliah,
            'kataKunci' => $kataKunci,
        ]);
    }

    public function show(string $kode)
    {
        $matakuliah = collect($this->dataMatakuliah)->firstWhere('kode', $kode);
        return view('matakuliah.show', compact('kode', 'matakuliah'));
    }
}
```

#### 2. Komponen Blade `badge-sks` (`resources/views/components/badge-sks.blade.php`)
Menampilkan badge warna berbeda berdasarkan jumlah SKS:
```html
@if ($sks >= 3)
    <span class="badge bg-success">{{ $sks }} SKS</span>
@else
    <span class="badge bg-secondary">{{ $sks }} SKS</span>
@endif
```

#### 3. View Daftar & Pencarian (`resources/views/matakuliah/index.blade.php`)
- Mewarisi `layouts.app`.
- Memiliki form pencarian `<form method="GET">` dengan input `name="q"`.
- Menggunakan komponen `<x-badge-sks :sks="$mk['sks']" />`.
- Tautan tombol aksi Detail menuju rute `route('matakuliah.show', $mk['kode'])`.

#### 4. View Detail (`resources/views/matakuliah/show.blade.php`)
- Menampilkan kartu rincian Kode, Nama, Bobot SKS, dan Semester.
- Tombol navigasi kembali ke daftar mata kuliah.

---

### 4. Jawaban Pertanyaan Pembahasan Modul 2

#### 1. Keuntungan Penggunaan Nama Rute (*Named Routes*):
- **Decoupling (Fleksibilitas Refactoring):** Jika pola URL diubah di `routes/web.php`, tautan di seluruh view Blade yang menggunakan `route('nama.rute')` otomatis mengikuti tanpa perlu pengubahan manual.
- **Parameter Handling:** Helper `route()` otomatis mengelola URL-encoding dan pemetaan parameter dinamis (`route('matakuliah.show', $kode)`).
- **Deteksi Dini Kesalahan:** Menghasilkan error `RouteNotFoundException` saat kompilasi/render jika nama rute salah ketik, mencegah munculnya broken link (404) di production.

#### 2. Perbedaan `{{ }}` dan `{!! !!}` pada Blade serta Implikasi Keamanannya:
- **`{{ $var }}` (Escaped Output):** Melewatkan variabel ke fungsi `htmlspecialchars()`. Karakter HTML (`<`, `>`, `&`, `"`) diubah menjadi entitas aman. **Melindungi dari celah keamanan Cross-Site Scripting (XSS)**.
- **`{!! $var !!}` (Raw/Unescaped Output):** Mencetak data mentah apa adanya. **Berisiko tinggi terhadap XSS** jika data berasal dari input pengguna tanpa sanitasi. Hanya boleh digunakan untuk konten HTML terpercaya (misal hasil parser Markdown atau editor WYSIWYG yang sudah dibersihkan).

#### 3. Alasan Logika Pengambilan Data Tidak Boleh Diletakkan Langsung di Berkas Rute:
- **Pola MVC & Separation of Concerns:** Berkas rute hanya bertugas sebagai pengarah (*dispatcher*). Logika bisnis dan data harus berada di lapisan Controller dan Model.
- **Dukungan *Route Caching*:** Perintah optimasi produksi `php artisan route:cache` **akan gagal** jika terdapat rute yang menggunakan fungsi anonim (*closure*).
- **Maintainability & Clean Code:** Mencegah `web.php` menjadi *spaghetti code* yang sulit dibaca dan dirawat.
- **Testability & Reusability:** Method pada Controller dapat diuji dengan mudah melalui unit/feature test dan dapat digunakan kembali oleh komponen lain.

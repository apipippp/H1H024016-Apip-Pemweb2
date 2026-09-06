# Panduan Lengkap Tutorial Mandiri: Modul 1 Praktikum Pemrograman Web II
### Penyiapan Lingkungan Pengembangan Web Modern (Laravel 13 & Go Fiber v3)

**Data Praktikan:**
- **Nama:** Afif Nur Rahman
- **NIM:** H1H024016
- **Program Studi:** S1 Teknik Komputer
- **Perguruan Tinggi:** Universitas Jenderal Soedirman
- **Tahun Akademik:** 2026/2027

---

## Daftar Isi
1. [Prasyarat Perangkat Lunak](#1-prasyarat-perangkat-lunak)
2. [Langkah 1: Verifikasi PHP dan Composer](#langkah-1-verifikasi-php-dan-composer)
3. [Langkah 2: Verifikasi Toolchain Go](#langkah-2-verifikasi-toolchain-go)
4. [Langkah 3: Membuat Proyek Laravel 13](#langkah-3-membuat-proyek-laravel-13)
5. [Langkah 4: Memahami Struktur Folder Laravel 13](#langkah-4-memahami-struktur-folder-laravel-13)
6. [Langkah 5: Membuat Proyek Go Fiber v3](#langkah-5-membuat-proyek-go-fiber-v3)
7. [Langkah 6 & 7: Menulis Server Fiber & Endpoint JSON](#langkah-6--7-menulis-server-fiber--endpoint-json)
8. [Langkah 8: Pengujian Endpoint HTTP](#langkah-8-pengujian-endpoint-http)
9. [Langkah 9: Inisialisasi Repositori Git](#langkah-9-inisialisasi-repositori-git)
10. [Penyelesaian Tugas Mandiri (Tugas 1 - 4)](#penyelesaian-tugas-mandiri)
11. [Jawaban Pertanyaan Pembahasan (F.1 - F.3)](#jawaban-pertanyaan-pembahasan)
12. [Tips Troubleshooting & Galat Umum](#tips-troubleshooting--galat-umum)

---

## 1. Prasyarat Perangkat Lunak

Pastikan perangkat lunak berikut telah terpasang di komputer/laptop Anda:
- **Laragon** (atau stack PHP 8.4+ mandiri)
- **Composer** (versi minimal 2.7+)
- **Go / Golang** (versi minimal 1.23+)
- **Git** (versi minimal 2.40+)
- **Visual Studio Code** (Editor Kode)
- **Browser** (Google Chrome / Edge / Firefox) atau REST client seperti **Postman / Bruno / cURL**

---

## Langkah 1: Verifikasi PHP dan Composer

Buka terminal (**PowerShell** atau **Git Bash**), lalu jalankan perintah berikut untuk memeriksa versi:

```powershell
php --version
composer --version
```
*Pastikan versi PHP yang muncul minimal 8.4.*

Selanjutnya, periksa ekstensi PHP yang dibutuhkan oleh framework Laravel:
```powershell
php -m
```
*Pastikan modul-modul berikut ada dalam daftar output:*
- `mbstring`
- `openssl`
- `pdo_mysql`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `curl`
- `fileinfo`

---

## Langkah 2: Verifikasi Toolchain Go

Periksa instalasi bahasa Go dengan menjalankan perintah:
```powershell
go version
```
*Pastikan versi yang muncul minimal `go1.23`.*

Periksa lokasi workspace global Go (`GOPATH`):
```powershell
go env GOPATH
```
*(Contoh output: `C:\Users\<username>\go`)*

---

## Langkah 3: Membuat Proyek Laravel 13

1. **Buat dan masuk ke folder kerja praktikum:**
   ```powershell
   mkdir pemweb2
   cd pemweb2
   ```

2. **Buat proyek baru Laravel 13 menggunakan Composer:**
   ```powershell
   composer create-project laravel/laravel:^13.0 latihan-laravel
   ```
   *Tunggu beberapa menit hingga proses unduhan dependensi dan pembuatan file selesai.*

3. **Masuk ke folder proyek Laravel:**
   ```powershell
   cd latihan-laravel
   ```

4. **Penyesuaian Konfigurasi Database & Session (`.env`):**
   Buka berkas `.env` pada folder `latihan-laravel`. Secara default Laravel menggunakan driver sqlite. Jika ekstensi pdo_sqlite belum aktif di Laragon Anda, ubah bagian session dan cache menjadi `file` agar aplikasi langsung berjalan tanpa kendala database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pemweb2
   DB_USERNAME=root
   DB_PASSWORD=

   SESSION_DRIVER=file
   CACHE_STORE=file
   ```

5. **Jalankan server pengembangan Laravel:**
   ```powershell
   php artisan serve
   ```
   Buka browser dan akses alamat:
   [http://127.0.0.1:8000](http://127.0.0.1:8000)
   *(Tekan `Ctrl + C` di terminal jika ingin menghentikan server).*

---

## Langkah 4: Memahami Struktur Folder Laravel 13

Sejak Laravel 11 hingga Laravel 13, struktur direktori disederhanakan:
- **`app/Http/Controllers/`** : Berisi kelas pengendali logika permintaan (*Controller*).
- **`app/Models/`** : Berisi kelas model data Eloquent ORM.
- **`bootstrap/app.php`** : Konfigurasi routing, middleware, dan exception. *(Catatan penting: Berkas `app/Http/Kernel.php` sudah ditiadakan)*.
- **`config/`** : Kumpulan berkas konfigurasi aplikasi.
- **`database/migrations/`** : Skrip skema perubahan struktur tabel basis data.
- **`routes/web.php`** : Tempat mendaftarkan rute web aplikasi.
- **`resources/views/`** : Berkas tampilan berbasis template engine Blade (`.blade.php`).
- **`public/`** : Document root web server yang memuat `index.php` dan aset publik.

---

## Langkah 5: Membuat Proyek Go Fiber v3

1. **Kembali ke folder `pemweb2`:**
   ```powershell
   cd ..
   ```
   *(Pastikan posisi terminal saat ini berada di dalam folder `pemweb2`)*.

2. **Buat dan masuk ke folder proyek Go Fiber:**
   ```powershell
   mkdir latihan-fiber
   cd latihan-fiber
   ```

3. **Inisialisasi modul Go:**
   ```powershell
   go mod init latihan-fiber
   ```
   *Perintah ini akan membuat berkas `go.mod`.*

4. **Pasang paket framework Fiber v3:**
   ```powershell
   go get github.com/gofiber/fiber/v3
   ```
   *Perintah ini akan mengunduh Fiber v3 beserta pustaka pendukungnya dan menghasilkan berkas `go.sum`.*

---

## Langkah 6 & 7: Menulis Server Fiber & Endpoint JSON

1. **Buat berkas bernama `main.go` di dalam folder `latihan-fiber`**.
2. **Isikan kode program berikut:**

```go
package main

import (
	"log"

	"github.com/gofiber/fiber/v3"
)

func main() {
	// Inisialisasi instance aplikasi Fiber
	app := fiber.New()

	// Langkah 6: Endpoint root ("/") teks plain
	app.Get("/", func(c fiber.Ctx) error {
		return c.SendString("Halo Pemrograman Web II")
	})

	// Langkah 7: Endpoint JSON ("/api/info")
	app.Get("/api/info", func(c fiber.Ctx) error {
		return c.JSON(fiber.Map{
			"aplikasi": "Latihan Fiber",
			"versi":    "1.0.0",
			"status":   "berjalan",
		})
	})

	// Tugas 1: Endpoint JSON ("/api/mahasiswa")
	app.Get("/api/mahasiswa", func(c fiber.Ctx) error {
		return c.JSON(fiber.Map{
			"nim":           "H1H024016",
			"nama":          "Afif Nur Rahman",
			"program_studi": "Teknik Komputer",
		})
	})

	// Jalankan server pada port 3000
	log.Fatal(app.Listen(":3000"))
}
```

3. **Jalankan program:**
   ```powershell
   go run main.go
   ```
4. **Buka di browser:**
   - Halaman root: [http://localhost:3000](http://localhost:3000) &rarr; Menampilkan `"Halo Pemrograman Web II"`
   - Endpoint info: [http://localhost:3000/api/info](http://localhost:3000/api/info) &rarr; Menampilkan JSON status aplikasi

---

## Langkah 8: Pengujian Endpoint HTTP

Uji respon endpoint menggunakan **cURL** di terminal baru atau menggunakan **Postman**:

```powershell
# Uji Root Endpoint
curl -i http://localhost:3000/

# Uji Endpoint JSON Info
curl -i http://localhost:3000/api/info

# Uji Endpoint JSON Mahasiswa
curl -i http://localhost:3000/api/mahasiswa
```

**Hasil yang diharapkan:**
- Status Code: `HTTP/1.1 200 OK`
- Header untuk endpoint API: `Content-Type: application/json; charset=utf-8`

---

## Langkah 9: Inisialisasi Repositori Git

1. **Inisialisasi Git pada proyek `latihan-laravel`:**
   ```powershell
   cd ..\latihan-laravel
   git init
   git add .
   git commit -m "Modul 1: inisialisasi proyek Laravel"
   ```

2. **Inisialisasi Git pada proyek `latihan-fiber`:**
   Masuk ke folder `latihan-fiber`, buat berkas `.gitignore` terlebih dahulu:
   
   **Isi `.gitignore`:**
   ```text
   *.exe
   .env
   ```
   
   Lalu lakukan commit:
   ```powershell
   cd ..\latihan-fiber
   git init
   git add .
   git commit -m "Modul 1: inisialisasi proyek Fiber"
   ```

---

## Penyelesaian Tugas Mandiri

### Tugas 1: Endpoint `/api/mahasiswa` pada Fiber
- **Deskripsi:** Menambahkan endpoint `GET /api/mahasiswa` yang mengembalikan NIM, Nama, dan Program Studi.
- **Implementasi:** Telah disertakan pada berkas `main.go` di Langkah 6 & 7 di atas.
- **Pengujian:** Akses [http://localhost:3000/api/mahasiswa](http://localhost:3000/api/mahasiswa).

### Tugas 2: Ubah Halaman Depan Laravel
- **Deskripsi:** Ubah halaman depan Laravel agar menampilkan nama dan NIM Anda.
- **Lokasi Berkas:** `pemweb2/latihan-laravel/resources/views/welcome.blade.php`.
- **Implementasi:** Ganti isi berkas `welcome.blade.php` dengan antarmuka yang menampilkan:
  - **Nama:** Afif Nur Rahman
  - **NIM:** H1H024016
  - **Program Studi:** S1 Teknik Komputer
  - **Perguruan Tinggi:** Universitas Jenderal Soedirman
- **Pengujian:** Jalankan `php artisan serve` di folder `latihan-laravel` lalu buka [http://127.0.0.1:8000](http://127.0.0.1:8000).

### Tugas 3: Unggah ke Repositori GitHub
1. Buat repository baru di [GitHub](https://github.com/new) dengan nama:
   **`pemweb2-H1H024016-modul01`** *(set Public, tanpa checklist README)*.
2. Di terminal, masuk ke direktori induk `pemweb2`:
   ```powershell
   cd "c:\laragon\www\KULIAHHH\SEMESTER 5\PRAK. PEMWEB II\pemweb2"
   git init
   git add .
   git commit -m "Modul 1: Penyiapan Lingkungan Pengembangan Web Modern - Afif Nur Rahman (H1H024016)"
   git branch -M main
   git remote add origin https://github.com/<USERNAME-GITHUB-ANDA>/pemweb2-H1H024016-modul01.git
   git push -u origin main
   ```

### Tugas 4: Tabel Perbandingan Singkat Laravel dan Fiber

| No | Aspek | Laravel 13 (PHP) | Fiber v3 (Go) |
|---|---|---|---|
| 1 | **Bahasa & Paradigma** | PHP (Scripting dinamis, OOP MVC terstruktur). | Go / Golang (Statically typed, compiled, konseptual goroutine/channel). |
| 2 | **Filosofi & Bawaan Fitur** | *Batteries-Included*: Menyediakan ORM (Eloquent), otentikasi, migrasi database, Blade template, queue, dan mailer secara bawaan. | *Microframework & Minimalist*: Berfokus pada perutean (*routing*) cepat dan penyediaan API berlatensi sangat rendah di atas `valyala/fasthttp`. |
| 3 | **Ukuran Instalasi** | Besar (folder `vendor/` memuat ratusan MB dependensi pihak ketiga). | Sangat Ringan (hanya dependensi esensial, tanpa folder vendor berukuran besar). |
| 4 | **Model Eksekusi & Binary** | Mengharuskan runtime PHP (interpreter) dan server web perantara untuk memproses script pada setiap request. | Menghasilkan berkas **single binary executable** (`.exe` mandiri) yang dapat langsung dijalankan tanpa runtime eksternal. |
| 5 | **Waktu Startup & Kinerja** | Startup butuh inisialisasi framework (*bootstrap* provider), memori lebih besar. | Startup hampir instan (mikrodetik), penggunaan RAM sangat hemat, *throughput* RPS sangat tinggi. |
| 6 | **Manajer Dependensi** | Menggunakan Composer (`composer.json` & `composer.lock`). | Menggunakan Go Modules (`go.mod` & `go.sum`). |

---

## Jawaban Pertanyaan Pembahasan

### Pertanyaan 1: Mengapa folder `vendor` pada Laravel dan berkas binary Go tidak diikutsertakan dalam repositori Git?
1. **Mencegah Pembengkakan Repositori (*Repository Bloat*):** Folder `vendor` berisi puluhan ribu file eksternal dengan ukuran ratusan megabyte. Binary Go (`.exe`) adalah berkas binary yang tidak dapat di-*diff* baris per baris oleh Git. Memasukkannya akan membuat ukuran repositori sangat besar dan memperlambat proses `clone` serta `push`.
2. **Reproduksibilitas Dependensi:** Seluruh pustaka dependensi sudah tercatat secara presisi di file manifesto (`composer.json` & `composer.lock` untuk PHP, serta `go.mod` & `go.sum` untuk Go). Siapapun yang mengkloning proyek cukup menjalankan `composer install` atau `go mod download`.
3. **Kompatibilitas Platform (*Cross-Platform*):** Binary hasil kompilasi Go spesifik terhadap sistem operasi dan arsitektur CPU tertentu (misalnya `.exe` Windows x64 tidak bisa jalan di Linux server). Kompilasi harus dilakukan langsung pada lingkungan target atau melalui pipeline CI/CD.

### Pertanyaan 2: Apa fungsi berkas `composer.json` dan `go.mod`, serta apa persamaan keduanya?
- **Fungsi `composer.json`:** Berkas konfigurasi manajer paket Composer untuk PHP yang mendefinisikan metadata aplikasi, paket dependensi yang dibutuhkan beserta versinya, pemetaan *class autoloading* standar PSR-4, dan script otomasi.
- **Fungsi `go.mod`:** Berkas root modul Go yang mendefinisikan identitas modul (*module path*), versi toolchain Go yang digunakan, serta daftar modul pustaka eksternal beserta versi semantiknya.
- **Persamaan Keduanya:**
  1. Keduanya berfungsi sebagai **manifes dependensi deklaratif** proyek perangkat lunak.
  2. Keduanya menggunakan standar **Semantic Versioning (SemVer)** untuk penomoran rilis paket.
  3. Keduanya didampingi berkas pengunci hash dan versi deterministik (`composer.lock` pada Composer dan `go.sum` pada Go) untuk menjamin integritas paket di semua mesin.

### Pertanyaan 3: Jelaskan perbedaan port 8000 pada Laravel dan port 3000 pada Fiber dalam konteks praktikum ini.
- **Port 8000 (Laravel):** Merupakan port default yang dibuka oleh perintah `php artisan serve`. Perintah ini menjalankan **PHP Built-in CLI Web Server** yang meneruskan request ke berkas `public/index.php`. Server ini bersifat *single-threaded* dan dirancang khusus untuk keperluan pengembangan/debugging (*development only*), bukan untuk lingkungan produksi.
- **Port 3000 (Fiber):** Merupakan port yang ditentukan langsung dalam kode Go (`app.Listen(":3000")`). Pada Fiber, aplikasi Go bertindak langsung sebagai **server web mandiri (*standalone web server*)** menggunakan arsitektur event-driven `fasthttp`. Server ini mampu melayani ribuan koneksi konkuren secara asinkron menggunakan *goroutine* tanpa perlu perantara web server Apache/Nginx.

---

## Tips Troubleshooting & Galat Umum

1. **Error `could not find driver (Connection: sqlite)` pada Laravel:**
   - **Penyebab:** Ekstensi `pdo_sqlite` belum aktif di PHP Laragon.
   - **Solusi:** Di file `.env`, ubah `SESSION_DRIVER=database` menjadi `SESSION_DRIVER=file` dan `CACHE_STORE=file`.
2. **Error `port already in use` (Port 8000 atau 3000 sudah terpakai):**
   - **Solusi Laravel:** Jalankan di port lain: `php artisan serve --port=8080`.
   - **Solusi Fiber:** Ubah `:3000` di `main.go` menjadi `:3001` atau matikan proses yang menggunakan port tersebut.
3. **Ekstensi PHP belum aktif di Laragon:**
   - Buka menu Laragon &rarr; **PHP** &rarr; **Extensions** &rarr; Beri tanda centang pada `curl`, `mbstring`, `openssl`, `pdo_mysql`, `fileinfo`.

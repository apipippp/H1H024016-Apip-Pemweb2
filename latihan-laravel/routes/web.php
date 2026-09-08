<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
// Tugas no 2
use App\Http\Controllers\MatakuliahController;



Route::get('/', function () {
    return view('welcome');
});

// MODUL 2
Route::get('/salam', function(){
    return 'Selamat datang di Pemrograman Web II';
});

Route::get('/mahasiswa/{nim}', function (string $nim) {
    return 'Data mahasiswa dengan NIM ' . $nim;
});

// Route::get('/matakuliah/{kode?}', function (?string $kode = null) {
//     if ($kode === null) {
//         return 'Menampilkan seluruh matakuliah';
//     }
//     return 'Menampilkan matakuliah kode ' . $kode;
// });

Route::get('/semester/{angka}', function (int $angka) {
    return 'Semester ke ' . $angka;
})->whereNumber('angka');

Route::get('/data-mahasiswa', [MahasiswaController::class,'index'])->name('mahasiswa.index');

Route::get('/data-mahasiswa/{nim}', [MahasiswaController::class,'show'])->name('mahasiswa.show');

Route::get('/cari-mahasiswa', [MahasiswaController::class, 'cari']);

// Tugas no 2
Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
Route::get('/matakuliah/{kode}', [MatakuliahController::class, 'show'])->name('matakuliah.show');
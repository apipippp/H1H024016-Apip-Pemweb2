<?php

use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json([
        'sukses' => true,
        'pesan' => 'API Pemweb II aktif',
        'waktu' => now()->toIso8601String(),
    ]);
});

// Endpoint Tugas 2: Daftar Mahasiswa pada Satu Program Studi
Route::get('/program-studi/{id}/mahasiswa', [MahasiswaController::class, 'byProgramStudi']);

// Resource Mahasiswa & Matakuliah (Tugas 1)
Route::apiResource('mahasiswa', MahasiswaController::class);
Route::apiResource('matakuliah', MatakuliahController::class);

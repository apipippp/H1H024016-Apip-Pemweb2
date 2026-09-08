<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // Data array minimal 5 matakuliah
    private array $dataMatakuliah = [
        ['kode' => 'TK2101', 'nama' => 'Pemrograman Web II', 'sks' => 3, 'semester' => 5],
        ['kode' => 'TK2102', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3],
        ['kode' => 'TK2103', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 5],
        ['kode' => 'TK2104', 'nama' => 'Praktikum Jaringan Komputer', 'sks' => 1, 'semester' => 5],
        ['kode' => 'TK2105', 'nama' => 'Bahasa Inggris Teknik', 'sks' => 2, 'semester' => 1],
    ];

    // Method index: menampilkan daftar matakuliah + fitur pencarian (Tugas 1 & 3)
    public function index(Request $request)
    {
        $daftarMatakuliah = $this->dataMatakuliah;
        $kataKunci = $request->query('q', '');

        // Fitur pencarian sederhana jika ada query string ?q=...
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

    // Method show: menampilkan detail matakuliah (Tugas 1)
    public function show(string $kode)
    {
        // Cari matakuliah berdasarkan kode
        $matakuliah = collect($this->dataMatakuliah)->firstWhere('kode', $kode);

        return view('matakuliah.show', [
            'kode' => $kode,
            'matakuliah' => $matakuliah,
        ]);
    }
}

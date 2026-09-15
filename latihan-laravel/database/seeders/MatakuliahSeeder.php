<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $matakuliahList = [
            ['kode' => 'TK2101', 'nama' => 'Pemrograman Web II', 'sks' => 3, 'semester' => 5],
            ['kode' => 'TK2102', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3],
            ['kode' => 'TK2103', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 5],
            ['kode' => 'TK2104', 'nama' => 'Praktikum Jaringan Komputer', 'sks' => 1, 'semester' => 5],
            ['kode' => 'TK2105', 'nama' => 'Bahasa Inggris Teknik', 'sks' => 2, 'semester' => 1],
        ];

        foreach ($matakuliahList as $mk) {
            Matakuliah::create($mk);
        }

        // Pasangkan beberapa mata kuliah beserta nilai ke seluruh mahasiswa
        $semuaMk = Matakuliah::all();
        $opsiNilai = ['A', 'AB', 'B', 'BC', 'C'];

        foreach (Mahasiswa::all() as $mhs) {
            // Berikan 2 sampai 4 mata kuliah secara acak untuk setiap mahasiswa
            $mkRandom = $semuaMk->random(rand(2, 4));
            foreach ($mkRandom as $mk) {
                $mhs->matakuliah()->attach($mk->id, [
                    'nilai' => $opsiNilai[array_rand($opsiNilai)]
                ]);
            }
        }
    }
}

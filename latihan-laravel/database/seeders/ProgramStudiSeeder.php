<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            ['kode' => 'TK', 'nama' => 'Teknik Komputer', 'jenjang' => 'S1'],
            ['kode' => 'IF', 'nama' => 'Informatika', 'jenjang' => 'S1'],
            ['kode' => 'TE', 'nama' => 'Teknik Elektro', 'jenjang' => 'S1'],
        ];

        foreach ($daftar as $item) {
            ProgramStudi::create($item);
        }
    }
}

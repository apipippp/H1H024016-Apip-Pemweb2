<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ProgramStudiSeeder::class);
        Mahasiswa::factory()->count(30)->create();
        $this->call(MatakuliahSeeder::class); // <-- Tambahkan ini
    }
}

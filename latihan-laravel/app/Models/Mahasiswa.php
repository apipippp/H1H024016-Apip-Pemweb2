<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Tambahkan baris ini
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Mahasiswa extends Model
{
    use HasFactory; // <-- Tambahkan baris ini di dalam class

    protected $table = 'mahasiswas';
    protected $fillable = [
        'program_studi_id',
        'nim',
        'nama',
        'email',
        'angkatan',
        'ipk',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'angkatan' => 'integer',
            'ipk' => 'decimal:2',
            'aktif' => 'boolean',
        ];
    }

    // Relasi: Mahasiswa dimiliki oleh satu Program Studi (Belongs To)
    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    // Relasi Many to Many ke Matakuliah (Tugas 2)
public function matakuliah(): BelongsToMany
    {
        return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah')
                    ->withPivot('nilai')
                    ->withTimestamps();
    }

}

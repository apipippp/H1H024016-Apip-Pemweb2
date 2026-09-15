<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Matakuliah extends Model
{
    protected $table = 'matakuliahs';
    protected $fillable = ['kode', 'nama', 'sks', 'semester'];

    // Relasi Many to Many ke Mahasiswa (Tugas 2)
    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah')
                    ->withPivot('nilai')
                    ->withTimestamps();
    }
}

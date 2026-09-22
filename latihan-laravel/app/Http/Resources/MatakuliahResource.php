<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatakuliahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode' => $this->kode,
            'nama' => $this->nama,
            'sks' => (int) $this->sks,
            'semester' => (int) $this->semester,
            'dibuat_pada' => $this->created_at?->toIso8601String(),
        ];
    }
}

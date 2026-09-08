@extends('layouts.app')

@section('judul', 'Detail Mata Kuliah')

@section('konten')
    <h1 class="h3 mb-4">Detail Mata Kuliah</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Informasi Mata Kuliah</h5>
        </div>
        <div class="card-body">
            @if ($matakuliah)
                <p><strong>Kode:</strong> {{ $matakuliah['kode'] }}</p>
                <p><strong>Nama:</strong> {{ $matakuliah['nama'] }}</p>
                <p><strong>Bobot SKS:</strong> <x-badge-sks :sks="$matakuliah['sks']" /></p>
                <p><strong>Semester:</strong> Semester {{ $matakuliah['semester'] }}</p>
            @else
                <div class="alert alert-warning mb-0">
                    Data mata kuliah dengan kode <strong>{{ $kode }}</strong> tidak ditemukan.
                </div>
            @endif
        </div>
    </div>

    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary mt-3">
        &larr; Kembali ke Daftar
    </a>
@endsection

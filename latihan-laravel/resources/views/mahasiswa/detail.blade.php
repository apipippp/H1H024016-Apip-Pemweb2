@extends('layouts.app')

@section('judul', 'Detail Mahasiswa & Nilai')

@section('konten')
    <h1 class="h3 mb-4">Detail Mahasiswa</h1>

    {{-- Kartu Data Diri Mahasiswa --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Informasi Mahasiswa</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                    <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
                    <p><strong>Program Studi:</strong> {{ $mahasiswa->programStudi->nama ?? '-' }} ({{ $mahasiswa->programStudi->jenjang ?? '' }})</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}</p>
                    <p><strong>IPK:</strong> <span class="badge bg-info text-dark fs-6">{{ $mahasiswa->ipk }}</span></p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $mahasiswa->aktif ? 'bg-success' : 'bg-danger' }}">
                            {{ $mahasiswa->aktif ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Mata Kuliah yang Diambil & Nilai Pivot --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0">Mata Kuliah yang Diambil & Nilai</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Nilai Huruf</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa->matakuliah as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $mk->kode }}</td>
                            <td>{{ $mk->nama }}</td>
                            <td>{{ $mk->sks }} SKS</td>
                            <td>Semester {{ $mk->semester }}</td>
                            <td>
                                {{-- Mengambil kolom tambahan 'nilai' dari tabel pivot --}}
                                <span class="badge bg-primary fs-6">{{ $mk->pivot->nilai ?? '-' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Mahasiswa ini belum mengambil mata kuliah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('mahasiswa.data') }}" class="btn btn-secondary mt-3">
        &larr; Kembali ke Daftar Mahasiswa
    </a>
@endsection

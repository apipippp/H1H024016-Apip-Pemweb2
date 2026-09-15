@extends('layouts.app')

@section('judul', 'Top 10 IPK Teknik Komputer')

@section('konten')
    <h1 class="h3 mb-4">Top 10 Mahasiswa IPK Tertinggi - Teknik Komputer</h1>
    
    <table class="table table-striped table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Peringkat</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>IPK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topMahasiswa as $index => $mhs)
                <tr>
                    <td><span class="badge bg-warning text-dark">#{{ $index + 1 }}</span></td>
                    <td class="fw-bold">{{ $mhs->nim }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->angkatan }}</td>
                    <td><span class="badge bg-success fs-6">{{ $mhs->ipk }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('mahasiswa.data') }}" class="btn btn-secondary">&larr; Kembali</a>
@endsection

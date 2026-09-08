@extends('layouts.app')

@section('judul', 'Daftar Mata Kuliah')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Daftar Mata Kuliah</h1>

        {{-- Form Pencarian dengan Query String ?q= (Nomor 3) --}}
        <form method="GET" action="{{ route('matakuliah.index') }}" class="d-flex gap-2">
            <input type="text" name="q" value="{{ $kataKunci }}" class="form-control form-control-sm" placeholder="Cari matakuliah...">
            <button type="submit" class="btn btn-sm btn-primary">Cari</button>
            @if(!empty($kataKunci))
                <a href="{{ route('matakuliah.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    {{-- Keterangan jika sedang mencari --}}
    @if(!empty($kataKunci))
        <div class="alert alert-info py-2">
            Hasil pencarian untuk kata kunci: <strong>"{{ $kataKunci }}"</strong>
        </div>
    @endif


    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarMatakuliah as $mk)
                <tr>
                    <td class="fw-bold">{{ $mk['kode'] }}</td>
                    <td>{{ $mk['nama'] }}</td>
                    <td><x-badge-sks :sks="$mk['sks']" /></td>
                    <td>
                        <a href="{{ route('matakuliah.show', $mk['kode']) }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Data mata kuliah tidak tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

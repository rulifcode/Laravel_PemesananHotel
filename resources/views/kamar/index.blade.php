@extends('layouts.app')
@section('title', 'Data Kamar')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Kamar</h2>
    <a href="{{ route('kamar.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Kamar</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th><th>Foto</th><th>Nama Kamar</th><th>Tipe</th><th>Harga</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kamars as $i => $kamar)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>
                @if($kamar->foto)
                    <img src="{{ asset('img/kamar/' . $kamar->foto) }}" width="80" class="rounded">
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td>{{ $kamar->nama_kamar }}</td>
            <td>{{ $kamar->tipe_kamar }}</td>
            <td>Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus kamar ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data kamar.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
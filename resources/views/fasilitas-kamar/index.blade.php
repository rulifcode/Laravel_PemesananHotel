@extends('layouts.app')
@section('title', 'Fasilitas Kamar')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Fasilitas Kamar</h2>
    <a href="{{ route('fasilitas-kamar.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Fasilitas</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Kamar</th><th>Nama Fasilitas</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @forelse($fasilitasKamars as $i => $fas)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $fas->kamar->nomor_kamar ?? '-' }}</td>
            <td>{{ $fas->nama_fasilitas }}</td>
            <td>
                <a href="{{ route('fasilitas-kamar.edit', $fas->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('fasilitas-kamar.destroy', $fas->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus fasilitas ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">Belum ada data fasilitas.</td></tr>
        @endforelse
    </tbody>
</table>

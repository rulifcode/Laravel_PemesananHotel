@extends('layouts.app')
@section('title', 'Galeri')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Galeri</h2>
    <a href="{{ route('galeri.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Foto</a>
</div>
<div class="row g-3">
    @forelse($galeris as $galeri)
    <div class="col-md-3">
        <div class="card h-100">
            @if($galeri->foto)
                <img src="{{ asset('img/galeri/' . $galeri->foto) }}" class="card-img-top" style="height:180px;object-fit:cover;">
            @endif
            <div class="card-body">
                <h6 class="card-title">{{ $galeri->judul }}</h6>
                <p class="card-text text-muted small">{{ $galeri->keterangan }}</p>
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-sm btn-warning flex-fill">Edit</a>
                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                      onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col"><p class="text-muted">Belum ada foto galeri.</p></div>
    @endforelse
</div>

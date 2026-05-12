@extends('layouts.app')
@section('title', 'Edit Galeri')
@section('content')
<h2 class="mb-3">Edit Foto Galeri</h2>
<form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $galeri->keterangan) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto (kosongkan jika tidak diganti)</label>
        @if($galeri->foto)
            <div class="mb-2"><img src="{{ asset('img/galeri/' . $galeri->foto) }}" width="120" class="rounded"></div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Batal</a>
</form>

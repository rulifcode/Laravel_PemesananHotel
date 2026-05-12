@extends('layouts.app')
@section('title', 'Edit Kamar')
@section('content')
<h2 class="mb-3">Edit Kamar</h2>
<form action="{{ route('kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nomor Kamar</label>
        <input type="text" name="nomor_kamar" class="form-control @error('nomor_kamar') is-invalid @enderror"
               value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" required>
        @error('nomor_kamar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Tipe</label>
        <select name="tipe" class="form-select" required>
            <option value="Standard" {{ (old('tipe',$kamar->tipe)=='Standard')?'selected':'' }}>Standard</option>
            <option value="Deluxe" {{ (old('tipe',$kamar->tipe)=='Deluxe')?'selected':'' }}>Deluxe</option>
            <option value="Suite" {{ (old('tipe',$kamar->tipe)=='Suite')?'selected':'' }}>Suite</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga per Malam (Rp)</label>
        <input type="number" name="harga" class="form-control"
               value="{{ old('harga', $kamar->harga) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="tersedia" {{ (old('status',$kamar->status)=='tersedia')?'selected':'' }}>Tersedia</option>
            <option value="tidak tersedia" {{ (old('status',$kamar->status)=='tidak tersedia')?'selected':'' }}>Tidak Tersedia</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto (kosongkan jika tidak diganti)</label>
        @if($kamar->foto)
            <div class="mb-2"><img src="{{ asset('img/kamar/' . $kamar->foto) }}" width="120" class="rounded"></div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Batal</a>
</form>

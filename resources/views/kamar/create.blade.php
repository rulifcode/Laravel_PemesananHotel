@extends('layouts.app')
@section('title', 'Tambah Kamar')
@section('content')
<h2 class="mb-3">Tambah Kamar</h2>
<form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nomor Kamar</label>
        <input type="text" name="nomor_kamar" class="form-control @error('nomor_kamar') is-invalid @enderror"
               value="{{ old('nomor_kamar') }}" required>
        @error('nomor_kamar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Tipe</label>
        <select name="tipe" class="form-select @error('tipe') is-invalid @enderror" required>
            <option value="">-- Pilih Tipe --</option>
            <option value="Standard" {{ old('tipe')=='Standard'?'selected':'' }}>Standard</option>
            <option value="Deluxe" {{ old('tipe')=='Deluxe'?'selected':'' }}>Deluxe</option>
            <option value="Suite" {{ old('tipe')=='Suite'?'selected':'' }}>Suite</option>
        </select>
        @error('tipe')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Harga per Malam (Rp)</label>
        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
               value="{{ old('harga') }}" required>
        @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="tersedia" {{ old('status')=='tersedia'?'selected':'' }}>Tersedia</option>
            <option value="tidak tersedia" {{ old('status')=='tidak tersedia'?'selected':'' }}>Tidak Tersedia</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Batal</a>
</form>

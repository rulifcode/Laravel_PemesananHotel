@extends('layouts.app')
@section('title', 'Tambah Fasilitas Kamar')
@section('content')
<h2 class="mb-3">Tambah Fasilitas Kamar</h2>
<form action="{{ route('fasilitas-kamar.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kamar</label>
        <select name="kamar_id" class="form-select @error('kamar_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kamar --</option>
            @foreach($kamars as $kamar)
                <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                    {{ $kamar->nama_kamar }} - {{ $kamar->tipe_kamar }}
                </option>
            @endforeach
        </select>
        @error('kamar_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Fasilitas</label>
        <input type="text" name="nama_fasilitas" class="form-control @error('nama_fasilitas') is-invalid @enderror"
               value="{{ old('nama_fasilitas') }}" placeholder="cth: AC, WiFi, TV" required>
        @error('nama_fasilitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('fasilitas-kamar.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection

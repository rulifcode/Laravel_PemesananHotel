@extends('layouts.app')
@section('title', 'Edit Fasilitas Kamar')
@section('content')
<h2 class="mb-3">Edit Fasilitas Kamar</h2>
<form action="{{ route('fasilitas-kamar.update', $fasilitasKamar->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Kamar</label>
        <select name="kamar_id" class="form-select" required>
            @foreach($kamars as $kamar)
                <option value="{{ $kamar->id }}"
                    {{ (old('kamar_id',$fasilitasKamar->kamar_id)==$kamar->id)?'selected':'' }}>
                    {{ $kamar->nomor_kamar }} - {{ $kamar->tipe }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Fasilitas</label>
        <input type="text" name="nama_fasilitas" class="form-control"
               value="{{ old('nama_fasilitas', $fasilitasKamar->nama_fasilitas) }}" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('fasilitas-kamar.index') }}" class="btn btn-secondary">Batal</a>
</form>

@extends('layouts.app')
@section('title', 'Tambah Pesanan')
@section('content')
<h2 class="mb-3">Tambah Pesanan</h2>
<form action="{{ route('pesanan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Tamu</label>
        <input type="text" name="nama_tamu" class="form-control @error('nama_tamu') is-invalid @enderror"
               value="{{ old('nama_tamu') }}" required>
        @error('nama_tamu')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Kamar</label>
        <select name="kamar_id" class="form-select @error('kamar_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kamar --</option>
            @foreach($kamars as $kamar)
                <option value="{{ $kamar->id }}" {{ old('kamar_id')==$kamar->id?'selected':'' }}>
                    {{ $kamar->nomor_kamar }} - {{ $kamar->tipe }} (Rp {{ number_format($kamar->harga,0,',','.') }})
                </option>
            @endforeach
        </select>
        @error('kamar_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Check In</label>
            <input type="date" name="check_in" class="form-control" value="{{ old('check_in') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Check Out</label>
            <input type="date" name="check_out" class="form-control" value="{{ old('check_out') }}" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Total Harga (Rp)</label>
        <input type="number" name="total_harga" class="form-control" value="{{ old('total_harga') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
</form>

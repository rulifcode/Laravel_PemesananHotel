@extends('layouts.app')
@section('title', 'Tambah Pesanan')
@section('content')
<h2 class="mb-3">Tambah Pesanan</h2>
<form action="{{ route('pesanan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Pemesan</label>
        <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror"
               value="{{ old('nama_pemesan') }}" required>
        @error('nama_pemesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Email Pemesan</label>
        <input type="email" name="email_pemesan" class="form-control @error('email_pemesan') is-invalid @enderror"
               value="{{ old('email_pemesan') }}" required>
        @error('email_pemesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">No. HP Pemesan</label>
        <input type="text" name="hp_pemesan" class="form-control @error('hp_pemesan') is-invalid @enderror"
               value="{{ old('hp_pemesan') }}" required>
        @error('hp_pemesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Tamu</label>
        <input type="text" name="nama_tamu" class="form-control @error('nama_tamu') is-invalid @enderror"
               value="{{ old('nama_tamu') }}" required>
        @error('nama_tamu')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kamar</label>
        <select name="kamar_id" class="form-select @error('kamar_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kamar --</option>
            @foreach($kamars as $kamar)
                <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                    {{ $kamar->nama_kamar }} - {{ $kamar->tipe_kamar }} (Rp {{ number_format($kamar->harga, 0, ',', '.') }})
                </option>
            @endforeach
        </select>
        @error('kamar_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Check In</label>
            <input type="date" name="cek_in" class="form-control @error('cek_in') is-invalid @enderror"
                   value="{{ old('cek_in') }}" required>
            @error('cek_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Check Out</label>
            <input type="date" name="cek_out" class="form-control @error('cek_out') is-invalid @enderror"
                   value="{{ old('cek_out') }}" required>
            @error('cek_out')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Kamar</label>
        <input type="number" name="jml_kamar" class="form-control @error('jml_kamar') is-invalid @enderror"
               value="{{ old('jml_kamar', 1) }}" min="1" required>
        @error('jml_kamar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection

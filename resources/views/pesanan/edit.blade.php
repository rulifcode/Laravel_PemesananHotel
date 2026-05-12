@extends('layouts.app')
@section('title', 'Edit Pesanan')
@section('content')
<h2 class="mb-3">Edit Pesanan</h2>
<form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Tamu</label>
        <input type="text" name="nama_tamu" class="form-control"
               value="{{ old('nama_tamu', $pesanan->nama_tamu) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pesanan->no_hp) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Kamar</label>
        <select name="kamar_id" class="form-select" required>
            @foreach($kamars as $kamar)
                <option value="{{ $kamar->id }}"
                    {{ (old('kamar_id',$pesanan->kamar_id)==$kamar->id)?'selected':'' }}>
                    {{ $kamar->nomor_kamar }} - {{ $kamar->tipe }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Check In</label>
            <input type="date" name="check_in" class="form-control"
                   value="{{ old('check_in', $pesanan->check_in) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Check Out</label>
            <input type="date" name="check_out" class="form-control"
                   value="{{ old('check_out', $pesanan->check_out) }}" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Total Harga (Rp)</label>
        <input type="number" name="total_harga" class="form-control"
               value="{{ old('total_harga', $pesanan->total_harga) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="pending" {{ (old('status',$pesanan->status)=='pending')?'selected':'' }}>Pending</option>
            <option value="konfirmasi" {{ (old('status',$pesanan->status)=='konfirmasi')?'selected':'' }}>Konfirmasi</option>
            <option value="batal" {{ (old('status',$pesanan->status)=='batal')?'selected':'' }}>Batal</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $pesanan->keterangan) }}</textarea>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
</form>

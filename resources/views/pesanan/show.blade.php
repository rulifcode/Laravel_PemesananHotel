@extends('layouts.app')
@section('title', 'Detail Pesanan')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Pesanan #{{ $pesanan->id }}</h5>
        <a href="{{ route('pesanan.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="180">Nama Tamu</th><td>: {{ $pesanan->nama_tamu }}</td></tr>
            <tr><th>No. HP</th><td>: {{ $pesanan->no_hp ?? '-' }}</td></tr>
            <tr><th>Kamar</th><td>: {{ $pesanan->kamar->nomor_kamar ?? '-' }} ({{ $pesanan->kamar->tipe ?? '' }})</td></tr>
            <tr><th>Check In</th><td>: {{ $pesanan->check_in }}</td></tr>
            <tr><th>Check Out</th><td>: {{ $pesanan->check_out }}</td></tr>
            <tr><th>Total Harga</th><td>: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td></tr>
            <tr><th>Status</th><td>: <span class="badge bg-info">{{ ucfirst($pesanan->status) }}</span></td></tr>
            <tr><th>Keterangan</th><td>: {{ $pesanan->keterangan ?? '-' }}</td></tr>
        </table>
    </div>
    <div class="card-footer">
        <form action="{{ route('pesanan.status', $pesanan->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <select name="status" class="form-select d-inline w-auto">
                <option value="pending">Pending</option>
                <option value="konfirmasi">Konfirmasi</option>
                <option value="batal">Batal</option>
            </select>
            <button type="submit" class="btn btn-primary ms-2">Update Status</button>
        </form>
        <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-warning ms-2">Edit</a>
    </div>
</div>

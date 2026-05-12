@extends('layouts.app')
@section('title', 'Data Pesanan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pesanan</h2>
    <a href="{{ route('pesanan.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Pesanan</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th><th>Nama Pemesan</th><th>Kamar</th><th>Check In</th><th>Check Out</th><th>Jml Kamar</th><th>Status</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pesanans as $i => $pesanan)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $pesanan->nama_pemesan }}</td>
            <td>{{ $pesanan->kamar->nama_kamar ?? '-' }}</td>
            <td>{{ $pesanan->cek_in }}</td>
            <td>{{ $pesanan->cek_out }}</td>
            <td>{{ $pesanan->jml_kamar }}</td>
            <td>
                @php
                    $badge = match($pesanan->status) {
                        'pending' => 'warning',
                        'konfirmasi' => 'success',
                        'batal' => 'danger',
                        default => 'secondary'
                    };
                @endphp
                <span class="badge bg-{{ $badge }}">{{ ucfirst($pesanan->status) }}</span>
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info">Detail</a>
                <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST"
                      onsubmit="return confirm('Hapus pesanan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center">Belum ada data pesanan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
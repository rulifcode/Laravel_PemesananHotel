@extends('layouts.app')

@section('title', 'Data Pesanan')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-slate-700 font-semibold text-lg">Data Pesanan</h2>
        <p class="text-slate-400 text-xs mt-0.5">Kelola semua pesanan tamu</p>
    </div>
    <a href="{{ route('pesanan.create') }}"
       class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-slate-900 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
        <i class="bi bi-plus-lg"></i> Tambah Pesanan
    </a>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-slate-800 text-slate-300 text-xs uppercase tracking-wider">
                <th class="px-4 py-3 text-left font-medium w-10">#</th>
                <th class="px-4 py-3 text-left font-medium">Nama Pemesan</th>
                <th class="px-4 py-3 text-left font-medium">Kamar</th>
                <th class="px-4 py-3 text-left font-medium">Check In</th>
                <th class="px-4 py-3 text-left font-medium">Check Out</th>
                <th class="px-4 py-3 text-center font-medium">Jml</th>
                <th class="px-4 py-3 text-center font-medium">Status</th>
                <th class="px-4 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($pesanans as $i => $pesanan)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 text-slate-400 text-xs">{{ $i + 1 }}</td>

                    <td class="px-4 py-3">
                        <p class="text-slate-700 font-medium">{{ $pesanan->nama_pemesan }}</p>
                        <p class="text-slate-400 text-xs">{{ $pesanan->email_pemesan ?? '' }}</p>
                    </td>

                    <td class="px-4 py-3 text-slate-600">
                        {{ $pesanan->kamar->nama_kamar ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-slate-600">
                        {{ \Carbon\Carbon::parse($pesanan->cek_in)->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3 text-slate-600">
                        {{ \Carbon\Carbon::parse($pesanan->cek_out)->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3 text-center text-slate-600">
                        {{ $pesanan->jml_kamar }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        @php
                            $style = match($pesanan->status) {
                                'pending'    => 'bg-amber-100 text-amber-700',
                                'konfirmasi' => 'bg-emerald-100 text-emerald-700',
                                'batal'      => 'bg-red-100 text-red-600',
                                default      => 'bg-slate-100 text-slate-500',
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium {{ $style }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="{{ route('pesanan.show', $pesanan->id) }}"
                               class="text-xs font-medium bg-slate-100 hover:bg-blue-100 text-slate-600 hover:text-blue-600 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('pesanan.edit', $pesanan->id) }}"
                               class="text-xs font-medium bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-700 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs font-medium bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 px-2.5 py-1.5 rounded-lg transition-colors">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-16 text-center text-slate-400">
                        <i class="bi bi-calendar-x text-4xl block mb-2"></i>
                        <p class="text-sm">Belum ada data pesanan.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-slate-700 font-semibold text-lg">Data Kamar</h2>
        <p class="text-slate-400 text-xs mt-0.5">Kelola seluruh kamar hotel</p>
    </div>
    <a href="{{ route('kamar.create') }}"
       class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-slate-900 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
        <i class="bi bi-plus-lg"></i> Tambah Kamar
    </a>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-slate-800 text-slate-300 text-xs uppercase tracking-wider">
                <th class="px-4 py-3 text-left font-medium w-10">#</th>
                <th class="px-4 py-3 text-left font-medium w-24">Foto</th>
                <th class="px-4 py-3 text-left font-medium">Nama Kamar</th>
                <th class="px-4 py-3 text-left font-medium">Tipe</th>
                <th class="px-4 py-3 text-left font-medium">Harga</th>
                <th class="px-4 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($kamars as $i => $kamar)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 text-slate-400 text-xs">{{ $i + 1 }}</td>

                    {{-- Foto --}}
                    <td class="px-4 py-3">
                        @if ($kamar->foto)
                            <img src="{{ asset('img/kamar/' . $kamar->foto) }}"
                                 alt="{{ $kamar->nama_kamar }}"
                                 class="w-16 h-12 object-cover rounded-lg">
                        @else
                            <div class="w-16 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                                <i class="bi bi-image text-slate-300 text-lg"></i>
                            </div>
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td class="px-4 py-3 text-slate-700 font-medium">
                        {{ $kamar->nama_kamar }}
                    </td>

                    {{-- Tipe --}}
                    <td class="px-4 py-3">
                        @php
                            $tipe = match($kamar->tipe_kamar) {
                                'Suite'   => 'bg-amber-100 text-amber-700',
                                'Deluxe'  => 'bg-blue-100 text-blue-700',
                                default   => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium {{ $tipe }}">
                            {{ $kamar->tipe_kamar }}
                        </span>
                    </td>

                    {{-- Harga --}}
                    <td class="px-4 py-3 text-slate-700">
                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="{{ route('kamar.edit', $kamar->id) }}"
                               class="text-xs font-medium bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-700 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs font-medium bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 px-2.5 py-1.5 rounded-lg transition-colors">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-16 text-center text-slate-400">
                        <i class="bi bi-inbox text-4xl block mb-2"></i>
                        <p class="text-sm">Belum ada data kamar.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Fasilitas Kamar')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-slate-700 font-semibold text-lg">Fasilitas Kamar</h2>
        <p class="text-slate-400 text-xs mt-0.5">Kelola semua fasilitas tiap kamar hotel</p>
    </div>
    <a href="{{ route('fasilitas-kamar.create') }}"
       class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-slate-900 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
        <i class="bi bi-plus-lg"></i> Tambah Fasilitas
    </a>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-slate-800 text-slate-300 text-xs uppercase tracking-wider">
                <th class="px-4 py-3 text-left font-medium w-10">#</th>
                <th class="px-4 py-3 text-left font-medium">Kamar</th>
                <th class="px-4 py-3 text-left font-medium">Nama Fasilitas</th>
                <th class="px-4 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($fasilitasKamars as $i => $fas)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 text-slate-400 text-xs">{{ $i + 1 }}</td>

                    {{-- Badge Kamar --}}
                    <td class="px-4 py-3">
                        @php
                            $nama  = $fas->kamar->nama_kamar ?? '-';
                            $tipe  = strtolower($nama);
                            $badge = match(true) {
                                str_contains($tipe, 'suite')   => 'bg-amber-100 text-amber-700',
                                str_contains($tipe, 'deluxe')  => 'bg-blue-100 text-blue-700',
                                str_contains($tipe, 'standar') => 'bg-slate-100 text-slate-600',
                                default                        => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-medium {{ $badge }}">
                            {{ $nama }}
                        </span>
                    </td>

                    {{-- Nama Fasilitas --}}
                    <td class="px-4 py-3 text-slate-700">
                        @php
                            $icon = match(strtolower($fas->nama_fasilitas ?? '')) {
                                'ac'            => 'bi-wind',
                                'tv'            => 'bi-tv',
                                'wifi'          => 'bi-wifi',
                                'kulkas'        => 'bi-box',
                                'kamar mandi'   => 'bi-droplet',
                                'parkir'        => 'bi-p-square',
                                default         => 'bi-check-circle',
                            };
                        @endphp
                        <span class="inline-flex items-center gap-2">
                            <i class="bi {{ $icon }} text-slate-400"></i>
                            {{ $fas->nama_fasilitas }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="{{ route('fasilitas-kamar.edit', $fas->id) }}"
                               class="text-xs font-medium bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-700 px-2.5 py-1.5 rounded-lg transition-colors">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('fasilitas-kamar.destroy', $fas->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
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
                    <td colspan="4" class="px-4 py-16 text-center text-slate-400">
                        <i class="bi bi-clipboard-x text-4xl block mb-2"></i>
                        <p class="text-sm">Belum ada data fasilitas.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer count --}}
    @if ($fasilitasKamars->count() > 0)
        <div class="px-4 py-3 border-t border-slate-100 bg-slate-50">
            <p class="text-xs text-slate-400">
                Menampilkan
                <span class="font-medium text-slate-600">{{ $fasilitasKamars->count() }}</span>
                fasilitas
            </p>
        </div>
    @endif
</div>

@endsection
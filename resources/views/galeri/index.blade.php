@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-slate-700 font-semibold text-lg">Foto Galeri</h2>
        <p class="text-slate-400 text-xs mt-0.5">Kelola foto-foto hotel</p>
    </div>
    <a href="{{ route('galeri.create') }}"
       class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-slate-900 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
        <i class="bi bi-plus-lg"></i> Tambah Foto
    </a>
</div>

{{-- Grid Galeri --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
    @forelse ($galeris as $galeri)
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow">

            {{-- Foto --}}
            @if ($galeri->foto)
                <img
                    src="{{ asset('img/galeri/' . $galeri->foto) }}"
                    alt="{{ $galeri->judul }}"
                    class="w-full h-44 object-cover"
                >
            @else
                <div class="w-full h-44 bg-slate-100 flex flex-col items-center justify-center text-slate-400 gap-1">
                    <i class="bi bi-image text-3xl"></i>
                    <span class="text-xs">Tidak ada foto</span>
                </div>
            @endif

            {{-- Judul --}}
            <div class="px-4 py-3 border-b border-slate-100">
                <p class="text-slate-700 text-sm font-medium truncate">{{ $galeri->judul }}</p>
            </div>

            {{-- Aksi --}}
            <div class="px-4 py-3 flex items-center gap-2">
                <a href="{{ route('galeri.edit', $galeri->id) }}"
                   class="flex-1 text-center text-xs font-medium bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-700 px-3 py-1.5 rounded-lg transition-colors">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                      class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full text-xs font-medium bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 px-3 py-1.5 rounded-lg transition-colors">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>

        </div>
    @empty
        <div class="col-span-full flex flex-col items-center justify-center py-16 text-slate-400">
            <i class="bi bi-images text-5xl mb-3"></i>
            <p class="text-sm">Belum ada foto di galeri.</p>
            <a href="{{ route('galeri.create') }}"
               class="mt-3 text-xs text-amber-500 hover:text-amber-600 underline">
                Tambah foto pertama
            </a>
        </div>
    @endforelse
</div>

@endsection
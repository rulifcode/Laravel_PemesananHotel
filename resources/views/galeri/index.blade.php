@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Foto Galeri</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola foto-foto hotel</p>
    </div>
    <a href="{{ route('galeri.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors flex-shrink-0">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah Foto
    </a>
</div>

{{-- Grid --}}
@if ($galeris->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3">
        @foreach ($galeris as $galeri)
            <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden hover:border-black/[0.12] transition-colors group">

                {{-- Foto --}}
                @if ($galeri->foto)
                    <div class="relative overflow-hidden" style="height:160px">
                        <img src="{{ asset('img/galeri/' . $galeri->foto) }}"
                             alt="{{ $galeri->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center bg-[#F5F4F2]" style="height:160px">
                        <i class="bi bi-image text-[#ddd] text-3xl block mb-1"></i>
                        <span class="text-[11px] text-[#ccc]">Belum ada foto</span>
                    </div>
                @endif

                {{-- Info + Aksi --}}
                <div class="px-3 py-2.5">
                    <p class="text-[12.5px] font-medium text-[#121212] truncate mb-2.5">{{ $galeri->judul }}</p>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('galeri.edit', $galeri->id) }}"
                           title="Edit"
                           class="flex-1 inline-flex items-center justify-center gap-1 text-[11px] font-medium border border-black/[0.08] rounded-[5px] py-1.5 text-[#888] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                            <i class="bi bi-pencil text-[11px]"></i> Edit
                        </a>
                        <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus foto ini?')"
                              class="flex-1" style="display:flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex-1 inline-flex items-center justify-center gap-1 text-[11px] font-medium border border-black/[0.08] rounded-[5px] py-1.5 text-[#888] hover:bg-[#FEF0F0] hover:text-[#E24B4A] hover:border-[#E24B4A]/20 transition-colors cursor-pointer bg-transparent">
                                <i class="bi bi-trash text-[11px]"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

@else
    {{-- Empty State --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] flex flex-col items-center justify-center py-16">
        <i class="bi bi-images text-[#ddd] text-5xl block mb-3"></i>
        <p class="text-[12.5px] text-[#bbb]">Belum ada foto di galeri.</p>
        <a href="{{ route('galeri.create') }}"
           class="inline-flex items-center gap-1 mt-3 text-[12px] text-[#FF6B00] hover:underline">
            <i class="bi bi-plus-lg"></i> Tambah foto pertama
        </a>
    </div>
@endif

@endsection
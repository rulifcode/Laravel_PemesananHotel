@extends('layouts.app')

@section('title', 'Manajemen Banner')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Manajemen Banner</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola banner yang tampil di halaman utama</p>
    </div>
    <a href="{{ route('admin.banner.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors flex-shrink-0">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah Banner
    </a>
</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Banner</span>
        @if ($banners->count() > 0)
            <span class="text-[11px] text-[#aaa]">
                {{ $banners->count() }} banner terdaftar
            </span>
        @endif
    </div>

    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Gambar</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Judul</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-20">Urutan</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Status</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($banners as $i => $banner)
                <tr class="border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- Gambar --}}
                    <td class="px-4 py-[10px]">
                        <div class="w-[52px] h-[34px] rounded-[5px] overflow-hidden bg-[#F5F4F2] border border-black/[0.06] flex-shrink-0">
                            <img src="/img/banner/{{ $banner->gambar }}"
                                 alt="{{ $banner->judul }}"
                                 class="w-full h-full object-cover">
                        </div>
                    </td>

                    {{-- Judul --}}
                    <td class="px-4 py-[10px]">
                        <span class="text-[12.5px] font-medium text-[#121212] truncate block">{{ $banner->judul }}</span>
                    </td>

                    {{-- Urutan --}}
                    <td class="px-4 py-[10px] text-center">
                        <span class="inline-flex items-center justify-center w-[26px] h-[26px] rounded-[5px] bg-[#F5F4F2] text-[10.5px] font-medium text-[#888]">
                            {{ $banner->urutan }}
                        </span>
                    </td>

                    {{-- Status toggle --}}
                    <td class="px-4 py-[10px] text-center">
                        <form action="{{ route('admin.banner.toggle', $banner->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 text-[10.5px] font-medium px-2.5 py-[3px] rounded-[4px] border transition-colors cursor-pointer
                                           {{ $banner->aktif
                                               ? 'bg-[#F0FDF4] text-[#16A34A] border-[#16A34A]/20 hover:bg-[#DCFCE7]'
                                               : 'bg-[#F5F4F2] text-[#999] border-black/[0.08] hover:bg-[#EDECEA]' }}">
                                <i class="bi {{ $banner->aktif ? 'bi-check-circle-fill' : 'bi-circle' }} text-[10px]"></i>
                                {{ $banner->aktif ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center justify-center gap-[3px]">
                            <a href="{{ route('admin.banner.edit', $banner->id) }}"
                               title="Edit"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                                <i class="bi bi-pencil text-[12px]"></i>
                            </a>
                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus banner ini?')"
                                  style="display:contents">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        title="Hapus"
                                        class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#FEF0F0] hover:text-[#E24B4A] transition-colors cursor-pointer bg-transparent">
                                    <i class="bi bi-trash text-[12px]"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center">
                        <i class="bi bi-images text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Belum ada banner terdaftar.</p>
                        <a href="{{ route('admin.banner.create') }}"
                           class="inline-flex items-center gap-1 mt-2.5 text-[12px] text-[#FF6B00] hover:underline">
                            <i class="bi bi-plus-lg"></i> Tambah banner pertama
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
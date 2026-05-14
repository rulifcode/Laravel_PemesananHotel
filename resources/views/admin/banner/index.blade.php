@extends('layouts.app')
@section('title', 'Manajemen Banner')
@section('content')

<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Manajemen Banner</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola banner yang tampil di halaman utama</p>
    </div>
    <a href="{{ route('admin.banner.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-plus-lg text-sm"></i> Tambah Banner
    </a>
</div>

@if(session('success'))
<div class="flex items-center gap-2 bg-[#F0FDF4] border border-[#16A34A]/20 text-[#16A34A] text-[12.5px] px-4 py-2.5 rounded-[8px] mb-4">
    <i class="bi bi-check-circle-fill"></i>
    {{ session('success') }}
    <button onclick="this.parentElement.remove()" class="ml-auto text-[#16A34A]/60 hover:text-[#16A34A]"><i class="bi bi-x"></i></button>
</div>
@endif

<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
    <div class="px-5 py-3.5 border-b border-black/[0.06] flex items-center justify-between">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Banner</span>
        <span class="text-[11.5px] text-[#999]">{{ $banners->count() }} banner terdaftar</span>
    </div>

    <table class="w-full">
        <thead>
            <tr class="border-b border-black/[0.06] bg-[#FAFAF9]">
                <th class="text-left text-[11px] font-medium text-[#999] uppercase tracking-wide px-5 py-2.5 w-8">#</th>
                <th class="text-left text-[11px] font-medium text-[#999] uppercase tracking-wide px-5 py-2.5 w-28">Gambar</th>
                <th class="text-left text-[11px] font-medium text-[#999] uppercase tracking-wide px-5 py-2.5">Judul</th>
                <th class="text-left text-[11px] font-medium text-[#999] uppercase tracking-wide px-5 py-2.5 w-20">Urutan</th>
                <th class="text-left text-[11px] font-medium text-[#999] uppercase tracking-wide px-5 py-2.5 w-24">Status</th>
                <th class="text-left text-[11px] font-medium text-[#999] uppercase tracking-wide px-5 py-2.5 w-20">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-black/[0.04]">
            @forelse($banners as $i => $banner)
            <tr class="hover:bg-[#FAFAF9] transition-colors">
                <td class="px-5 py-3 text-[12px] text-[#999]">{{ $i + 1 }}</td>

                {{-- Thumbnail --}}
                <td class="px-5 py-3">
                    <div class="w-20 h-12 rounded-[6px] overflow-hidden bg-[#F0EFED] flex items-center justify-center">
                        @if($banner->media)
                            @if($banner->isVideo())
                                <video src="{{ asset('img/banner/' . $banner->media) }}"
                                       class="w-full h-full object-cover" muted playsinline preload="metadata"></video>
                            @else
                                <img src="{{ asset('img/banner/' . $banner->media) }}"
                                     alt="{{ $banner->judul }}"
                                     class="w-full h-full object-cover">
                            @endif
                        @else
                            <i class="bi bi-image text-[#ccc] text-lg"></i>
                        @endif
                    </div>
                </td>

                <td class="px-5 py-3">
                    <p class="text-[12.5px] font-medium text-[#121212]">{{ $banner->judul }}</p>
                    @if($banner->link)
                        <p class="text-[11px] text-[#999] mt-0.5 truncate max-w-xs">{{ $banner->link }}</p>
                    @endif
                    {{-- Badge tipe --}}
                    @if($banner->tipe === 'video')
                        <span class="inline-flex items-center gap-1 text-[10px] font-medium text-[#3B82F6] bg-[#EFF6FF] px-1.5 py-0.5 rounded mt-1">
                            <i class="bi bi-play-circle"></i> Video
                        </span>
                    @elseif($banner->tipe === 'gif')
                        <span class="inline-flex items-center gap-1 text-[10px] font-medium text-[#D97706] bg-[#FFFBEB] px-1.5 py-0.5 rounded mt-1">
                            <i class="bi bi-file-image"></i> GIF
                        </span>
                    @endif
                </td>

                <td class="px-5 py-3 text-[12px] text-[#464646]">
                    <span class="inline-block border border-black/[0.08] rounded-[5px] px-2 py-0.5 text-[11.5px] text-[#464646] bg-[#FAFAF9]">
                        {{ $banner->urutan }}
                    </span>
                </td>

                <td class="px-5 py-3">
                    <form action="{{ route('admin.banner.toggle', $banner->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="inline-flex items-center gap-1 text-[11.5px] font-medium px-2.5 py-1 rounded-[5px] transition-colors
                                       {{ $banner->aktif
                                            ? 'text-[#16A34A] bg-[#F0FDF4] border border-[#16A34A]/20 hover:bg-[#DCFCE7]'
                                            : 'text-[#999] bg-[#F5F4F2] border border-black/[0.08] hover:bg-[#EEEDEB]' }}">
                            <i class="bi bi-{{ $banner->aktif ? 'check-circle-fill' : 'pause-circle' }}"></i>
                            {{ $banner->aktif ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </td>

                <td class="px-5 py-3">
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.banner.edit', $banner->id) }}"
                           class="inline-flex items-center justify-center w-7 h-7 rounded-[5px] border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] transition-colors">
                            <i class="bi bi-pencil text-[11px]"></i>
                        </a>
                        <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                              onsubmit="return confirm('Hapus banner ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center justify-center w-7 h-7 rounded-[5px] border border-black/[0.08] bg-white hover:bg-[#FEF0F0] hover:border-[#E24B4A]/20 text-[#999] hover:text-[#E24B4A] transition-colors">
                                <i class="bi bi-trash text-[11px]"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center">
                    <i class="bi bi-image text-3xl text-[#ddd] block mb-2"></i>
                    <p class="text-[12.5px] text-[#999]">Belum ada banner. Klik <strong>Tambah Banner</strong> untuk mulai.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
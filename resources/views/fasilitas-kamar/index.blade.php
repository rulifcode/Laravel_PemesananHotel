@extends('layouts.app')

@section('title', 'Fasilitas Kamar')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Fasilitas Kamar</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola semua fasilitas tiap kamar hotel</p>
    </div>
    <a href="{{ route('fasilitas-kamar.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors flex-shrink-0">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah Fasilitas
    </a>
</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Fasilitas</span>
        @if ($fasilitasKamars->count() > 0)
            <span class="text-[11px] text-[#aaa]">
                {{ $fasilitasKamars->count() }} fasilitas terdaftar
            </span>
        @endif
    </div>

    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-14">No.</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-44">Kamar</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Nama Fasilitas</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fasilitasKamars as $i => $fas)
                <tr class="border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- No Kamar (ID) --}}
                    <td class="px-4 py-[10px]">
                        <span class="inline-flex items-center justify-center w-[26px] h-[26px] rounded-[5px] bg-[#F5F4F2] text-[10.5px] font-medium text-[#888]">
                            {{ $fas->kamar->id ?? '-' }}
                        </span>
                    </td>

                    {{-- Kamar badge --}}
                    <td class="px-4 py-[10px]">
                        @php
                            $tipe = strtolower($fas->kamar->tipe_kamar ?? '');
                            if ($tipe === 'suite')                      $badgeKamar = 'bg-[#FFF0E6] text-[#FF6B00]';
                            elseif ($tipe === 'deluxe')                 $badgeKamar = 'bg-[#EDECEA] text-[#464646]';
                            elseif ($tipe === 'family')                 $badgeKamar = 'bg-[#EDF5FF] text-[#3B82F6]';
                            elseif ($tipe === 'superior')               $badgeKamar = 'bg-[#F0FDF4] text-[#16A34A]';
                            elseif (in_array($tipe, ['standard','standar'])) $badgeKamar = 'bg-[#F5F4F2] text-[#888]';
                            else                                        $badgeKamar = 'bg-[#F5F4F2] text-[#888]';
                        @endphp
                        <div>
                            <div class="text-[12.5px] font-medium text-[#121212]">
                                {{ $fas->kamar->nama_kamar ?? '-' }}
                            </div>
                            @if ($fas->kamar)
                                <span class="inline-block text-[10px] font-medium px-[6px] py-[1px] rounded-[3px] mt-0.5 {{ $badgeKamar }}">
                                    {{ $fas->kamar->tipe_kamar }}
                                </span>
                            @endif
                        </div>
                    </td>

                    {{-- Nama Fasilitas + icon --}}
                    <td class="px-4 py-[10px]">
                        @php
                            $nama = strtolower($fas->nama_fasilitas ?? '');
                            if (str_contains($nama, 'ac') || str_contains($nama, 'pendingin'))   $icon = 'bi-wind';
                            elseif (str_contains($nama, 'tv') || str_contains($nama, 'televisi')) $icon = 'bi-tv';
                            elseif (str_contains($nama, 'wifi') || str_contains($nama, 'internet')) $icon = 'bi-wifi';
                            elseif (str_contains($nama, 'kulkas'))                                $icon = 'bi-box';
                            elseif (str_contains($nama, 'kamar mandi') || str_contains($nama, 'shower')) $icon = 'bi-droplet';
                            elseif (str_contains($nama, 'parkir'))                               $icon = 'bi-p-square';
                            elseif (str_contains($nama, 'kolam') || str_contains($nama, 'pool')) $icon = 'bi-water';
                            elseif (str_contains($nama, 'sarapan') || str_contains($nama, 'breakfast')) $icon = 'bi-cup-hot';
                            else                                                                  $icon = 'bi-check-circle';
                        @endphp
                        <div class="inline-flex items-center gap-2">
                            <div class="w-[26px] h-[26px] rounded-[5px] bg-[#F5F4F2] flex items-center justify-center flex-shrink-0">
                                <i class="bi {{ $icon }} text-[#888] text-[12px]"></i>
                            </div>
                            <span class="text-[12.5px] text-[#464646]">{{ $fas->nama_fasilitas }}</span>
                        </div>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center justify-center gap-[3px]">
                            <a href="{{ route('fasilitas-kamar.edit', $fas->id) }}"
                               title="Edit"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                                <i class="bi bi-pencil text-[12px]"></i>
                            </a>
                            <form action="{{ route('fasilitas-kamar.destroy', $fas->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus fasilitas ini?')"
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
                    <td colspan="5" class="px-4 py-12 text-center">
                        <i class="bi bi-clipboard-x text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Belum ada data fasilitas.</p>
                        <a href="{{ route('fasilitas-kamar.create') }}"
                           class="inline-flex items-center gap-1 mt-2.5 text-[12px] text-[#FF6B00] hover:underline">
                            <i class="bi bi-plus-lg"></i> Tambah fasilitas pertama
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
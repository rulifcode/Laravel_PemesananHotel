@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Data Kamar</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola seluruh kamar hotel</p>
    </div>
    <a href="{{ route('kamar.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors flex-shrink-0">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah Kamar
    </a>
</div>

{{-- Stats Row --}}
@php
    $total  = $kamars->count();
    $suite  = $kamars->where('tipe_kamar', 'Suite')->count();
    $deluxe = $kamars->where('tipe_kamar', 'Deluxe')->count();
    $pctS   = $total ? round($suite  / $total * 100) : 0;
    $pctD   = $total ? round($deluxe / $total * 100) : 0;
@endphp

<div class="grid grid-cols-3 gap-3 mb-3.5">

    {{-- Total --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Total Kamar</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFF0E6] flex items-center justify-center">
                <i class="bi bi-door-open text-[#FF6B00] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $total }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Semua tipe kamar</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#FF6B00] rounded-full" style="width:100%"></div>
        </div>
    </div>

    {{-- Suite --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Suite</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFF0E6] flex items-center justify-center">
                <i class="bi bi-gem text-[#FF6B00] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $suite }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Kamar Suite</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#FF6B00] rounded-full" style="width:{{ $pctS }}%"></div>
        </div>
    </div>

    {{-- Deluxe --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Deluxe</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#EDECEA] flex items-center justify-center">
                <i class="bi bi-star text-[#464646] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $deluxe }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Kamar Deluxe</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#464646] rounded-full" style="width:{{ $pctD }}%"></div>
        </div>
    </div>

</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Kamar</span>
        <div class="flex gap-1">
            <button onclick="filterTipe(this, '')"
                    data-tipe=""
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-[#121212] text-white border-[#121212]">
                Semua
            </button>
            <button onclick="filterTipe(this, 'Suite')"
                    data-tipe="Suite"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Suite
            </button>
            <button onclick="filterTipe(this, 'Deluxe')"
                    data-tipe="Deluxe"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Deluxe
            </button>
            <button onclick="filterTipe(this, 'Standard')"
                    data-tipe="Standard"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Standard
            </button>
        </div>
    </div>

    {{-- Table --}}
    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-14">Foto</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Nama Kamar</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Tipe</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-36">Harga / Malam</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kamars as $i => $kamar)
                <tr class="kamar-row border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors"
                    data-tipe="{{ $kamar->tipe_kamar }}">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- Foto --}}
                    <td class="px-4 py-[10px]">
                        @if ($kamar->foto)
                            <img src="{{ asset('img/kamar/' . $kamar->foto) }}"
                                 alt="{{ $kamar->nama_kamar }}"
                                 class="w-11 h-[34px] object-cover rounded-[5px] block">
                        @else
                            <div class="w-11 h-[34px] bg-[#F0EDE8] rounded-[5px] flex items-center justify-center">
                                <i class="bi bi-image text-[#ccc] text-sm"></i>
                            </div>
                        @endif
                    </td>

                    {{-- Nama + deskripsi --}}
                    <td class="px-4 py-[10px]">
                        <div class="text-[12.5px] font-medium text-[#121212]">{{ $kamar->nama_kamar }}</div>
                        @if ($kamar->deskripsi)
                            <div class="text-[10px] text-[#bbb] mt-0.5 truncate max-w-[220px]">{{ $kamar->deskripsi }}</div>
                        @endif
                    </td>

                    {{-- Tipe badge --}}
                    <td class="px-4 py-[10px]">
                        @php
                            $t = $kamar->tipe_kamar;
                            if ($t === 'Suite')         $badge = 'bg-[#FFF0E6] text-[#FF6B00]';
                            elseif ($t === 'Deluxe')    $badge = 'bg-[#EDECEA] text-[#464646]';
                            elseif ($t === 'Family')    $badge = 'bg-[#EDF5FF] text-[#3B82F6]';
                            elseif ($t === 'Superior')  $badge = 'bg-[#F0FDF4] text-[#16A34A]';
                            else                        $badge = 'bg-[#F5F4F2] text-[#888]';
                        @endphp
                        <span class="inline-block text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] {{ $badge }}">
                            {{ $kamar->tipe_kamar }}
                        </span>
                    </td>

                    {{-- Harga --}}
                    <td class="px-4 py-[10px] text-[12.5px] font-medium text-[#121212]">
                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center justify-center gap-[3px]">
                            <a href="{{ route('kamar.edit', $kamar->id) }}"
                               title="Edit"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                                <i class="bi bi-pencil text-[12px]"></i>
                            </a>
                            <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus kamar ini?')"
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
                        <i class="bi bi-door-closed text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Belum ada data kamar.</p>
                        <a href="{{ route('kamar.create') }}"
                           class="inline-flex items-center gap-1 mt-2.5 text-[12px] text-[#FF6B00] hover:underline">
                            <i class="bi bi-plus-lg"></i> Tambah kamar pertama
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection

@push('scripts')
<script>
function filterTipe(btn, tipe) {
    document.querySelectorAll('.pill-btn').forEach(b => {
        b.classList.remove('bg-[#121212]', 'text-white', 'border-[#121212]');
        b.classList.add('bg-transparent', 'text-[#888]', 'border-black/[0.08]');
    });
    btn.classList.remove('bg-transparent', 'text-[#888]', 'border-black/[0.08]');
    btn.classList.add('bg-[#121212]', 'text-white', 'border-[#121212]');

    document.querySelectorAll('.kamar-row').forEach(row => {
        row.style.display = (!tipe || row.dataset.tipe === tipe) ? '' : 'none';
    });
}
</script>
@endpush
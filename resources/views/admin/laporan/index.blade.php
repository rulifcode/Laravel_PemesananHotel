@extends('layouts.app')

@section('title', 'Laporan & Statistik')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Laporan & Statistik</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Ringkasan data pesanan dan pendapatan hotel</p>
    </div>
    {{-- Filter Bulan --}}
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex items-center gap-2">
        <input type="month" name="bulan" value="{{ $bulan }}"
               class="text-[12px] text-[#121212] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-[7px] outline-none focus:border-[#FF6B00] focus:bg-white transition-colors">
        <button type="submit"
                class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors flex-shrink-0">
            <i class="bi bi-search text-[11px]"></i>
            Filter
        </button>
    </form>
</div>

{{-- Stat Cards Row 1 --}}
<div class="grid grid-cols-4 gap-3 mb-4">

    {{-- Total Pendapatan --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5">
        <p class="text-[11px] text-[#aaa] mb-1">Total Pendapatan</p>
        <p class="text-[15px] font-semibold text-[#16A34A]">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        <div class="mt-2 w-6 h-6 rounded-[5px] bg-[#F0FDF4] flex items-center justify-center">
            <i class="bi bi-cash-stack text-[#16A34A] text-[12px]"></i>
        </div>
    </div>

    {{-- Total Pesanan --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5">
        <p class="text-[11px] text-[#aaa] mb-1">Total Pesanan</p>
        <p class="text-[15px] font-semibold text-[#121212]">{{ $totalPesanan }}</p>
        <div class="mt-2 w-6 h-6 rounded-[5px] bg-[#F5F4F2] flex items-center justify-center">
            <i class="bi bi-receipt text-[#888] text-[12px]"></i>
        </div>
    </div>

    {{-- Total Kamar --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5">
        <p class="text-[11px] text-[#aaa] mb-1">Total Kamar</p>
        <p class="text-[15px] font-semibold text-[#3B82F6]">{{ $totalKamar }}</p>
        <div class="mt-2 w-6 h-6 rounded-[5px] bg-[#EDF5FF] flex items-center justify-center">
            <i class="bi bi-door-closed text-[#3B82F6] text-[12px]"></i>
        </div>
    </div>

    {{-- Total Staff --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5">
        <p class="text-[11px] text-[#aaa] mb-1">Total Staff</p>
        <p class="text-[15px] font-semibold text-[#D97706]">{{ $totalUser }}</p>
        <div class="mt-2 w-6 h-6 rounded-[5px] bg-[#FFFBEB] flex items-center justify-center">
            <i class="bi bi-people text-[#D97706] text-[12px]"></i>
        </div>
    </div>

</div>

{{-- Stat Cards Row 2 — Status Pesanan --}}
<div class="grid grid-cols-3 gap-3 mb-5">

    {{-- Pending --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5 flex items-center gap-3">
        <div class="w-9 h-9 rounded-[7px] bg-[#FFFBEB] flex items-center justify-center flex-shrink-0">
            <i class="bi bi-hourglass-split text-[#D97706] text-[15px]"></i>
        </div>
        <div>
            <p class="text-[11px] text-[#aaa]">Pending</p>
            <p class="text-[18px] font-semibold text-[#D97706] leading-tight">{{ $pesananPending }}</p>
        </div>
    </div>

    {{-- Confirmed --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5 flex items-center gap-3">
        <div class="w-9 h-9 rounded-[7px] bg-[#F0FDF4] flex items-center justify-center flex-shrink-0">
            <i class="bi bi-check-circle text-[#16A34A] text-[15px]"></i>
        </div>
        <div>
            <p class="text-[11px] text-[#aaa]">Confirmed</p>
            <p class="text-[18px] font-semibold text-[#16A34A] leading-tight">{{ $pesananConfirmed }}</p>
        </div>
    </div>

    {{-- Cancelled --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] px-4 py-3.5 flex items-center gap-3">
        <div class="w-9 h-9 rounded-[7px] bg-[#FEF0F0] flex items-center justify-center flex-shrink-0">
            <i class="bi bi-x-circle text-[#E24B4A] text-[15px]"></i>
        </div>
        <div>
            <p class="text-[11px] text-[#aaa]">Cancelled</p>
            <p class="text-[18px] font-semibold text-[#E24B4A] leading-tight">{{ $pesananCancelled }}</p>
        </div>
    </div>

</div>

{{-- Detail Pesanan Table --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Detail Pesanan</span>
        <span class="text-[11px] text-[#aaa]">Bulan {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') }}</span>
    </div>

    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Pemesan</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-36">Kamar</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Cek In</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Cek Out</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-32">Total</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanans as $i => $p)
                <tr class="border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors">

                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    <td class="px-4 py-[10px]">
                        <span class="text-[12.5px] font-medium text-[#121212] truncate block">{{ $p->nama_pemesan }}</span>
                    </td>

                    <td class="px-4 py-[10px]">
                        <span class="text-[12.5px] text-[#464646] truncate block">{{ $p->kamar->nama_kamar ?? '-' }}</span>
                    </td>

                    <td class="px-4 py-[10px]">
                        <span class="text-[12px] text-[#464646]">{{ $p->cek_in }}</span>
                    </td>

                    <td class="px-4 py-[10px]">
                        <span class="text-[12px] text-[#464646]">{{ $p->cek_out }}</span>
                    </td>

                    <td class="px-4 py-[10px]">
                        <span class="text-[12.5px] font-medium text-[#121212]">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                    </td>

                    <td class="px-4 py-[10px] text-center">
                        @php
                            $statusStyle = match($p->status) {
                                'confirmed' => 'bg-[#F0FDF4] text-[#16A34A] border-[#16A34A]/20',
                                'pending'   => 'bg-[#FFFBEB] text-[#D97706] border-[#D97706]/20',
                                default     => 'bg-[#FEF0F0] text-[#E24B4A] border-[#E24B4A]/20',
                            };
                        @endphp
                        <span class="inline-block text-[10.5px] font-medium px-2 py-[2px] rounded-[4px] border {{ $statusStyle }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center">
                        <i class="bi bi-clipboard-x text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Tidak ada pesanan bulan ini.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Rekap Absensi Karyawan')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Rekap Absensi</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Pantau kehadiran seluruh karyawan</p>
    </div>
</div>

{{-- Stats Row --}}
@php
    $total  = $absensis->count();
    $hadir  = $absensis->where('status', 'hadir')->count();
    $izin   = $absensis->where('status', 'izin')->count();
    $alfa   = $absensis->where('status', 'alfa')->count();
    $pctH   = $total ? round($hadir / $total * 100) : 0;
    $pctI   = $total ? round($izin  / $total * 100) : 0;
    $pctA   = $total ? round($alfa  / $total * 100) : 0;
@endphp

<div class="grid grid-cols-4 gap-3 mb-3.5">

    {{-- Total --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Total Karyawan</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFF0E6] flex items-center justify-center">
                <i class="bi bi-people text-[#FF6B00] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $total }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Semua status</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#FF6B00] rounded-full w-full"></div>
        </div>
    </div>

    {{-- Hadir --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Hadir</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#F0FDF4] flex items-center justify-center">
                <i class="bi bi-check-circle text-[#16A34A] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $hadir }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Tepat waktu</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#16A34A] rounded-full" style="width:{{ $pctH }}%"></div>
        </div>
    </div>

    {{-- Izin --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Izin</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFFBEB] flex items-center justify-center">
                <i class="bi bi-calendar-minus text-[#D97706] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $izin }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Dengan keterangan</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#D97706] rounded-full" style="width:{{ $pctI }}%"></div>
        </div>
    </div>

    {{-- Alfa --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Alfa</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FEF2F2] flex items-center justify-center">
                <i class="bi bi-x-circle text-[#E24B4A] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $alfa }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Tanpa keterangan</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#E24B4A] rounded-full" style="width:{{ $pctA }}%"></div>
        </div>
    </div>

</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header + Filter --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Absensi</span>

        <form method="GET" action="{{ route('admin.absensi.index') }}"
              class="flex items-center gap-2">
            <input type="date" name="tanggal"
                   value="{{ $tanggal }}"
                   class="text-[12px] text-[#121212] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-[5px] outline-none focus:border-[#FF6B00] transition-colors">
            <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12px] font-medium px-3 py-[5px] rounded-[7px] transition-colors">
                <i class="bi bi-search text-[11px]"></i>
                Filter
            </button>
            <a href="{{ route('admin.absensi.index') }}"
               class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12px] font-medium px-3 py-[5px] rounded-[7px] transition-colors">
                <i class="bi bi-arrow-counterclockwise text-[11px]"></i>
                Reset
            </a>
        </form>
    </div>

    {{-- Table --}}
    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Nama Karyawan</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-32">Tanggal</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-28">Jam Masuk</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-28">Jam Keluar</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Status</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-40">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensis as $i => $absensi)
                <tr class="border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- Nama --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center gap-2.5">
                            <div class="w-[28px] h-[28px] rounded-full bg-[#EDECEA] flex items-center justify-center shrink-0">
                                <span class="text-[11px] font-medium text-[#464646]">
                                    {{ strtoupper(substr($absensi->user->name ?? '?', 0, 1)) }}
                                </span>
                            </div>
                            <span class="text-[12.5px] font-medium text-[#121212]">
                                {{ $absensi->user->name ?? '—' }}
                            </span>
                        </div>
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-4 py-[10px] text-[12.5px] text-[#464646]">
                        {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}
                    </td>

                    {{-- Jam Masuk --}}
                    <td class="px-4 py-[10px] text-center">
                        @if($absensi->jam_masuk)
                            <span class="text-[12.5px] font-medium text-[#121212]">{{ $absensi->jam_masuk }}</span>
                        @else
                            <span class="text-[12px] text-[#ccc]">—</span>
                        @endif
                    </td>

                    {{-- Jam Keluar --}}
                    <td class="px-4 py-[10px] text-center">
                        @if($absensi->jam_keluar)
                            <span class="text-[12.5px] font-medium text-[#121212]">{{ $absensi->jam_keluar }}</span>
                        @else
                            <span class="text-[12px] text-[#ccc]">—</span>
                        @endif
                    </td>

                    {{-- Status badge --}}
                    <td class="px-4 py-[10px] text-center">
                        @php
                            $badge = match($absensi->status) {
                                'hadir' => 'bg-[#F0FDF4] text-[#16A34A]',
                                'izin'  => 'bg-[#FFFBEB] text-[#D97706]',
                                'alfa'  => 'bg-[#FEF2F2] text-[#E24B4A]',
                                default => 'bg-[#F5F4F2] text-[#888]',
                            };
                        @endphp
                        <span class="inline-block text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] {{ $badge }}">
                            {{ ucfirst($absensi->status) }}
                        </span>
                    </td>

                    {{-- Keterangan --}}
                    <td class="px-4 py-[10px] text-[12px] text-[#888] truncate">
                        {{ $absensi->keterangan ?? '—' }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center">
                        <i class="bi bi-calendar-x text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Tidak ada data absensi untuk tanggal ini.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
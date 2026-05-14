@extends('layouts.app')

@section('title', 'Data Pesanan')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Data Pesanan</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola semua pesanan tamu</p>
    </div>
    <a href="{{ route('pesanan.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah Pesanan
    </a>
</div>

{{-- Stats Row --}}
@php
    $total     = $pesanans->count();
    $pending   = $pesanans->where('status', 'pending')->count();
    $konfirm   = $pesanans->where('status', 'konfirmasi')->count();
    $batal     = $pesanans->where('status', 'batal')->count();
    $pctP      = $total ? round($pending / $total * 100) : 0;
    $pctK      = $total ? round($konfirm / $total * 100) : 0;
    $pctB      = $total ? round($batal   / $total * 100) : 0;
@endphp

<div class="grid grid-cols-4 gap-3 mb-3.5">

    {{-- Total --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Total Pesanan</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFF0E6] flex items-center justify-center">
                <i class="bi bi-calendar-check text-[#FF6B00] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $total }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Semua status</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#FF6B00] rounded-full w-full"></div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Pending</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFFBEB] flex items-center justify-center">
                <i class="bi bi-hourglass-split text-[#D97706] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $pending }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Menunggu konfirmasi</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#D97706] rounded-full" style="width:{{ $pctP }}%"></div>
        </div>
    </div>

    {{-- Konfirmasi --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Dikonfirmasi</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#F0FDF4] flex items-center justify-center">
                <i class="bi bi-check-circle text-[#16A34A] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $konfirm }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Pesanan aktif</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#16A34A] rounded-full" style="width:{{ $pctK }}%"></div>
        </div>
    </div>

    {{-- Batal --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Dibatalkan</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FEF2F2] flex items-center justify-center">
                <i class="bi bi-x-circle text-[#E24B4A] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $batal }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Pesanan batal</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#E24B4A] rounded-full" style="width:{{ $pctB }}%"></div>
        </div>
    </div>

</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Pesanan</span>
        <div class="flex gap-1">
            <button onclick="filterStatus(this, '')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-[#121212] text-white border-[#121212]">
                Semua
            </button>
            <button onclick="filterStatus(this, 'pending')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Pending
            </button>
            <button onclick="filterStatus(this, 'konfirmasi')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Konfirmasi
            </button>
            <button onclick="filterStatus(this, 'batal')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Batal
            </button>
        </div>
    </div>

    {{-- Table --}}
    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Nama Pemesan</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-32">Kamar</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-28">Check In</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-28">Check Out</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-16">Jml</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-28">Status</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanans as $i => $pesanan)
                <tr class="pesanan-row border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors"
                    data-status="{{ $pesanan->status }}">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- Nama + email --}}
                    <td class="px-4 py-[10px]">
                        <div class="text-[12.5px] font-medium text-[#121212]">{{ $pesanan->nama_pemesan }}</div>
                        @if($pesanan->email_pemesan)
                            <div class="text-[10px] text-[#bbb] mt-0.5 truncate">{{ $pesanan->email_pemesan }}</div>
                        @endif
                    </td>

                    {{-- Kamar --}}
                    <td class="px-4 py-[10px] text-[12.5px] text-[#464646]">
                        {{ $pesanan->kamar->nama_kamar ?? '-' }}
                    </td>

                    {{-- Check In --}}
                    <td class="px-4 py-[10px] text-[12.5px] text-[#464646]">
                        {{ \Carbon\Carbon::parse($pesanan->cek_in)->format('d M Y') }}
                    </td>

                    {{-- Check Out --}}
                    <td class="px-4 py-[10px] text-[12.5px] text-[#464646]">
                        {{ \Carbon\Carbon::parse($pesanan->cek_out)->format('d M Y') }}
                    </td>

                    {{-- Jumlah --}}
                    <td class="px-4 py-[10px] text-center text-[12.5px] text-[#464646]">
                        {{ $pesanan->jml_kamar }}
                    </td>

                    {{-- Status badge --}}
                    <td class="px-4 py-[10px] text-center">
                        @php
                            $badge = match($pesanan->status) {
                                'pending'    => 'bg-[#FFFBEB] text-[#D97706]',
                                'konfirmasi' => 'bg-[#F0FDF4] text-[#16A34A]',
                                'batal'      => 'bg-[#FEF2F2] text-[#E24B4A]',
                                default      => 'bg-[#F5F4F2] text-[#888]',
                            };
                        @endphp
                        <span class="inline-block text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] {{ $badge }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center justify-center gap-[3px]">
                            <a href="{{ route('pesanan.show', $pesanan->id) }}"
                               title="Detail"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#EDF5FF] hover:text-[#3B82F6] hover:border-[#3B82F6]/20 transition-colors">
                                <i class="bi bi-eye text-[12px]"></i>
                            </a>
                            <a href="{{ route('pesanan.edit', $pesanan->id) }}"
                               title="Edit"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                                <i class="bi bi-pencil text-[12px]"></i>
                            </a>
                            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')"
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
                    <td colspan="8" class="px-4 py-12 text-center">
                        <i class="bi bi-calendar-x text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Belum ada data pesanan.</p>
                        <a href="{{ route('pesanan.create') }}"
                           class="inline-flex items-center gap-1 mt-2.5 text-[12px] text-[#FF6B00] hover:underline">
                            <i class="bi bi-plus-lg"></i> Tambah pesanan pertama
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
function filterStatus(btn, status) {
    document.querySelectorAll('.pill-btn').forEach(b => {
        b.classList.remove('bg-[#121212]', 'text-white', 'border-[#121212]');
        b.classList.add('bg-transparent', 'text-[#888]', 'border-black/[0.08]');
    });
    btn.classList.remove('bg-transparent', 'text-[#888]', 'border-black/[0.08]');
    btn.classList.add('bg-[#121212]', 'text-white', 'border-[#121212]');

    document.querySelectorAll('.pesanan-row').forEach(row => {
        row.style.display = (!status || row.dataset.status === status) ? '' : 'none';
    });
}
</script>
@endpush
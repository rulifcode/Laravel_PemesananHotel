@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Detail Pesanan</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Informasi lengkap pesanan #{{ $pesanan->id }}</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('pesanan.edit', $pesanan->id) }}"
           class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
            <i class="bi bi-pencil text-sm"></i>
            Edit
        </a>
        <a href="{{ route('pesanan.index') }}"
           class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
            <i class="bi bi-arrow-left text-sm"></i>
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">

    {{-- Kolom Kiri: Data Tamu + Kamar --}}
    <div class="flex flex-col gap-4">

        {{-- Data Tamu --}}
        <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
            <div class="px-5 py-3.5 border-b border-black/[0.06]">
                <span class="text-[13px] font-medium text-[#121212]">Data Tamu</span>
            </div>
            <div class="p-5 flex flex-col gap-4">

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Nama Tamu</span>
                    <span class="text-[13px] text-[#121212] font-medium">{{ $pesanan->nama_tamu }}</span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">No. HP</span>
                    <span class="text-[13px] text-[#464646]">{{ $pesanan->no_hp ?? '—' }}</span>
                </div>

                @if($pesanan->keterangan)
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Keterangan</span>
                    <span class="text-[12.5px] text-[#464646] leading-relaxed">{{ $pesanan->keterangan }}</span>
                </div>
                @endif

            </div>
        </div>

        {{-- Data Kamar --}}
        <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
            <div class="px-5 py-3.5 border-b border-black/[0.06]">
                <span class="text-[13px] font-medium text-[#121212]">Data Kamar</span>
            </div>
            <div class="p-5 flex flex-col gap-4">

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Nomor Kamar</span>
                    <span class="text-[13px] text-[#121212] font-medium">{{ $pesanan->kamar->nomor_kamar ?? '—' }}</span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Tipe Kamar</span>
                    @php
                        $tipe  = $pesanan->kamar->tipe ?? null;
                        $badge = match($tipe) {
                            'Suite'    => 'bg-[#FFF0E6] text-[#FF6B00]',
                            'Deluxe'   => 'bg-[#EDECEA] text-[#464646]',
                            'Family'   => 'bg-[#EDF5FF] text-[#3B82F6]',
                            'Superior' => 'bg-[#F0FDF4] text-[#16A34A]',
                            default    => 'bg-[#F5F4F2] text-[#888]',
                        };
                    @endphp
                    @if($tipe)
                        <span class="inline-block self-start text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] {{ $badge }}">
                            {{ $tipe }}
                        </span>
                    @else
                        <span class="text-[13px] text-[#464646]">—</span>
                    @endif
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Total Harga</span>
                    <span class="text-[17px] font-medium text-[#121212]">
                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </span>
                </div>

            </div>
        </div>

    </div>

    {{-- Kolom Kanan: Jadwal + Status --}}
    <div class="flex flex-col gap-4">

        {{-- Jadwal Menginap --}}
        <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
            <div class="px-5 py-3.5 border-b border-black/[0.06]">
                <span class="text-[13px] font-medium text-[#121212]">Jadwal Menginap</span>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-2 gap-3">

                    <div class="bg-[#FAFAF9] border border-black/[0.06] rounded-[8px] p-3.5">
                        <div class="flex items-center gap-1.5 mb-2">
                            <i class="bi bi-box-arrow-in-right text-[#FF6B00] text-[13px]"></i>
                            <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Check In</span>
                        </div>
                        <p class="text-[14px] font-medium text-[#121212]">
                            {{ \Carbon\Carbon::parse($pesanan->check_in)->format('d M Y') }}
                        </p>
                        <p class="text-[10.5px] text-[#aaa] mt-0.5">
                            {{ \Carbon\Carbon::parse($pesanan->check_in)->translatedFormat('l') }}
                        </p>
                    </div>

                    <div class="bg-[#FAFAF9] border border-black/[0.06] rounded-[8px] p-3.5">
                        <div class="flex items-center gap-1.5 mb-2">
                            <i class="bi bi-box-arrow-right text-[#464646] text-[13px]"></i>
                            <span class="text-[10.5px] text-[#aaa] font-medium uppercase tracking-[0.06em]">Check Out</span>
                        </div>
                        <p class="text-[14px] font-medium text-[#121212]">
                            {{ \Carbon\Carbon::parse($pesanan->check_out)->format('d M Y') }}
                        </p>
                        <p class="text-[10.5px] text-[#aaa] mt-0.5">
                            {{ \Carbon\Carbon::parse($pesanan->check_out)->translatedFormat('l') }}
                        </p>
                    </div>

                </div>

                @php
                    $nights = \Carbon\Carbon::parse($pesanan->check_in)
                                ->diffInDays(\Carbon\Carbon::parse($pesanan->check_out));
                @endphp
                <div class="mt-3 flex items-center gap-1.5 text-[11.5px] text-[#aaa]">
                    <i class="bi bi-moon text-[11px]"></i>
                    <span>Durasi menginap: <span class="font-medium text-[#464646]">{{ $nights }} malam</span></span>
                </div>
            </div>
        </div>

        {{-- Status Pesanan --}}
        <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
            <div class="px-5 py-3.5 border-b border-black/[0.06]">
                <span class="text-[13px] font-medium text-[#121212]">Status Pesanan</span>
            </div>
            <div class="p-5">

                {{-- Status saat ini --}}
                @php
                    $statusStyle = match($pesanan->status) {
                        'pending'    => ['bg-[#FFFBEB] text-[#D97706] border-[#D97706]/20', 'bi-hourglass-split', 'Menunggu konfirmasi dari admin'],
                        'konfirmasi' => ['bg-[#F0FDF4] text-[#16A34A] border-[#16A34A]/20', 'bi-check-circle', 'Pesanan telah dikonfirmasi'],
                        'batal'      => ['bg-[#FEF2F2] text-[#E24B4A] border-[#E24B4A]/20', 'bi-x-circle', 'Pesanan telah dibatalkan'],
                        default      => ['bg-[#F5F4F2] text-[#888] border-black/[0.08]', 'bi-circle', ''],
                    };
                @endphp
                <div class="flex items-center gap-3 p-3.5 rounded-[8px] border {{ $statusStyle[0] }} mb-4">
                    <i class="bi {{ $statusStyle[1] }} text-[18px]"></i>
                    <div>
                        <p class="text-[12.5px] font-medium">{{ ucfirst($pesanan->status) }}</p>
                        <p class="text-[11px] opacity-75">{{ $statusStyle[2] }}</p>
                    </div>
                </div>

                {{-- Form Update Status --}}
                <form action="{{ route('pesanan.status', $pesanan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <p class="text-[11px] text-[#aaa] mb-2">Ubah status pesanan:</p>
                    <div class="flex gap-2 mb-3">
                        @foreach(['pending' => ['bg-[#FFFBEB] border-[#D97706]/30 text-[#D97706]', 'bi-hourglass-split'],
                                  'konfirmasi' => ['bg-[#F0FDF4] border-[#16A34A]/30 text-[#16A34A]', 'bi-check-circle'],
                                  'batal'      => ['bg-[#FEF2F2] border-[#E24B4A]/30 text-[#E24B4A]', 'bi-x-circle']]
                                 as $val => [$colorClass, $icon])
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="{{ $val }}"
                                       {{ $pesanan->status === $val ? 'checked' : '' }}
                                       class="peer hidden">
                                <div class="flex flex-col items-center gap-1 border-2 rounded-[8px] py-2.5 px-2 transition-all
                                            border-black/[0.06] bg-[#FAFAF9] text-[#aaa]
                                            peer-checked:{{ $colorClass }}">
                                    <i class="bi {{ $icon }} text-[14px]"></i>
                                    <span class="text-[10.5px] font-medium">{{ ucfirst($val) }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[8px] rounded-[7px] transition-colors">
                        <i class="bi bi-arrow-repeat text-sm"></i>
                        Update Status
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
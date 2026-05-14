@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Edit Pesanan</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Perbarui detail pesanan tamu</p>
    </div>
    <a href="{{ route('pesanan.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

<form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-4">

        {{-- Kolom Kiri: Data Tamu --}}
        <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
            <div class="px-5 py-3.5 border-b border-black/[0.06]">
                <span class="text-[13px] font-medium text-[#121212]">Data Tamu</span>
            </div>
            <div class="p-5 flex flex-col gap-5">

                {{-- Nama Tamu --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Nama Tamu <span class="text-[#FF6B00]">*</span>
                    </label>
                    <input type="text" name="nama_tamu"
                           value="{{ old('nama_tamu', $pesanan->nama_tamu) }}"
                           placeholder="Nama lengkap tamu"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('nama_tamu') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @error('nama_tamu')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. HP --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        No. HP
                    </label>
                    <input type="text" name="no_hp"
                           value="{{ old('no_hp', $pesanan->no_hp) }}"
                           placeholder="cth. 08123456789"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('no_hp') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @error('no_hp')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Keterangan
                    </label>
                    <textarea name="keterangan" rows="3"
                              placeholder="Catatan atau permintaan khusus..."
                              class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-[8px] outline-none focus:border-[#FF6B00] focus:bg-white transition-colors resize-none">{{ old('keterangan', $pesanan->keterangan) }}</textarea>
                </div>

            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="flex flex-col gap-4">

            {{-- Card Detail Pemesanan --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
                <div class="px-5 py-3.5 border-b border-black/[0.06]">
                    <span class="text-[13px] font-medium text-[#121212]">Detail Pemesanan</span>
                </div>
                <div class="p-5 flex flex-col gap-5">

                    {{-- Pilih Kamar --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                            Kamar <span class="text-[#FF6B00]">*</span>
                        </label>
                        <select name="kamar_id"
                                class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors appearance-none cursor-pointer
                                       {{ $errors->has('kamar_id') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                            @foreach($kamars as $kamar)
                                <option value="{{ $kamar->id }}"
                                    {{ old('kamar_id', $pesanan->kamar_id) == $kamar->id ? 'selected' : '' }}>
                                    {{ $kamar->nomor_kamar }} — {{ $kamar->tipe }}
                                </option>
                            @endforeach
                        </select>
                        @error('kamar_id')
                            <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Check In & Check Out --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                                Check In <span class="text-[#FF6B00]">*</span>
                            </label>
                            <input type="date" name="check_in"
                                   value="{{ old('check_in', $pesanan->check_in) }}"
                                   class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                          {{ $errors->has('check_in') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                            @error('check_in')
                                <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                                Check Out <span class="text-[#FF6B00]">*</span>
                            </label>
                            <input type="date" name="check_out"
                                   value="{{ old('check_out', $pesanan->check_out) }}"
                                   class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                          {{ $errors->has('check_out') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                            @error('check_out')
                                <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Total Harga --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                            Total Harga <span class="text-[#FF6B00]">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[12px] text-[#aaa] font-medium pointer-events-none">Rp</span>
                            <input type="number" name="total_harga"
                                   value="{{ old('total_harga', $pesanan->total_harga) }}"
                                   placeholder="0"
                                   class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] pl-8 pr-3 py-[8px] outline-none transition-colors
                                          {{ $errors->has('total_harga') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                        </div>
                        @error('total_harga')
                            <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Card Status --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
                <div class="px-5 py-3.5 border-b border-black/[0.06]">
                    <span class="text-[13px] font-medium text-[#121212]">Status Pesanan</span>
                </div>
                <div class="p-5">
                    <div class="flex gap-2">
                        @foreach(['pending' => ['bg-[#FFFBEB] border-[#D97706]/30 text-[#D97706]', 'bi-hourglass-split'],
                                  'konfirmasi' => ['bg-[#F0FDF4] border-[#16A34A]/30 text-[#16A34A]', 'bi-check-circle'],
                                  'batal'      => ['bg-[#FEF2F2] border-[#E24B4A]/30 text-[#E24B4A]', 'bi-x-circle']]
                                 as $val => [$colorClass, $icon])
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="{{ $val }}"
                                       {{ old('status', $pesanan->status) === $val ? 'checked' : '' }}
                                       class="peer hidden">
                                <div class="flex flex-col items-center gap-1 border-2 rounded-[8px] py-3 px-2 transition-all
                                            border-black/[0.06] bg-[#FAFAF9] text-[#aaa]
                                            peer-checked:{{ $colorClass }}">
                                    <i class="bi {{ $icon }} text-[15px]"></i>
                                    <span class="text-[11px] font-medium">{{ ucfirst($val) }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] px-5 py-3.5 flex items-center justify-end gap-2">
                <a href="{{ route('pesanan.index') }}"
                   class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                    <i class="bi bi-check-lg text-sm"></i>
                    Simpan Perubahan
                </button>
            </div>

        </div>
    </div>

</form>

@endsection
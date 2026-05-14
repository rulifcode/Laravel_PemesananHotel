@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Tambah Pesanan</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Buat pesanan baru untuk tamu</p>
    </div>
    <a href="{{ route('pesanan.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

<form action="{{ route('pesanan.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-2 gap-4">

        {{-- Kolom Kiri: Data Pemesan --}}
        <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
            <div class="px-5 py-3.5 border-b border-black/[0.06]">
                <span class="text-[13px] font-medium text-[#121212]">Data Pemesan</span>
            </div>
            <div class="p-5 flex flex-col gap-5">

                {{-- Nama Pemesan --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Nama Pemesan <span class="text-[#FF6B00]">*</span>
                    </label>
                    <input type="text" name="nama_pemesan"
                           value="{{ old('nama_pemesan') }}"
                           placeholder="Nama lengkap pemesan"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('nama_pemesan') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @error('nama_pemesan')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Email Pemesan <span class="text-[#FF6B00]">*</span>
                    </label>
                    <input type="email" name="email_pemesan"
                           value="{{ old('email_pemesan') }}"
                           placeholder="contoh@email.com"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('email_pemesan') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @error('email_pemesan')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. HP --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        No. HP Pemesan <span class="text-[#FF6B00]">*</span>
                    </label>
                    <input type="text" name="hp_pemesan"
                           value="{{ old('hp_pemesan') }}"
                           placeholder="cth. 08123456789"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('hp_pemesan') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @error('hp_pemesan')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Tamu --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Nama Tamu <span class="text-[#FF6B00]">*</span>
                    </label>
                    <input type="text" name="nama_tamu"
                           value="{{ old('nama_tamu') }}"
                           placeholder="Nama tamu yang menginap"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('nama_tamu') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @error('nama_tamu')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-[10px] text-[#bbb] mt-1.5">Isi sama dengan pemesan jika tamu adalah pemesan itu sendiri.</p>
                </div>

            </div>
        </div>

        {{-- Kolom Kanan: Detail Pemesanan --}}
        <div class="flex flex-col gap-4">

            {{-- Card Kamar & Tanggal --}}
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
                            <option value="" disabled {{ old('kamar_id') ? '' : 'selected' }}>-- Pilih Kamar --</option>
                            @foreach($kamars as $kamar)
                                <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                                    {{ $kamar->nama_kamar }} — {{ $kamar->tipe_kamar }} (Rp {{ number_format($kamar->harga, 0, ',', '.') }})
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
                            <input type="date" name="cek_in"
                                   value="{{ old('cek_in') }}"
                                   class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                          {{ $errors->has('cek_in') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                            @error('cek_in')
                                <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                                Check Out <span class="text-[#FF6B00]">*</span>
                            </label>
                            <input type="date" name="cek_out"
                                   value="{{ old('cek_out') }}"
                                   class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                          {{ $errors->has('cek_out') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                            @error('cek_out')
                                <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Jumlah Kamar --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                            Jumlah Kamar <span class="text-[#FF6B00]">*</span>
                        </label>
                        <input type="number" name="jml_kamar"
                               value="{{ old('jml_kamar', 1) }}"
                               min="1"
                               class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                      {{ $errors->has('jml_kamar') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                        @error('jml_kamar')
                            <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Footer Actions (sticky di bawah kolom kanan) --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] px-5 py-3.5 flex items-center justify-end gap-2">
                <a href="{{ route('pesanan.index') }}"
                   class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                    <i class="bi bi-check-lg text-sm"></i>
                    Simpan Pesanan
                </button>
            </div>

        </div>
    </div>

</form>

@endsection
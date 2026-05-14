@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Tambah Kamar</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Isi data kamar baru</p>
    </div>
    <a href="{{ route('kamar.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    <div class="px-5 py-3.5 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Data Kamar</span>
    </div>

    <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="p-5 grid grid-cols-2 gap-x-6 gap-y-5">

            {{-- Nama Kamar --}}
            <div class="col-span-2 md:col-span-1">
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Nama Kamar <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="text" name="nama_kamar"
                       value="{{ old('nama_kamar') }}"
                       placeholder="cth. Kamar Deluxe 01"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('nama_kamar') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('nama_kamar')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipe Kamar --}}
            <div class="col-span-2 md:col-span-1">
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Tipe Kamar <span class="text-[#FF6B00]">*</span>
                </label>
                <select name="tipe_kamar"
                        class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors appearance-none cursor-pointer
                               {{ $errors->has('tipe_kamar') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    <option value="" disabled {{ old('tipe_kamar') ? '' : 'selected' }}>-- Pilih Tipe --</option>
                    @foreach(['Standard','Deluxe','Suite','Superior','Family'] as $t)
                        <option value="{{ $t }}" {{ old('tipe_kamar') === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
                @error('tipe_kamar')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="col-span-2 md:col-span-1">
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Harga per Malam <span class="text-[#FF6B00]">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[12px] text-[#aaa] font-medium select-none">Rp</span>
                    <input type="number" name="harga" min="0"
                           value="{{ old('harga') }}"
                           placeholder="300000"
                           class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] pl-9 pr-3 py-[8px] outline-none transition-colors
                                  {{ $errors->has('harga') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                </div>
                @error('harga')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto --}}
            <div class="col-span-2 md:col-span-1">
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">Foto Kamar</label>
                <label class="flex items-center gap-2.5 w-full bg-[#FAFAF9] border border-black/[0.08] border-dashed rounded-[7px] px-3 py-[8px] cursor-pointer hover:bg-[#F5F4F2] hover:border-[#FF6B00]/40 transition-colors group">
                    <i class="bi bi-cloud-upload text-[#ccc] group-hover:text-[#FF6B00] text-base transition-colors"></i>
                    <span class="text-[12px] text-[#bbb] group-hover:text-[#888] transition-colors" id="foto-label">
                        Pilih foto (jpg, png, webp)
                    </span>
                    <input type="file" name="foto" accept="image/*" class="hidden"
                           onchange="document.getElementById('foto-label').textContent = this.files[0]?.name ?? 'Pilih foto'">
                </label>
                @error('foto')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="col-span-2">
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          placeholder="Deskripsi singkat kamar, fasilitas unggulan, dll."
                          class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-2 outline-none resize-none focus:border-[#FF6B00] focus:bg-white transition-colors">{{ old('deskripsi') }}</textarea>
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="px-5 py-3.5 border-t border-black/[0.06] bg-[#FAFAF9] flex items-center justify-end gap-2">
            <a href="{{ route('kamar.index') }}"
               class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                <i class="bi bi-check-lg text-sm"></i>
                Simpan Kamar
            </button>
        </div>

    </form>
</div>

@endsection
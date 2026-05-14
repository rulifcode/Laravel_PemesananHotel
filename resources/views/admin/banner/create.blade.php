@extends('layouts.app')

@section('title', 'Tambah Banner')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Tambah Banner</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Tambah banner baru untuk halaman utama</p>
    </div>
    <a href="{{ route('admin.banner.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    <div class="px-5 py-3.5 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Data Banner</span>
    </div>

    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="p-5 flex flex-col gap-5">

            {{-- Judul --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Judul <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="text" name="judul"
                       value="{{ old('judul') }}"
                       placeholder="cth. Promo Akhir Tahun"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('judul') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('judul')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Gambar <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="file" name="gambar" accept="image/*"
                       class="w-full text-[12px] text-[#464646] bg-[#FAFAF9] border rounded-[7px] px-3 py-[7px] outline-none transition-colors cursor-pointer
                              file:mr-3 file:text-[11.5px] file:font-medium file:text-[#464646] file:bg-[#F0EFED] file:border-0 file:rounded-[5px] file:px-2.5 file:py-1 file:cursor-pointer hover:file:bg-[#E8E7E5]
                              {{ $errors->has('gambar') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('gambar')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
                <p class="text-[10px] text-[#bbb] mt-1.5">Format: JPG, PNG, WEBP. Maks. 2 MB. Rasio ideal 16:5.</p>
            </div>

            {{-- Link --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Link <span class="text-[11px] font-normal text-[#bbb]">(opsional)</span>
                </label>
                <input type="url" name="link"
                       value="{{ old('link') }}"
                       placeholder="https://..."
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('link') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('link')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Urutan --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Urutan
                </label>
                <input type="number" name="urutan"
                       value="{{ old('urutan', 0) }}"
                       min="0"
                       class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('urutan') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('urutan')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
                <p class="text-[10px] text-[#bbb] mt-1.5">Angka lebih kecil tampil lebih awal. Mulai dari 0.</p>
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="px-5 py-3.5 border-t border-black/[0.06] bg-[#FAFAF9] flex items-center justify-end gap-2">
            <a href="{{ route('admin.banner.index') }}"
               class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                <i class="bi bi-check-lg text-sm"></i>
                Simpan Banner
            </button>
        </div>

    </form>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Tambah Artikel</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Buat dan publikasikan artikel baru</p>
    </div>
    <a href="{{ route('admin.artikel.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    <div class="px-5 py-3.5 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Data Artikel</span>
    </div>

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="p-5 flex flex-col gap-5">

            {{-- Judul --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Judul <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="text" name="judul"
                       value="{{ old('judul') }}"
                       placeholder="cth. Promo Akhir Tahun Diskon 50%"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('judul') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('judul')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori & Status --}}
            <div class="grid grid-cols-2 gap-4">

                {{-- Kategori --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Kategori <span class="text-[#FF6B00]">*</span>
                    </label>
                    <select name="kategori"
                            class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors appearance-none cursor-pointer
                                   {{ $errors->has('kategori') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                        <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                        <option value="promo"  {{ old('kategori') == 'promo'  ? 'selected' : '' }}>Promo</option>
                        <option value="info"   {{ old('kategori') == 'info'   ? 'selected' : '' }}>Info</option>
                        <option value="event"  {{ old('kategori') == 'event'  ? 'selected' : '' }}>Event</option>
                    </select>
                    @error('kategori')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                        Status <span class="text-[#FF6B00]">*</span>
                    </label>
                    <select name="status"
                            class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors appearance-none cursor-pointer
                                   {{ $errors->has('status') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                        <option value="draft"     {{ old('status', 'draft') == 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Thumbnail --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Thumbnail
                </label>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full text-[12px] text-[#464646] bg-[#FAFAF9] border rounded-[7px] px-3 py-[7px] outline-none transition-colors cursor-pointer
                              file:mr-3 file:text-[11.5px] file:font-medium file:text-[#464646] file:bg-[#F0EFED] file:border-0 file:rounded-[5px] file:px-2.5 file:py-1 file:cursor-pointer hover:file:bg-[#E8E7E5]
                              {{ $errors->has('thumbnail') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('thumbnail')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
                <p class="text-[10px] text-[#bbb] mt-1.5">Format: JPG, PNG, WEBP. Maks. 2 MB.</p>
            </div>

            {{-- Konten --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Konten <span class="text-[#FF6B00]">*</span>
                </label>
                <textarea name="konten" rows="10"
                          placeholder="Tulis isi artikel di sini…"
                          class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors resize-y
                                 {{ $errors->has('konten') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="px-5 py-3.5 border-t border-black/[0.06] bg-[#FAFAF9] flex items-center justify-end gap-2">
            <a href="{{ route('admin.artikel.index') }}"
               class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                <i class="bi bi-check-lg text-sm"></i>
                Simpan Artikel
            </button>
        </div>

    </form>
</div>

@endsection
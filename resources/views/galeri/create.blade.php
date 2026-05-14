@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Tambah Foto Galeri</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Unggah foto baru ke galeri kamar</p>
    </div>
    <a href="{{ route('galeri.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    <div class="px-5 py-3.5 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Data Galeri</span>
    </div>

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="p-5 flex flex-col gap-5">

            {{-- Judul --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Judul <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="text" name="judul"
                       value="{{ old('judul') }}"
                       placeholder="cth. Kamar Deluxe, Pemandangan Kolam"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('judul') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('judul')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Keterangan
                </label>
                <textarea name="keterangan" rows="3"
                          placeholder="Deskripsi singkat tentang foto ini..."
                          class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-[8px] outline-none focus:border-[#FF6B00] focus:bg-white transition-colors resize-none">{{ old('keterangan') }}</textarea>
            </div>

            {{-- Upload Foto --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Foto <span class="text-[#FF6B00]">*</span>
                </label>

                {{-- Drop zone --}}
                <label for="foto-input"
                       class="group flex flex-col items-center justify-center gap-2 w-full border-2 border-dashed rounded-[7px] px-4 py-8 cursor-pointer transition-colors
                              {{ $errors->has('foto') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.10] bg-[#FAFAF9] hover:border-[#FF6B00]/50 hover:bg-[#FFF8F3]' }}"
                       id="foto-drop-zone">
                    <div class="w-9 h-9 rounded-full bg-black/[0.04] group-hover:bg-[#FF6B00]/10 flex items-center justify-center transition-colors">
                        <i class="bi bi-image text-[#aaa] group-hover:text-[#FF6B00] text-base transition-colors"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-[12px] font-medium text-[#464646]" id="foto-label">Klik atau seret foto ke sini</p>
                        <p class="text-[10.5px] text-[#bbb] mt-0.5">PNG, JPG, JPEG, WEBP — maks. 2 MB</p>
                    </div>
                    <input type="file" id="foto-input" name="foto" accept="image/*"
                           class="hidden" onchange="previewFoto(this)">
                </label>

                {{-- Preview --}}
                <div id="foto-preview-wrap" class="hidden mt-2 relative w-full max-w-[180px]">
                    <img id="foto-preview" src="" alt="preview"
                         class="w-full rounded-[7px] border border-black/[0.08] object-cover aspect-video">
                    <button type="button" onclick="clearFoto()"
                            class="absolute -top-2 -right-2 w-5 h-5 rounded-full bg-white border border-black/[0.10] flex items-center justify-center text-[#888] hover:text-[#E24B4A] hover:border-[#E24B4A] transition-colors shadow-sm">
                        <i class="bi bi-x text-xs leading-none"></i>
                    </button>
                </div>

                @error('foto')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="px-5 py-3.5 border-t border-black/[0.06] bg-[#FAFAF9] flex items-center justify-end gap-2">
            <a href="{{ route('galeri.index') }}"
               class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                <i class="bi bi-check-lg text-sm"></i>
                Simpan Foto
            </button>
        </div>

    </form>
</div>

@push('scripts')
<script>
    function previewFoto(input) {
        const file = input.files[0];
        if (!file) return;

        const label   = document.getElementById('foto-label');
        const wrap    = document.getElementById('foto-preview-wrap');
        const preview = document.getElementById('foto-preview');

        label.textContent = file.name;

        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function clearFoto() {
        document.getElementById('foto-input').value     = '';
        document.getElementById('foto-label').textContent = 'Klik atau seret foto ke sini';
        document.getElementById('foto-preview-wrap').classList.add('hidden');
        document.getElementById('foto-preview').src    = '';
    }
</script>
@endpush

@endsection
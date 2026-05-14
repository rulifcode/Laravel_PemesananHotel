@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Edit Artikel</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Perbarui konten dan pengaturan artikel</p>
    </div>
    <a href="{{ route('admin.artikel.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Error alert --}}
@if($errors->any())
    <div class="flex items-start gap-2.5 bg-[#FEF0F0] border border-[#E24B4A]/20 rounded-[8px] px-4 py-3 mb-4">
        <i class="bi bi-exclamation-circle text-[#E24B4A] text-[14px] mt-0.5 shrink-0"></i>
        <p class="text-[12px] text-[#E24B4A]">{{ $errors->first() }}</p>
    </div>
@endif

<form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-3 gap-4">

        {{-- Kolom Kiri: Konten Utama (2/3) --}}
        <div class="col-span-2 flex flex-col gap-4">

            {{-- Card Konten --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
                <div class="px-5 py-3.5 border-b border-black/[0.06]">
                    <span class="text-[13px] font-medium text-[#121212]">Konten Artikel</span>
                </div>
                <div class="p-5 flex flex-col gap-5">

                    {{-- Judul --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                            Judul <span class="text-[#FF6B00]">*</span>
                        </label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $artikel->judul) }}"
                               placeholder="Judul artikel..."
                               class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                                      {{ $errors->has('judul') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                        @error('judul')
                            <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konten --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                            Konten <span class="text-[#FF6B00]">*</span>
                        </label>
                        <textarea name="konten" rows="14"
                                  placeholder="Tulis isi artikel di sini..."
                                  class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-[8px] outline-none focus:border-[#FF6B00] focus:bg-white transition-colors resize-none">{{ old('konten', $artikel->konten) }}</textarea>
                        @error('konten')
                            <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

        </div>

        {{-- Kolom Kanan: Pengaturan (1/3) --}}
        <div class="flex flex-col gap-4">

            {{-- Card Pengaturan --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
                <div class="px-5 py-3.5 border-b border-black/[0.06]">
                    <span class="text-[13px] font-medium text-[#121212]">Pengaturan</span>
                </div>
                <div class="p-5 flex flex-col gap-5">

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                            Kategori <span class="text-[#FF6B00]">*</span>
                        </label>
                        <select name="kategori"
                                class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border border-black/[0.08] rounded-[7px] px-3 py-[8px] outline-none focus:border-[#FF6B00] focus:bg-white transition-colors appearance-none cursor-pointer">
                            @foreach(['promo' => 'Promo', 'info' => 'Info', 'event' => 'Event'] as $val => $label)
                                <option value="{{ $val }}" {{ old('kategori', $artikel->kategori) === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-[11.5px] font-medium text-[#464646] mb-2">
                            Status <span class="text-[#FF6B00]">*</span>
                        </label>
                        <div class="flex flex-col gap-2">
                            @foreach(['draft' => ['bg-[#F5F4F2] border-[#888]/20 text-[#464646]', 'bi-file-earmark', 'Belum tayang'],
                                      'published' => ['bg-[#F0FDF4] border-[#16A34A]/20 text-[#16A34A]', 'bi-check-circle', 'Tayang ke publik']]
                                     as $val => [$colorClass, $icon, $desc])
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="{{ $val }}"
                                           {{ old('status', $artikel->status) === $val ? 'checked' : '' }}
                                           class="peer hidden">
                                    <div class="flex items-center gap-2.5 border-2 rounded-[8px] px-3 py-2.5 transition-all
                                                border-black/[0.06] bg-[#FAFAF9] text-[#aaa]
                                                peer-checked:{{ $colorClass }}">
                                        <i class="bi {{ $icon }} text-[14px]"></i>
                                        <div>
                                            <p class="text-[12px] font-medium leading-none">{{ ucfirst($val) }}</p>
                                            <p class="text-[10px] mt-0.5 opacity-70">{{ $desc }}</p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card Thumbnail --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">
                <div class="px-5 py-3.5 border-b border-black/[0.06]">
                    <span class="text-[13px] font-medium text-[#121212]">Thumbnail</span>
                </div>
                <div class="p-5">

                    {{-- Preview thumbnail saat ini --}}
                    @if($artikel->thumbnail)
                        <div class="mb-3 relative">
                            <img src="/img/artikel/{{ $artikel->thumbnail }}"
                                 id="thumb-preview"
                                 alt="Thumbnail"
                                 class="w-full aspect-video object-cover rounded-[7px] border border-black/[0.06]">
                            <span class="absolute bottom-2 left-2 text-[10px] bg-black/50 text-white px-2 py-0.5 rounded-full">
                                Thumbnail saat ini
                            </span>
                        </div>
                    @else
                        <div id="thumb-preview-wrap" class="hidden mb-3">
                            <img id="thumb-preview" src="" alt="preview"
                                 class="w-full aspect-video object-cover rounded-[7px] border border-black/[0.06]">
                        </div>
                    @endif

                    {{-- Drop zone --}}
                    <label for="thumb-input"
                           class="group flex flex-col items-center justify-center gap-2 w-full border-2 border-dashed rounded-[7px] px-4 py-5 cursor-pointer transition-colors
                                  border-black/[0.10] bg-[#FAFAF9] hover:border-[#FF6B00]/50 hover:bg-[#FFF8F3]">
                        <div class="w-8 h-8 rounded-full bg-black/[0.04] group-hover:bg-[#FF6B00]/10 flex items-center justify-center transition-colors">
                            <i class="bi bi-arrow-repeat text-[#aaa] group-hover:text-[#FF6B00] text-sm transition-colors"></i>
                        </div>
                        <div class="text-center">
                            <p class="text-[11.5px] font-medium text-[#464646]" id="thumb-label">Ganti thumbnail</p>
                            <p class="text-[10px] text-[#bbb] mt-0.5">PNG, JPG, WEBP — maks. 2 MB</p>
                        </div>
                        <input type="file" id="thumb-input" name="thumbnail" accept="image/*"
                               class="hidden" onchange="previewThumb(this)">
                    </label>

                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="bg-white border border-black/[0.06] rounded-[10px] px-5 py-3.5 flex items-center justify-end gap-2">
                <a href="{{ route('admin.artikel.index') }}"
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

@push('scripts')
<script>
    function previewThumb(input) {
        const file = input.files[0];
        if (!file) return;

        document.getElementById('thumb-label').textContent = file.name;

        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('thumb-preview');
            const wrap    = document.getElementById('thumb-preview-wrap');

            if (preview) {
                preview.src = e.target.result;
            }
            if (wrap) {
                wrap.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
@extends('layouts.app')

@section('title', 'Edit Fasilitas Kamar')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Edit Fasilitas Kamar</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Perbarui data fasilitas</p>
    </div>
    <a href="{{ route('fasilitas-kamar.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    <div class="px-5 py-3.5 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Data Fasilitas</span>
    </div>

    <form action="{{ route('fasilitas-kamar.update', $fasilitasKamar->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="p-5 flex flex-col gap-5">

            {{-- Pilih Kamar --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Kamar <span class="text-[#FF6B00]">*</span>
                </label>
                <select name="kamar_id"
                        class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors appearance-none cursor-pointer
                               {{ $errors->has('kamar_id') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    @foreach ($kamars as $k)
                        <option value="{{ $k->id }}"
                            {{ old('kamar_id', $fasilitasKamar->kamar_id) == $k->id ? 'selected' : '' }}>
                            #{{ $k->id }} — {{ $k->nama_kamar }} ({{ $k->tipe_kamar }})
                        </option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Fasilitas --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Nama Fasilitas <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="text" name="nama_fasilitas"
                       value="{{ old('nama_fasilitas', $fasilitasKamar->nama_fasilitas) }}"
                       placeholder="cth. AC, WiFi, TV, Kulkas"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('nama_fasilitas') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('nama_fasilitas')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror

                {{-- Quick pick chips --}}
                <div class="flex flex-wrap gap-1.5 mt-2">
                    @foreach(['AC','TV','WiFi','Kulkas','Kamar Mandi','Bathtub','Parkir','Sarapan','Kolam Renang'] as $chip)
                        <button type="button"
                                onclick="document.querySelector('[name=nama_fasilitas]').value = '{{ $chip }}'"
                                class="text-[10.5px] px-2.5 py-1 rounded-full border border-black/[0.08] text-[#888] bg-[#FAFAF9] hover:border-[#FF6B00]/40 hover:text-[#FF6B00] hover:bg-[#FFF0E6] transition-colors cursor-pointer">
                            {{ $chip }}
                        </button>
                    @endforeach
                </div>
                <p class="text-[10px] text-[#bbb] mt-1.5">Klik chip untuk ganti, atau ketik manual.</p>
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="px-5 py-3.5 border-t border-black/[0.06] bg-[#FAFAF9] flex items-center justify-between">
            <p class="text-[11px] text-[#bbb]">
                <i class="bi bi-clock-history mr-1"></i>
                Dibuat {{ $fasilitasKamar->created_at->diffForHumans() }}
            </p>
            <div class="flex items-center gap-2">
                <a href="{{ route('fasilitas-kamar.index') }}"
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

    </form>
</div>

@endsection
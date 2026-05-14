@extends('layouts.app')

@section('title', 'Manajemen Artikel')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Manajemen Artikel</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola semua artikel dan konten blog</p>
    </div>
    <a href="{{ route('admin.artikel.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah Artikel
    </a>
</div>

{{-- Stats Row --}}
@php
    $total     = $artikels->count();
    $published = $artikels->where('status', 'published')->count();
    $draft     = $artikels->where('status', 'draft')->count();
    $kategories = $artikels->pluck('kategori')->unique()->count();
@endphp

<div class="grid grid-cols-4 gap-3 mb-3.5">

    {{-- Total --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Total Artikel</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#FFF0E6] flex items-center justify-center">
                <i class="bi bi-newspaper text-[#FF6B00] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $total }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Semua artikel</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#FF6B00] rounded-full w-full"></div>
        </div>
    </div>

    {{-- Published --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Published</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#F0FDF4] flex items-center justify-center">
                <i class="bi bi-check-circle text-[#16A34A] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $published }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Tayang di publik</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#16A34A] rounded-full" style="width:{{ $total ? round($published/$total*100) : 0 }}%"></div>
        </div>
    </div>

    {{-- Draft --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Draft</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#F5F4F2] flex items-center justify-center">
                <i class="bi bi-file-earmark text-[#888] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $draft }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Belum tayang</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#888] rounded-full" style="width:{{ $total ? round($draft/$total*100) : 0 }}%"></div>
        </div>
    </div>

    {{-- Kategori --}}
    <div class="bg-white border border-black/[0.06] rounded-[10px] p-4">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-[11px] text-[#999] font-medium">Kategori</span>
            <div class="w-[30px] h-[30px] rounded-[6px] bg-[#EDF5FF] flex items-center justify-center">
                <i class="bi bi-tag text-[#3B82F6] text-[13px]"></i>
            </div>
        </div>
        <div class="text-[22px] font-medium text-[#121212] leading-none">{{ $kategories }}</div>
        <div class="text-[11px] text-[#aaa] mt-0.5">Topik berbeda</div>
        <div class="h-[3px] bg-[#EDECEA] rounded-full mt-2.5">
            <div class="h-[3px] bg-[#3B82F6] rounded-full w-full"></div>
        </div>
    </div>

</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header + Filter --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Artikel</span>
        <div class="flex gap-1">
            <button onclick="filterStatus(this, '')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-[#121212] text-white border-[#121212]">
                Semua
            </button>
            <button onclick="filterStatus(this, 'published')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Published
            </button>
            <button onclick="filterStatus(this, 'draft')"
                    class="pill-btn text-[11px] px-[9px] py-[3px] rounded-full border cursor-pointer transition-colors
                           bg-transparent text-[#888] border-black/[0.08] hover:bg-[#F5F4F2]">
                Draft
            </button>
        </div>
    </div>

    {{-- Table --}}
    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Judul</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-32">Kategori</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Status</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-32">Author</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-28">Tanggal</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikels as $i => $artikel)
                <tr class="artikel-row border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors"
                    data-status="{{ $artikel->status }}">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- Judul + slug --}}
                    <td class="px-4 py-[10px]">
                        <div class="text-[12.5px] font-medium text-[#121212] truncate">{{ $artikel->judul }}</div>
                        <div class="text-[10px] text-[#bbb] mt-0.5 truncate">/{{ $artikel->slug }}</div>
                    </td>

                    {{-- Kategori --}}
                    <td class="px-4 py-[10px]">
                        <span class="inline-block text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] bg-[#EDF5FF] text-[#3B82F6]">
                            {{ $artikel->kategori }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-[10px] text-center">
                        @if($artikel->status === 'published')
                            <span class="inline-block text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] bg-[#F0FDF4] text-[#16A34A]">
                                Published
                            </span>
                        @else
                            <span class="inline-block text-[10.5px] font-medium px-[7px] py-[2px] rounded-[4px] bg-[#F5F4F2] text-[#888]">
                                Draft
                            </span>
                        @endif
                    </td>

                    {{-- Author --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center gap-2">
                            <div class="w-[22px] h-[22px] rounded-full bg-[#EDECEA] flex items-center justify-center shrink-0">
                                <span class="text-[9px] font-medium text-[#464646]">
                                    {{ strtoupper(substr($artikel->user->name ?? '?', 0, 1)) }}
                                </span>
                            </div>
                            <span class="text-[12px] text-[#464646] truncate">{{ $artikel->user->name ?? '—' }}</span>
                        </div>
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-4 py-[10px]">
                        <div class="text-[12px] text-[#464646]">{{ $artikel->created_at->format('d M Y') }}</div>
                        <div class="text-[10px] text-[#bbb] mt-0.5">{{ $artikel->created_at->diffForHumans() }}</div>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center justify-center gap-[3px]">
                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                               title="Edit"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                                <i class="bi bi-pencil text-[12px]"></i>
                            </a>
                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')"
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
                    <td colspan="7" class="px-4 py-12 text-center">
                        <i class="bi bi-newspaper text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Belum ada artikel.</p>
                        <a href="{{ route('admin.artikel.create') }}"
                           class="inline-flex items-center gap-1 mt-2.5 text-[12px] text-[#FF6B00] hover:underline">
                            <i class="bi bi-plus-lg"></i> Tulis artikel pertama
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

    document.querySelectorAll('.artikel-row').forEach(row => {
        row.style.display = (!status || row.dataset.status === status) ? '' : 'none';
    });
}
</script>
@endpush
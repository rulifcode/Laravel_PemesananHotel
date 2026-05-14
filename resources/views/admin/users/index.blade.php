@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Manajemen Users</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Kelola akun dan hak akses pengguna sistem</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors flex-shrink-0">
        <i class="bi bi-plus-lg text-sm"></i>
        Tambah User
    </a>
</div>

{{-- Table Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-black/[0.06]">
        <span class="text-[13px] font-medium text-[#121212]">Daftar Users</span>
        @if ($users->count() > 0)
            <span class="text-[11px] text-[#aaa]">{{ $users->count() }} user terdaftar</span>
        @endif
    </div>

    <table class="w-full border-collapse" style="table-layout:fixed">
        <thead>
            <tr class="bg-[#FAFAF9] border-b border-black/[0.06]">
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-9">#</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em]">Nama</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-52">Email</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Role</th>
                <th class="px-4 py-[9px] text-left text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-24">Dibuat</th>
                <th class="px-4 py-[9px] text-center text-[10px] font-medium text-[#aaa] uppercase tracking-[0.07em] w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $user)
                <tr class="border-b border-[#F5F4F2] last:border-b-0 hover:bg-[#FAFAF9] transition-colors">

                    {{-- No --}}
                    <td class="px-4 py-[10px] text-[11px] text-[#bbb]">{{ $i + 1 }}</td>

                    {{-- Nama + avatar inisial --}}
                    <td class="px-4 py-[10px]">
                        <div class="inline-flex items-center gap-2">
                            <div class="w-[26px] h-[26px] rounded-full bg-[#F5F4F2] flex items-center justify-center flex-shrink-0 text-[10px] font-semibold text-[#888] uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="text-[12.5px] font-medium text-[#121212]">{{ $user->name }}</span>
                            @if ($user->id === auth()->id())
                                <span class="text-[9.5px] font-medium px-1.5 py-[1px] rounded-[3px] bg-[#FFF0E6] text-[#FF6B00] border border-[#FF6B00]/15">Anda</span>
                            @endif
                        </div>
                    </td>

                    {{-- Email --}}
                    <td class="px-4 py-[10px]">
                        <span class="text-[12px] text-[#666] truncate block">{{ $user->email }}</span>
                    </td>

                    {{-- Role badge --}}
                    <td class="px-4 py-[10px]">
                        @php
                            $roleStyle = match($user->role) {
                                'admin'     => 'bg-[#FEF0F0] text-[#E24B4A] border-[#E24B4A]/20',
                                'staff'     => 'bg-[#EDF5FF] text-[#3B82F6] border-[#3B82F6]/20',
                                default     => 'bg-[#F5F4F2] text-[#888] border-black/[0.08]',
                            };
                        @endphp
                        <span class="inline-block text-[10.5px] font-medium px-2 py-[2px] rounded-[4px] border {{ $roleStyle }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    {{-- Dibuat --}}
                    <td class="px-4 py-[10px]">
                        <span class="text-[12px] text-[#888]">{{ $user->created_at->format('d/m/Y') }}</span>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-[10px]">
                        <div class="flex items-center justify-center gap-[3px]">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               title="Edit"
                               class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#F5F4F2] hover:text-[#464646] transition-colors">
                                <i class="bi bi-pencil text-[12px]"></i>
                            </a>
                            @if ($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus user ini?')"
                                      style="display:contents">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Hapus"
                                            class="w-[26px] h-[26px] rounded-[5px] border border-black/[0.08] flex items-center justify-center text-[#aaa] hover:bg-[#FEF0F0] hover:text-[#E24B4A] transition-colors cursor-pointer bg-transparent">
                                        <i class="bi bi-trash text-[12px]"></i>
                                    </button>
                                </form>
                            @else
                                {{-- Placeholder agar layout tidak geser --}}
                                <div class="w-[26px] h-[26px]"></div>
                            @endif
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center">
                        <i class="bi bi-people text-[#ddd] text-4xl block mb-2"></i>
                        <p class="text-[12.5px] text-[#bbb]">Belum ada user terdaftar.</p>
                        <a href="{{ route('admin.users.create') }}"
                           class="inline-flex items-center gap-1 mt-2.5 text-[12px] text-[#FF6B00] hover:underline">
                            <i class="bi bi-plus-lg"></i> Tambah user pertama
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
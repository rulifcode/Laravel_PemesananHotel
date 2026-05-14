@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between mb-5">
    <div>
        <h1 class="text-[17px] font-medium text-[#121212]">Edit User</h1>
        <p class="text-[12px] text-[#999] mt-0.5">Perbarui informasi dan hak akses pengguna</p>
    </div>
    <a href="{{ route('admin.users.index') }}"
       class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-3.5 py-[7px] rounded-[7px] transition-colors">
        <i class="bi bi-arrow-left text-sm"></i>
        Kembali
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white border border-black/[0.06] rounded-[10px] overflow-hidden">

    {{-- Card Header dengan avatar --}}
    <div class="px-5 py-3.5 border-b border-black/[0.06] flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-[#F5F4F2] flex items-center justify-center text-[13px] font-semibold text-[#888] uppercase flex-shrink-0">
            {{ substr($user->name, 0, 1) }}
        </div>
        <div>
            <span class="text-[13px] font-medium text-[#121212]">{{ $user->name }}</span>
            <p class="text-[11px] text-[#bbb] mt-0">{{ $user->email }}</p>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="p-5 flex flex-col gap-5">

            {{-- Nama --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Nama <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="text" name="name"
                       value="{{ old('name', $user->name) }}"
                       placeholder="Nama lengkap"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('name') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('name')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Email <span class="text-[#FF6B00]">*</span>
                </label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       placeholder="email@contoh.com"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('email') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('email')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Role <span class="text-[#FF6B00]">*</span>
                </label>
                <select name="role"
                        class="w-full text-[12.5px] text-[#121212] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors appearance-none cursor-pointer
                               {{ $errors->has('role') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                    <option value="admin"       {{ old('role', $user->role) == 'admin'       ? 'selected' : '' }}>Admin</option>
                    <option value="resepsionis" {{ old('role', $user->role) == 'resepsionis' ? 'selected' : '' }}>Resepsionis</option>
                </select>
                @error('role')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Divider --}}
            <div class="border-t border-black/[0.05]"></div>

            {{-- Password Baru --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Password Baru
                    <span class="text-[11px] font-normal text-[#bbb]">(kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password"
                       placeholder="••••••••"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('password') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('password')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="block text-[11.5px] font-medium text-[#464646] mb-1.5">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation"
                       placeholder="••••••••"
                       class="w-full text-[12.5px] text-[#121212] placeholder-[#ccc] bg-[#FAFAF9] border rounded-[7px] px-3 py-[8px] outline-none transition-colors
                              {{ $errors->has('password_confirmation') ? 'border-[#E24B4A] bg-[#FEF0F0]' : 'border-black/[0.08] focus:border-[#FF6B00] focus:bg-white' }}">
                @error('password_confirmation')
                    <p class="text-[11px] text-[#E24B4A] mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="px-5 py-3.5 border-t border-black/[0.06] bg-[#FAFAF9] flex items-center justify-end gap-2">
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center gap-1.5 border border-black/[0.08] bg-white hover:bg-[#F5F4F2] text-[#464646] text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-[#FF6B00] hover:bg-[#e05e00] text-white text-[12.5px] font-medium px-4 py-[7px] rounded-[7px] transition-colors">
                <i class="bi bi-check-lg text-sm"></i>
                Update User
            </button>
        </div>

    </form>
</div>

@endsection
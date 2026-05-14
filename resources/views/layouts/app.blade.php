<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Redison Blue') — CMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            orange: '#FF6B00',
                            dark:   '#121212',
                            gray:   '#464646',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }

        /* Sidebar scrollbar */
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        /* Active nav indicator */
        .nav-active {
            background: rgba(255, 107, 0, 0.12) !important;
            color: #ffffff !important;
        }
        .nav-active i { color: #FF6B00 !important; }
        .nav-active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 20px;
            background: #FF6B00;
            border-radius: 0 2px 2px 0;
        }

        /* Flash animation */
        .flash-msg { animation: slideDown 0.25s ease; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .nav-link { transition: background 0.15s, color 0.15s; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F5F4F2] text-[#464646] min-h-screen flex">

    {{-- ─────────────────────────────────────────────
         SIDEBAR
    ───────────────────────────────────────────── --}}
    <aside class="w-56 min-h-screen bg-[#121212] flex flex-col fixed top-0 left-0 z-50" style="height:100vh">

        {{-- Brand --}}
        <div class="px-4 py-3.5 border-b border-white/[0.06] flex-shrink-0 flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-[6px] overflow-hidden flex-shrink-0 bg-[#1e1e1e] flex items-center justify-center">
                <img src="{{ asset('img/Aurevia_logo.png') }}"
                     alt="The Redison Blue"
                     class="w-full h-full object-contain p-0.5"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="w-full h-full bg-[#FF6B00] rounded-[6px] items-center justify-center hidden">
                    <i class="bi bi-building-fill text-white text-xs"></i>
                </div>
            </div>
            <div class="leading-none">
                <span class="block text-white font-medium text-[12px]">Aurevia</span>
                <span class="text-white/25 text-[9.5px] tracking-wide mt-[3px] block">Management Panel</span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav flex-1 px-3 py-4 overflow-y-auto space-y-0.5">

            {{-- ── Operasional ── --}}
            <p class="text-white/20 text-[9px] tracking-[0.1em] uppercase px-3 mb-2 font-medium">Operasional</p>

            <a href="{{ route('kamar.index') }}"
               class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('kamar.*') ? 'nav-active' : '' }}">
                <i class="bi bi-door-open text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('kamar.*') ? '!text-[#FF6B00]' : '' }}"></i>
                Kamar
            </a>

            <a href="{{ route('fasilitas-kamar.index') }}"
               class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('fasilitas-kamar.*') ? 'nav-active' : '' }}">
                <i class="bi bi-stars text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('fasilitas-kamar.*') ? '!text-[#FF6B00]' : '' }}"></i>
                Fasilitas Kamar
            </a>

            <a href="{{ route('galeri.index') }}"
               class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('galeri.*') ? 'nav-active' : '' }}">
                <i class="bi bi-images text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('galeri.*') ? '!text-[#FF6B00]' : '' }}"></i>
                Galeri
            </a>

            <a href="{{ route('pesanan.index') }}"
               class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('pesanan.*') ? 'nav-active' : '' }}">
                <i class="bi bi-calendar-check text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('pesanan.*') ? '!text-[#FF6B00]' : '' }}"></i>
                Pesanan
                @php $pendingCount = \App\Models\Pesanan::where('status', 'pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-[#FF6B00] text-white text-[10px] font-medium px-1.5 py-0.5 rounded-full leading-none">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('absensi.saya') }}"
               class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('absensi.saya') ? 'nav-active' : '' }}">
                <i class="bi bi-clock text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('absensi.saya') ? '!text-[#FF6B00]' : '' }}"></i>
                Absensi Saya
            </a>

            {{-- ── Admin Panel ── --}}
            @if(auth()->user()->isAdmin())
            <div class="pt-3">
                <div class="border-t border-white/[0.06] mb-3"></div>
                <p class="text-white/20 text-[9px] tracking-[0.1em] uppercase px-3 mb-2 font-medium">Admin Panel</p>

                <a href="{{ route('admin.artikel.index') }}"
                   class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('admin.artikel.*') ? 'nav-active' : '' }}">
                    <i class="bi bi-newspaper text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('admin.artikel.*') ? '!text-[#FF6B00]' : '' }}"></i>
                    Artikel
                </a>

                <a href="{{ route('admin.banner.index') }}"
                   class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('admin.banner.*') ? 'nav-active' : '' }}">
                    <i class="bi bi-card-image text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('admin.banner.*') ? '!text-[#FF6B00]' : '' }}"></i>
                    Banner
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('admin.users.*') ? 'nav-active' : '' }}">
                    <i class="bi bi-people text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('admin.users.*') ? '!text-[#FF6B00]' : '' }}"></i>
                    Manajemen Users
                </a>

                <a href="{{ route('admin.absensi.index') }}"
                   class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('admin.absensi.*') ? 'nav-active' : '' }}">
                    <i class="bi bi-calendar3 text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('admin.absensi.*') ? '!text-[#FF6B00]' : '' }}"></i>
                    Rekap Absensi
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                   class="nav-link relative flex items-center gap-2.5 px-3 py-2 rounded-md text-white/45 hover:bg-white/[0.05] hover:text-white/70 text-[12.5px] font-medium {{ request()->routeIs('admin.laporan.*') ? 'nav-active' : '' }}">
                    <i class="bi bi-bar-chart-line text-[15px] w-4 text-center text-white/30 {{ request()->routeIs('admin.laporan.*') ? '!text-[#FF6B00]' : '' }}"></i>
                    Laporan
                </a>
            </div>
            @endif
        </nav>

        {{-- User Footer --}}
        <div class="px-3 py-3 border-t border-white/[0.06] flex-shrink-0">
            <div class="flex items-center gap-2.5 px-2 py-2 rounded-md hover:bg-white/[0.05] cursor-default group">
                <div class="w-7 h-7 rounded-full bg-[#FF6B00] flex items-center justify-center text-white font-medium text-[11px] flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-[11.5px] font-medium truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-white/30 text-[10px] truncate">{{ ucfirst(auth()->user()->role ?? 'Staff') }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">
                    @csrf
                    <button type="submit" title="Logout"
                            class="text-white/20 hover:text-red-400 transition-colors text-sm">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ─────────────────────────────────────────────
         MAIN CONTENT
    ───────────────────────────────────────────── --}}
    <main class="ml-56 flex-1 flex flex-col min-h-screen">

        {{-- Topbar --}}
        <header class="bg-white border-b border-black/[0.06] px-6 flex items-center justify-between sticky top-0 z-40" style="height:52px">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-1.5 text-[12px]">
                <span class="text-[#464646]/40 font-medium">Content Management System</span>
                <i class="bi bi-chevron-right text-[10px] text-[#464646]/20"></i>
                <span class="text-[#121212] font-medium">@yield('title', 'Dashboard')</span>
            </div>

            {{-- Right actions --}}
            <div class="flex items-center gap-2">
                <span class="text-[11px] text-[#464646]/40 mr-2 hidden sm:block">
                    {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                </span>

                {{-- Bell --}}
                <div class="relative w-8 h-8 flex items-center justify-center rounded-md border border-black/[0.06] bg-white hover:bg-[#F5F4F2] cursor-pointer transition-colors">
                    <i class="bi bi-bell text-[#464646] text-[14px]"></i>
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-[#FF6B00] rounded-full border border-white"></span>
                    @endif
                </div>

                {{-- Settings --}}
                <div class="w-8 h-8 flex items-center justify-center rounded-md border border-black/[0.06] bg-white hover:bg-[#F5F4F2] cursor-pointer transition-colors">
                    <i class="bi bi-gear text-[#464646] text-[14px]"></i>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <div class="flex-1 p-6">

            {{-- Flash: success --}}
            @if(session('success'))
                <div class="flash-msg mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200/60 text-emerald-700 rounded-xl px-4 py-3 text-[13px]">
                    <i class="bi bi-check-circle-fill text-emerald-500 text-base flex-shrink-0"></i>
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-400 hover:text-emerald-600 transition-colors">
                        <i class="bi bi-x text-base"></i>
                    </button>
                </div>
            @endif

            {{-- Flash: error --}}
            @if(session('error'))
                <div class="flash-msg mb-5 flex items-center gap-3 bg-red-50 border border-red-200/60 text-red-700 rounded-xl px-4 py-3 text-[13px]">
                    <i class="bi bi-exclamation-circle-fill text-red-500 text-base flex-shrink-0"></i>
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600 transition-colors">
                        <i class="bi bi-x text-base"></i>
                    </button>
                </div>
            @endif

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="flash-msg mb-5 bg-red-50 border border-red-200/60 text-red-700 rounded-xl px-4 py-3 text-[13px]">
                    <div class="flex items-center gap-3 mb-1">
                        <i class="bi bi-exclamation-circle-fill text-red-500 text-base flex-shrink-0"></i>
                        <span class="font-medium">Ada beberapa kesalahan:</span>
                    </div>
                    <ul class="ml-7 list-disc space-y-0.5 text-[12.5px]">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
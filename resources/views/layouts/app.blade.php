<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"DM Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

    <aside class="w-60 min-h-screen bg-slate-900 flex flex-col fixed top-0 left-0 z-50 shadow-xl">
        <div class="px-6 py-7 border-b border-slate-700">
            <span class="block text-amber-400 font-bold text-xl tracking-wide font-serif">Grand Hotel</span>
            <span class="text-slate-500 text-xs tracking-widest uppercase">Management System</span>
        </div>

        <nav class="flex-1 px-3 py-6 space-y-1">
            <p class="text-slate-600 text-xs tracking-widest uppercase px-3 mb-2">Menu</p>

            <a href="{{ route('kamar.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-amber-400 transition-all text-sm font-medium {{ request()->routeIs('kamar.*') ? 'bg-slate-800 text-amber-400' : '' }}">
                <i class="bi bi-door-open text-base"></i> Kamar
            </a>

            <a href="{{ route('fasilitas-kamar.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-amber-400 transition-all text-sm font-medium {{ request()->routeIs('fasilitas-kamar.*') ? 'bg-slate-800 text-amber-400' : '' }}">
                <i class="bi bi-stars text-base"></i> Fasilitas
            </a>

            <a href="{{ route('galeri.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-amber-400 transition-all text-sm font-medium {{ request()->routeIs('galeri.*') ? 'bg-slate-800 text-amber-400' : '' }}">
                <i class="bi bi-images text-base"></i> Galeri
            </a>

            <a href="{{ route('pesanan.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-amber-400 transition-all text-sm font-medium {{ request()->routeIs('pesanan.*') ? 'bg-slate-800 text-amber-400' : '' }}">
                <i class="bi bi-calendar-check text-base"></i> Pesanan
            </a>
        </nav>

        <div class="px-4 py-5 border-t border-slate-700">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-amber-400 flex items-center justify-center text-slate-900 font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="text-slate-200 text-xs font-medium">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-slate-500 text-xs">{{ auth()->user()->role ?? 'Staff' }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full text-xs text-slate-400 hover:text-red-400 flex items-center gap-2 transition-colors">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="ml-60 flex-1 flex flex-col min-h-screen">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-slate-800 font-semibold text-base">@yield('title', 'Dashboard')</h1>
                <p class="text-slate-400 text-xs mt-0.5">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="flex items-center gap-2 text-slate-400 text-sm">
                <i class="bi bi-bell"></i>
            </div>
        </header>

        <div class="flex-1 p-8">
            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm">
                    <i class="bi bi-check-circle-fill text-emerald-500"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                    <i class="bi bi-exclamation-circle-fill text-red-500"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</body>
</html>

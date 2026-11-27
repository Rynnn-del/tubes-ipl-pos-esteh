<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Es Teh')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="min-h-screen flex">
        <aside class="w-60 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0">
            <div>
                <div class="px-6 py-5 border-b border-slate-200">
                    <span class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Sistem Kasir</span>
                    <h1 class="text-xl font-bold text-slate-900 mt-0.5">Es Teh Nusantara</h1>
                </div>

                <nav class="p-4 space-y-1 text-sm font-medium">
                    <a href="{{ url('/kasir') }}" 
                       class="block px-4 py-2.5 rounded-lg transition {{ request()->is('kasir*') || request()->is('pos*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Layar Kasir
                    </a>
                    <a href="{{ url('/menu') }}" 
                       class="block px-4 py-2.5 rounded-lg transition {{ request()->is('menu*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Menu &amp; Stok
                    </a>
                    <a href="{{ url('/laporan/transaksi') }}" 
                       class="block px-4 py-2.5 rounded-lg transition {{ request()->is('laporan*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Laporan Penjualan
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-slate-200 text-sm">
                <div class="mb-3 px-2">
                    <p class="font-semibold text-slate-800">{{ Auth::user()->nama ?? 'Kasir Shift 1' }}</p>
                    <p class="text-xs text-slate-500">{{ Auth::user()->role ?? 'Kasir' }}</p>
                </div>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full text-left px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 font-medium transition cursor-pointer">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
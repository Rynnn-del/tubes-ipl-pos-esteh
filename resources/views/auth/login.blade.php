<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Es Teh</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
        <div class="mb-6">
            <span class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Point of Sale</span>
            <h1 class="text-2xl font-bold text-slate-900 mt-1">Masuk ke Kasir</h1>
            <p class="text-sm text-slate-500 mt-1">Masukkan akun kasir atau admin untuk memulai transaksi.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                       placeholder="Masukkan username"
                       class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       placeholder="Masukkan password"
                       class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
            </div>

            <button type="submit" 
                    class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-lg transition cursor-pointer">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>
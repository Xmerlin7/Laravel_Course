<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body
    class="min-h-screen bg-linear-to-br from-slate-950 via-slate-900 to-slate-800 flex items-center justify-center px-4">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-cyan-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md bg-white/95 backdrop-blur rounded-3xl shadow-2xl border border-white/20 p-8">
        <div class="mb-8">
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-slate-500">Simple CRUD Ecommerce</p>
            <h1 class="mt-2 text-3xl font-extrabold text-slate-900"> Login</h1>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    placeholder="admin@example.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    placeholder="password">
            </div>

            <button type="submit"
                class="w-full rounded-2xl bg-slate-900 px-4 py-3 font-bold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-300">
                Sign in
            </button>
        </form>

    </div>
</body>

</html>

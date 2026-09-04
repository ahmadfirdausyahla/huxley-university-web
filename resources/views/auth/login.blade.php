<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Duke University Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#3B82F6',
                        'dark-bg': '#0f0f0f',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-black text-white flex items-center justify-center min-h-screen relative overflow-hidden">
    
    <div class="absolute w-96 h-96 bg-brand-blue/20 rounded-full blur-3xl -top-20 -left-20"></div>
    <div class="absolute w-96 h-96 bg-brand-blue/10 rounded-full blur-3xl -bottom-20 -right-20"></div>

    <div class="w-full max-w-md bg-dark-bg border border-gray-800 p-8 rounded-2xl shadow-2xl relative z-10">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-brand-blue text-white rounded-full mx-auto flex items-center justify-center text-2xl font-bold mb-3 shadow-lg shadow-blue-500/30">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h2 class="text-2xl font-serif font-bold text-white">Duke Admin</h2>
            <p class="text-xs text-gray-400 mt-1">Masuk untuk mengelola sistem website</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-900/40 border border-red-500 text-red-300 p-3 rounded-lg mb-6 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs uppercase font-bold text-gray-400 mb-2">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" name="username" required value="{{ old('username') }}" placeholder="Masukkan username"
                        class="w-full bg-black border border-gray-800 rounded-lg pl-10 pr-4 py-3 text-sm text-white focus:outline-none focus:border-brand-blue transition">
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase font-bold text-gray-400 mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full bg-black border border-gray-800 rounded-lg pl-10 pr-4 py-3 text-sm text-white focus:outline-none focus:border-brand-blue transition">
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-brand-blue hover:bg-blue-600 text-white font-bold py-3 rounded-lg text-sm transition duration-300 shadow-lg shadow-blue-500/20">
                MASUK DASHBOARD <i class="fa-solid fa-arrow-right ml-1"></i>
            </button>
        </form>

        <div class="text-center text-xs text-gray-600 mt-8">
            &copy; 2026 Duke University Administration
        </div>
    </div>
</body>
</html>
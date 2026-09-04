<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Huxley University</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#2563EB',
                        'brand-blue-hover': '#1D4ED8',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans flex h-screen overflow-hidden">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between hidden md:flex shrink-0">
        <div>
            <!-- Header Brand -->
            <div class="p-5 border-b border-slate-200 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-sm shadow-md shadow-blue-500/20">
                    HU
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-sm leading-tight">Huxley Admin</h2>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold">Control Panel</p>
                </div>
            </div>

            <!-- Menu Navigation Links (Lengkap) -->
            <nav class="p-4 space-y-1">
                <p class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-2">Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-brand-blue font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-chart-pie w-4 text-center"></i> Dashboard
                </a>

                <p class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider mt-5 mb-2">Manajemen Konten</p>

                <!-- CRUD Berita -->
                <a href="{{ route('admin.news.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.news.*') ? 'bg-blue-50 text-brand-blue font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-newspaper w-4 text-center"></i> Berita & Artikel
                </a>

                <!-- CRUD Events -->
                <a href="{{ route('admin.events.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.events.*') ? 'bg-blue-50 text-brand-blue font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-regular fa-calendar-check w-4 text-center"></i> Events & Kegiatan
                </a>

                <!-- Beasiswa -->
                <a href="{{ Route::has('admin.scholarships.index') ? route('admin.scholarships.index') : '#' }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.scholarships.*') ? 'bg-blue-50 text-brand-blue font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-graduation-cap w-4 text-center"></i> Program Beasiswa
                </a>

                <!-- Warga Sekolah / Civitas -->
                <a href="{{ Route::has('admin.civitas.index') ? route('admin.civitas.index') : '#' }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.civitas.*') ? 'bg-blue-50 text-brand-blue font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-users-gear w-4 text-center"></i> Warga Sekolah
                </a>

                <!-- Fasilitas Kampus -->
                <a href="{{ Route::has('facility.index') ? route('facility.index') : '#' }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <i class="fa-solid fa-building-columns w-4 text-center"></i> Fasilitas Kampus
                </a>
            </nav>
        </div>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-slate-200 bg-slate-50/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-brand-blue font-bold flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-xs overflow-hidden">
                        <p class="font-bold text-slate-800 truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@huxley.ac.id' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-red-600 transition p-1.5" title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center sticky top-0 z-40">
            <h1 class="text-xs font-bold text-slate-700 uppercase tracking-wider">@yield('page_title', 'Admin Panel')</h1>
            <a href="{{ route('home') }}" target="_blank" class="text-xs text-slate-600 hover:text-brand-blue flex items-center gap-1.5 font-medium transition">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Lihat Portal Utama
            </a>
        </header>

        <main class="p-6 max-w-7xl w-full mx-auto">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl mb-6 text-xs flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
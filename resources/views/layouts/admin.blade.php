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
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between hidden md:flex shrink-0">
        <div>
            <!-- Header Brand with Logo -->
            <div class="px-5 py-4 border-b border-slate-800 flex items-center gap-3">
                <img src="{{ asset('images/huxley-logo.jpg') }}" alt="Huxley University" class="w-8 h-8 rounded-lg object-cover">
                <div>
                    <h2 class="font-bold text-white text-sm leading-tight">Huxley Admin</h2>
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold">Control Panel</p>
                </div>
            </div>

            <!-- Menu Navigation Links -->
            <nav class="p-3 space-y-4 overflow-y-auto">
                <!-- Utama -->
                <div>
                    <p class="px-3 text-[10px] uppercase font-bold text-slate-600 tracking-wider mb-1">Utama</p>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                        <i class="fa-solid fa-chart-pie w-4 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Event & Agenda -->
                <div>
                    <p class="px-3 text-[10px] uppercase font-bold text-slate-600 tracking-wider mb-1">Event & Agenda</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.events.index') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.events.index') || request()->routeIs('admin.events.create') || request()->routeIs('admin.events.edit') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                            <i class="fa-regular fa-calendar-check w-4 text-center"></i>
                            <span class="flex-1">Kelola Event</span>
                        </a>
                        <a href="{{ route('admin.events.all-registrations') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.events.all-registrations') || request()->routeIs('admin.events.registrations') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                            <i class="fa-solid fa-inbox w-4 text-center"></i>
                            <span class="flex-1">Kotak Masuk Event</span>
                            @php
                                $totalEventRegs = class_exists('App\Models\EventRegistration') ? \App\Models\EventRegistration::count() : 0;
                            @endphp
                            @if($totalEventRegs > 0)
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-700 text-slate-200">{{ $totalEventRegs }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Beasiswa & Bantuan -->
                <div>
                    <p class="px-3 text-[10px] uppercase font-bold text-slate-600 tracking-wider mb-1">Beasiswa & Bantuan</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.scholarships.index') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.scholarships.index') || request()->routeIs('admin.scholarships.create') || request()->routeIs('admin.scholarships.edit') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                            <i class="fa-solid fa-graduation-cap w-4 text-center"></i>
                            <span class="flex-1">Program Beasiswa</span>
                        </a>
                        <a href="{{ route('admin.scholarships.applications.index') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.scholarships.applications.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                            <i class="fa-solid fa-envelope-open-text w-4 text-center"></i>
                            <span class="flex-1">Kotak Masuk Beasiswa</span>
                            @php
                                $totalScholarshipApps = class_exists('App\Models\ScholarshipApplication') ? \App\Models\ScholarshipApplication::where('status', 'pending')->count() : 0;
                            @endphp
                            @if($totalScholarshipApps > 0)
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-700 text-slate-200">{{ $totalScholarshipApps }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Berita & Publikasi -->
                <div>
                    <p class="px-3 text-[10px] uppercase font-bold text-slate-600 tracking-wider mb-1">Berita & Publikasi</p>
                    <a href="{{ route('admin.news.index') }}" 
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                        <i class="fa-solid fa-newspaper w-4 text-center"></i>
                        <span>Berita & Artikel</span>
                    </a>
                </div>

                <!-- Fasilitas & Akademik -->
                <div>
                    <p class="px-3 text-[10px] uppercase font-bold text-slate-600 tracking-wider mb-1">Fasilitas & Akademik</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.facilities.index') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.facilities.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                            <i class="fa-solid fa-building-columns w-4 text-center"></i>
                            <span>Fasilitas Kampus</span>
                        </a>
                        <a href="{{ route('admin.programs.index') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.programs.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                            <i class="fa-solid fa-book-open w-4 text-center"></i>
                            <span>Program Studi</span>
                        </a>
                    </div>
                </div>

                <!-- Civitas Kampus -->
                <div>
                    <p class="px-3 text-[10px] uppercase font-bold text-slate-600 tracking-wider mb-1">Civitas Kampus</p>
                    <a href="{{ route('admin.civitas.index') }}" 
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.civitas.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                        <i class="fa-solid fa-users-gear w-4 text-center"></i>
                        <span>Mahasiswa & Staff</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- User Profile & Logout -->
        <div class="p-3 border-t border-slate-800">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <div class="w-7 h-7 rounded-lg bg-slate-700 text-slate-300 font-bold flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-xs overflow-hidden">
                        <p class="font-semibold text-slate-200 truncate text-[11px]">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email ?? 'admin@huxley.ac.id' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-500 hover:text-slate-200 transition p-1.5" title="Logout">
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
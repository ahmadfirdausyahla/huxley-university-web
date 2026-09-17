@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-28 right-0 w-80 h-80 rounded-full bg-brand-blue/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 w-72 h-72 rounded-full bg-blue-500/5 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-brand-blue"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Modern Campus Infrastructure</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Campus Facilities</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Explore high-end scientific laboratories, multi-disciplinary research facilities, digital resource centers, and athletic complexes designed to nurture breakthrough education.
                </p>

                <!-- Filter Kategori Quick Bar -->
                <div class="flex flex-wrap gap-2.5 mt-8">
                    <a href="{{ route('facility.index') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ !request('category') ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Semua Fasilitas
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'laboratorium']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'laboratorium' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Laboratorium
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'perpustakaan']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'perpustakaan' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Perpustakaan
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'olahraga']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'olahraga' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Olahraga
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'aula']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'aula' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Auditorium
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12" data-aos="fade-up">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">World-Class Environment</p>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Explore Our Facilities</h2>
            </div>
            
            <form method="GET" action="{{ route('facility.index') }}" class="flex items-center gap-2">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau lokasi gedung..."
                           class="w-full bg-gray-900 border border-gray-800 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-gray-500 focus:border-brand-blue outline-none transition">
                </div>
                <button type="submit" class="px-4 py-2.5 bg-brand-blue hover:bg-blue-600 rounded-xl text-xs font-bold text-white transition">
                    Cari
                </button>
            </form>
        </div>

        @if($facilities->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($facilities as $index => $fac)
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="group bg-gray-900/90 rounded-2xl border border-gray-800 overflow-hidden shadow-xl hover:shadow-brand-blue/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between">
                        <div>
                            <div class="relative h-56 bg-gray-800 overflow-hidden">
                                <img src="{{ $fac->image_url }}" alt="{{ $fac->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-black/30"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-black/70 backdrop-blur-md text-blue-400 border border-blue-500/30">
                                        <i class="{{ $fac->category_icon }} text-[9px]"></i>
                                        {{ $fac->category_label }}
                                    </span>
                                </div>

                                @if($fac->capacity)
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-white/10 backdrop-blur-md text-gray-200">
                                            <i class="fa-solid fa-users text-[9px]"></i> {{ $fac->capacity }} Orang
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="flex items-center gap-1.5 text-xs text-brand-blue font-medium mb-1">
                                    <i class="fa-solid fa-location-dot text-[11px]"></i>
                                    <span>{{ $fac->location }}</span>
                                </div>

                                <h3 class="text-xl font-bold font-serif text-white group-hover:text-blue-400 transition">{{ $fac->name }}</h3>
                                
                                <p class="text-xs text-gray-400 mt-3 line-clamp-3 leading-relaxed">
                                    {{ $fac->description ?: 'Fasilitas berstandar internasional yang menunjang aktivitas riset, pembelajaran, dan pengembangan potensi sivitas akademika.' }}
                                </p>

                                @if($fac->features)
                                    <div class="mt-4 pt-4 border-t border-gray-800/80">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-2">Fasilitas Penunjang:</p>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach(explode(',', $fac->features) as $item)
                                                <span class="text-[10px] bg-gray-800/90 px-2.5 py-1 rounded-lg text-gray-300">
                                                    {{ trim($item) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0 mt-3">
                            <div class="w-full py-2.5 px-4 rounded-xl bg-gray-800/50 border border-gray-700/50 flex items-center justify-between text-xs">
                                <span class="text-gray-400 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full {{ $fac->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    {{ $fac->is_active ? 'Siap Digunakan' : 'Dalam Perawatan' }}
                                </span>
                                <span class="text-brand-blue font-bold text-[11px]">Huxley Campus</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($facilities->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $facilities->links() }}
                </div>
            @endif
        @else
            <div class="py-24 text-center rounded-2xl border border-gray-800 bg-gray-900/50">
                <i class="fa-solid fa-building-columns text-4xl text-gray-600 mb-4"></i>
                <h3 class="text-lg font-bold text-white">Belum Ada Fasilitas yang Ditemukan</h3>
                <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci pencarian lain atau pilih kategori fasilitas.</p>
                <a href="{{ route('facility.index') }}" class="inline-block mt-4 text-xs font-bold text-brand-blue hover:underline">Reset Pencarian</a>
            </div>
        @endif
    </main>
</div>
@endsection

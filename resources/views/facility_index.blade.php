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

                <!-- Filter Category Quick Bar -->
                <div class="flex flex-wrap gap-2.5 mt-8">
                    <a href="{{ route('facility.index') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ !request('category') ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        All Facilities
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'laboratorium']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'laboratorium' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Laboratory
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'perpustakaan']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'perpustakaan' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Library
                    </a>
                    <a href="{{ route('facility.index', ['category' => 'olahraga']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('category') == 'olahraga' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Sports
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search building name or location..."
                           class="w-full bg-gray-900 border border-gray-800 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-gray-500 focus:border-brand-blue outline-none transition">
                </div>
                <button type="submit" class="px-4 py-2.5 bg-brand-blue hover:bg-blue-600 rounded-xl text-xs font-bold text-white transition">
                    Search
                </button>
            </form>
        </div>

        @if($facilities->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($facilities as $index => $fac)
                    <!-- White Modern Card Design -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="group bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-lg hover:shadow-[0_8px_30px_rgb(59,130,246,0.15)] hover:-translate-y-1.5 transition-all duration-500 flex flex-col justify-between p-3">
                        
                        <div>
                            <!-- Image Container -->
                            <div class="relative h-60 rounded-2xl bg-gray-100 overflow-hidden">
                                <img src="{{ $fac->image_url }}" alt="{{ $fac->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                
                                <!-- Floating Category Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/95 backdrop-blur-md text-gray-900 shadow-sm border border-gray-100">
                                        <i class="{{ $fac->category_icon }} text-[9px] text-brand-blue"></i>
                                        {{ $fac->category_label }}
                                    </span>
                                </div>

                                <!-- Floating Capacity Badge -->
                                @if($fac->capacity)
                                    <div class="absolute top-3 right-3">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold bg-white/95 backdrop-blur-md text-gray-900 shadow-sm border border-gray-100">
                                            <i class="fa-solid fa-users text-[9px] text-brand-blue"></i> {{ $fac->capacity }} Pax
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Section (Dark Text on White) -->
                            <div class="p-4 pt-5">
                                <div class="flex items-center gap-1.5 text-xs text-gray-500 font-medium mb-1.5">
                                    <i class="fa-solid fa-location-dot text-[11px] text-brand-blue"></i>
                                    <span class="truncate">{{ $fac->location }}</span>
                                </div>

                                <h3 class="text-xl font-bold font-serif text-gray-900 group-hover:text-brand-blue transition line-clamp-1">{{ $fac->name }}</h3>
                                
                                <p class="text-xs text-gray-600 mt-2.5 line-clamp-2 leading-relaxed">
                                    {{ $fac->description ?: 'International-standard facilities supporting research activities, learning, and developing the potential of academic community members.' }}
                                </p>

                                <!-- Supporting Features Tags -->
                                @if($fac->features)
                                    <div class="mt-4 pt-3 border-t border-gray-100">
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach(array_slice(explode(',', $fac->features), 0, 3) as $item)
                                                <span class="text-[10px] bg-gray-50 border border-gray-100 px-2.5 py-1 rounded-lg text-gray-600 font-medium">
                                                    {{ trim($item) }}
                                                </span>
                                            @endforeach
                                            @if(count(explode(',', $fac->features)) > 3)
                                                <span class="text-[10px] bg-gray-50 px-2 py-1 rounded-lg text-gray-400 font-medium">
                                                    +{{ count(explode(',', $fac->features)) - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Status -->
                        <div class="px-4 pb-2 pt-2">
                            <div class="w-full py-2.5 px-4 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-between text-xs">
                                <span class="text-gray-700 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $fac->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    <span class="text-[11px] font-semibold">{{ $fac->is_active ? 'Ready to Use' : 'Under Maintenance' }}</span>
                                </span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Huxley Campus</span>
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
            <div class="py-24 text-center rounded-3xl border border-gray-800 bg-gray-900/50">
                <i class="fa-solid fa-building-columns text-4xl text-gray-600 mb-4"></i>
                <h3 class="text-lg font-bold text-white">No Facilities Found</h3>
                <p class="text-xs text-gray-400 mt-1">Try using different search keywords or select a different facility category.</p>
                <a href="{{ route('facility.index') }}" class="inline-block mt-4 text-xs font-bold text-brand-blue hover:underline">Reset Search</a>
            </div>
        @endif
    </main>
</div>
@endsection
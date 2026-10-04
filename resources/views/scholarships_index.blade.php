@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-28 right-0 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 w-72 h-72 rounded-full bg-brand-blue/10 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-16 md:py-20">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="w-10 h-px bg-blue-500"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-blue-500 uppercase">Endowment & Financial Aid</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-white leading-tight">Scholarships & Grants</h1>
                <p class="max-w-2xl text-gray-400 mt-4 text-xs md:text-sm leading-relaxed">
                    Huxley University is committed to broadening educational access through academic merit scholarships, research fellowships, and tuition subsidies for the next generation.
                </p>

                <!-- Filter Bar -->
                <div class="flex flex-wrap gap-2.5 mt-6">
                    <a href="{{ route('scholarships.index') }}"
                       class="px-4 py-2 rounded-lg text-xs font-bold tracking-wide uppercase transition {{ !request('coverage_type') ? 'bg-blue-600 text-white' : 'bg-gray-800/60 text-gray-400 hover:text-white' }}">
                        All Programs
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'full']) }}"
                       class="px-4 py-2 rounded-lg text-xs font-bold tracking-wide uppercase transition {{ request('coverage_type') == 'full' ? 'bg-blue-600 text-white' : 'bg-gray-800/60 text-gray-400 hover:text-white' }}">
                        Full
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'partial']) }}"
                       class="px-4 py-2 rounded-lg text-xs font-bold tracking-wide uppercase transition {{ request('coverage_type') == 'partial' ? 'bg-blue-600 text-white' : 'bg-gray-800/60 text-gray-400 hover:text-white' }}">
                        Partial
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-12 md:py-16">

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl mb-10 text-xs flex items-center gap-3 shadow-lg" data-aos="fade-down">
                <i class="fa-solid fa-circle-check text-sm"></i>
                <div class="flex-1 font-medium">{{ session('success') }}</div>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 pb-6 border-b border-gray-800 mb-8" data-aos="fade-up">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-blue-400">Funding Opportunities</span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Active Scholarship Programs</h2>
            </div>
            
            <form method="GET" action="{{ route('scholarships.index') }}" class="flex items-center gap-2">
                @if(request('coverage_type'))
                    <input type="hidden" name="coverage_type" value="{{ request('coverage_type') }}">
                @endif
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search scholarships..."
                           class="w-full bg-gray-900 border border-gray-800 rounded-lg pl-9 pr-4 py-2.5 text-xs text-white placeholder-gray-500 focus:border-blue-500 focus:ring-1 outline-none transition">
                </div>
                <button type="submit" class="px-5 py-2.5 bg-white hover:bg-gray-200 rounded-lg text-xs font-bold text-black transition">
                    Search
                </button>
            </form>
        </div>

        @if($scholarships->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($scholarships as $index => $item)
                    <!-- Premium Dark Card -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="relative group rounded-[2rem] overflow-hidden shadow-2xl h-[470px] w-full isolate bg-zinc-950 flex flex-col justify-end">
                        
                        <!-- Background Image -->
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                             class="absolute inset-0 w-full h-full object-cover z-0 group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/85 via-50% to-transparent z-10"></div>
                        
                        <!-- Coverage Badge (Top Left) -->
                        <div class="absolute top-5 left-5 z-20">
                            <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-black/60 backdrop-blur-md text-blue-400 shadow-md flex items-center gap-1.5">
                                <i class="fa-solid fa-star text-[9px] text-blue-400"></i> {{ $item->coverage_type_label ?? 'Partial' }}
                            </span>
                        </div>

                        <!-- Content Box -->
                        <div class="relative z-20 p-6 flex flex-col justify-end h-full pt-24">
                            
                            <!-- Title & Verified Badge -->
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="text-lg font-bold text-white leading-snug line-clamp-2" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </h3>
                                <i class="fa-solid fa-circle-check text-blue-500 text-sm shrink-0 mt-1"></i>
                            </div>
                            
                            <!-- Description -->
                            <p class="text-gray-300 text-xs leading-relaxed line-clamp-2 mb-4 font-normal">
                                {{ $item->description ?: 'Educational financial assistance from Huxley University for highly dedicated and outstanding students.' }}
                            </p>
                            
                            <!-- Info Box Modern (Amount & Deadline) -->
                            <div class="bg-zinc-900/90 backdrop-blur-md rounded-2xl px-4 py-3 mb-5 flex items-center justify-between gap-3 text-xs">
                                <div class="min-w-0 flex-1">
                                    <span class="block text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">AMOUNT / FUNDING</span>
                                    <span class="font-bold text-white truncate block text-xs mt-0.5" title="{{ $item->amount }}">
                                        {{ $item->amount ?: 'Full Funded' }}
                                    </span>
                                </div>

                                <!-- Vertical Divider Line -->
                                <div class="w-px h-7 bg-zinc-700/60 shrink-0 mx-1"></div>

                                <div class="text-right shrink-0">
                                    <span class="block text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">DEADLINE</span>
                                    <span class="font-bold text-xs mt-0.5 block {{ $item->deadline && $item->deadline->isPast() ? 'text-red-400' : 'text-white' }}">
                                        {{ $item->deadline ? ($item->deadline->isPast() ? 'Closed' : $item->deadline->format('d M Y')) : 'Open' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center gap-2.5">
                                <a href="{{ route('scholarships.apply', $item) }}" 
                                   class="flex-1 bg-white hover:bg-gray-200 text-black py-3.5 px-4 rounded-xl text-xs font-bold flex justify-center items-center gap-2 transition-all shadow-md active:scale-95">
                                    <i class="fa-regular fa-paper-plane text-xs"></i> Apply Now
                                </a>
                                
                                @if($item->link)
                                    <a href="{{ $item->link }}" target="_blank" 
                                       class="w-11 h-11 bg-zinc-800/80 hover:bg-zinc-700/80 backdrop-blur-md rounded-xl flex items-center justify-center text-white transition-all shrink-0">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </a>
                                @else
                                    <button class="w-11 h-11 bg-zinc-800/40 opacity-50 cursor-not-allowed backdrop-blur-md rounded-xl flex items-center justify-center text-white shrink-0">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($scholarships->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $scholarships->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-3xl p-16 text-center" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-900 text-blue-500 flex items-center justify-center mb-5 border border-gray-800">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white">No Scholarship Available</h3>
                <p class="text-xs text-gray-400 mt-2">Try using different search keywords or filter.</p>
            </div>
        @endif
    </main>
</div>
@endsection
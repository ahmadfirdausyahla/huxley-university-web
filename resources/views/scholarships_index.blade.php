@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-[#0a0a0a] border-b border-gray-900">
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-blue-600/10 blur-[100px]"></div>
        <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-blue-500/10 blur-[100px]"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-blue-500"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-blue-500 uppercase">Endowment & Financial Aid</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Scholarships & Grants</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Huxley University is committed to broadening educational access through academic merit scholarships, research fellowships, and tuition subsidies for the next generation.
                </p>

                <!-- Filter Bar -->
                <div class="flex flex-wrap gap-3 mt-8">
                    <a href="{{ route('scholarships.index') }}"
                       class="px-5 py-2 rounded-lg text-xs font-bold tracking-wide uppercase transition border shadow-sm {{ !request('coverage_type') ? 'bg-blue-600 text-white border-blue-500' : 'bg-gray-800/50 text-gray-400 border-gray-700 hover:border-gray-500 hover:text-white' }}">
                        All Programs
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'full']) }}"
                       class="px-5 py-2 rounded-lg text-xs font-bold tracking-wide uppercase transition border shadow-sm {{ request('coverage_type') == 'full' ? 'bg-blue-600 text-white border-blue-500' : 'bg-gray-800/50 text-gray-400 border-gray-700 hover:border-gray-500 hover:text-white' }}">
                        Full
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'partial']) }}"
                       class="px-5 py-2 rounded-lg text-xs font-bold tracking-wide uppercase transition border shadow-sm {{ request('coverage_type') == 'partial' ? 'bg-blue-600 text-white border-blue-500' : 'bg-gray-800/50 text-gray-400 border-gray-700 hover:border-gray-500 hover:text-white' }}">
                        Partial
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl mb-10 text-xs flex items-center gap-3 shadow-lg" data-aos="fade-down">
                <i class="fa-solid fa-circle-check text-sm"></i>
                <div class="flex-1 font-medium">{{ session('success') }}</div>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 pb-6 border-b border-gray-800 mb-10" data-aos="fade-up">
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
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg pl-9 pr-4 py-2.5 text-xs text-white placeholder-gray-500 focus:border-blue-500 focus:ring-1 outline-none transition">
                </div>
                <button type="submit" class="px-5 py-2.5 bg-white hover:bg-gray-200 rounded-lg text-xs font-bold text-black transition">
                    Search
                </button>
            </form>
        </div>

        @if($scholarships->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($scholarships as $index => $item)
                    <!-- Premium Dark Card (Style Kiri Referensi) -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="relative group rounded-[2rem] overflow-hidden shadow-2xl h-[460px] w-full isolate border border-gray-800">
                        
                        <!-- Background Image -->
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                             class="absolute inset-0 w-full h-full object-cover z-0 group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <!-- Gradient Overlay (Solid Dark at bottom) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#111] via-[#111]/80 to-transparent z-10"></div>
                        
                        <!-- Content Box -->
                        <div class="absolute inset-0 z-20 flex flex-col justify-end p-6">
                            <!-- Title & Verified Badge -->
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold text-white leading-tight line-clamp-1">{{ $item->title }}</h3>
                                <i class="fa-solid fa-circle-check text-blue-500 text-sm shrink-0"></i>
                            </div>
                            
                            <!-- Description -->
                            <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 mb-5 font-medium">
                                {{ $item->description ?: 'Educational financial assistance from Huxley University for highly dedicated and outstanding students.' }}
                            </p>
                            
                            <!-- Stats Row -->
                            <div class="flex items-center justify-between px-1 mb-6">
                                <!-- Stat 1: Rating/Type -->
                                <div class="text-center flex-1">
                                    <div class="text-[13px] font-bold text-white flex items-center justify-center gap-1.5">
                                        <i class="fa-solid fa-star text-amber-500 text-[10px]"></i> {{ $item->coverage_type_label ?? 'Partial' }}
                                    </div>
                                    <div class="text-[10px] text-gray-500 mt-1">Coverage</div>
                                </div>
                                <div class="w-px h-6 bg-gray-700"></div>
                                <!-- Stat 2: Amount -->
                                <div class="text-center flex-1">
                                    <div class="text-[13px] font-bold text-white truncate px-1">{{ $item->amount ?: 'Full Funded' }}</div>
                                    <div class="text-[10px] text-gray-500 mt-1">Amount</div>
                                </div>
                                <div class="w-px h-6 bg-gray-700"></div>
                                <!-- Stat 3: Deadline -->
                                <div class="text-center flex-1">
                                    <div class="text-[13px] font-bold text-white {{ $item->deadline && $item->deadline->isPast() ? 'text-red-400' : '' }}">
                                        {{ $item->deadline ? ($item->deadline->isPast() ? 'Closed' : $item->deadline->format('d M y')) : 'Open' }}
                                    </div>
                                    <div class="text-[10px] text-gray-500 mt-1">Deadline</div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3">
                                <a href="{{ route('scholarships.apply', $item) }}" 
                                   class="flex-1 bg-white hover:bg-gray-200 text-black py-4 rounded-2xl text-[13px] font-bold flex justify-center items-center gap-2 transition-colors">
                                    <i class="fa-regular fa-envelope"></i> Apply Now
                                </a>
                                
                                @if($item->link)
                                    <a href="{{ $item->link }}" target="_blank" 
                                       class="w-[52px] h-[52px] bg-white/10 hover:bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white transition-colors border border-white/10 shrink-0">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </a>
                                @else
                                    <button class="w-[52px] h-[52px] bg-white/10 hover:bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white transition-colors border border-white/10 shrink-0 cursor-not-allowed">
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
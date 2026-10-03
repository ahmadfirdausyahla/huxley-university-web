@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-28 right-0 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 w-72 h-72 rounded-full bg-brand-blue/10 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-blue-500"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-blue-500 uppercase">Huxley Gazette & Media</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">University Newsroom</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Trusted news, scientific research coverage, academic breakthroughs, and campus life updates directly from the official Huxley University source.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 border-b border-gray-800 mb-10" data-aos="fade-up">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-blue-400">Journal & Latest News</span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Latest Editions & Coverage</h2>
            </div>
            <div class="flex items-center gap-3 text-xs text-gray-400 font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Verified by Huxley Bureau</span>
            </div>
        </div>

        @if($news->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($news as $index => $item)
                    @php
                        $imageUrl = filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : asset('storage/' . $item->image);
                        $plainText = strip_tags($item->content ?? '');
                        $readTime = max(1, (int) ceil(str_word_count($plainText) / 180));
                    @endphp

                    <!-- Clean Light Card (Style Kanan Referensi) -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="bg-[#fafafa] rounded-[2rem] overflow-hidden flex flex-col group h-full shadow-2xl border border-gray-200">
                        
                        <!-- Padded Image Frame -->
                        <div class="relative p-2.5 w-full h-64">
                            @if($item->image)
                                <img src="{{ $imageUrl }}" alt="{{ $item->title }}"
                                     class="w-full h-full object-cover rounded-[1.5rem] group-hover:scale-105 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full rounded-[1.5rem] flex flex-col items-center justify-center bg-gray-200 text-gray-400">
                                    <i class="fa-regular fa-newspaper text-3xl mb-2"></i>
                                    <span class="text-[10px] uppercase font-bold tracking-widest text-gray-500">Huxley Press</span>
                                </div>
                            @endif
                            
                            <!-- Bookmark Overlay Icon (Right reference style) -->
                            <div class="absolute top-6 right-6 w-10 h-10 bg-black/40 hover:bg-black/70 backdrop-blur-md rounded-full flex items-center justify-center text-white cursor-pointer transition">
                                <i class="fa-regular fa-bookmark"></i>
                            </div>
                        </div>
                        
                        <!-- Content Area (White Background) -->
                        <div class="p-6 pt-3 flex-1 flex flex-col">
                            
                            <!-- Title & Verified Badge -->
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight line-clamp-2">
                                    <a href="{{ route('news.show', $item) }}" class="hover:text-blue-600 transition">{{ $item->title }}</a>
                                </h3>
                                <i class="fa-solid fa-circle-check text-blue-500 text-sm shrink-0"></i>
                            </div>
                            
                            <!-- Description -->
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-6 font-medium">
                                {{ \Illuminate\Support\Str::limit($plainText, 120) }}
                            </p>
                            
                            <!-- Stats Row (Rating | Earned | Rate style) -->
                            <div class="flex items-center justify-between px-1 mb-6 mt-auto">
                                <!-- Stat 1: Date -->
                                <div class="text-center flex-1">
                                    <div class="text-[13px] font-bold text-gray-900 flex items-center justify-center gap-1.5">
                                        <i class="fa-solid fa-star text-amber-500 text-[10px]"></i> {{ $item->created_at->format('d M') }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 mt-1">Published</div>
                                </div>
                                <div class="w-px h-6 bg-gray-300"></div>
                                <!-- Stat 2: Read Time -->
                                <div class="text-center flex-1">
                                    <div class="text-[13px] font-bold text-gray-900">{{ $readTime }} min</div>
                                    <div class="text-[10px] text-gray-400 mt-1">Read Time</div>
                                </div>
                                <div class="w-px h-6 bg-gray-300"></div>
                                <!-- Stat 3: Category -->
                                <div class="text-center flex-1">
                                    <div class="text-[13px] font-bold text-gray-900 truncate px-1">{{ $item->label ?? 'Press' }}</div>
                                    <div class="text-[10px] text-gray-400 mt-1">Category</div>
                                </div>
                            </div>
                            
                            <!-- Action Button (Dark Action Style) -->
                            <a href="{{ route('news.show', $item) }}" 
                               class="w-full bg-[#222] hover:bg-black text-white py-4 rounded-2xl text-[13px] font-bold flex justify-center items-center gap-2 transition-colors">
                                <i class="fa-regular fa-envelope"></i> Read Article
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-3xl p-16 text-center" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-900 text-blue-500 flex items-center justify-center mb-5 border border-gray-800">
                    <i class="fa-regular fa-newspaper text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white">No News Published Yet</h3>
                <p class="text-xs text-gray-400 mt-2">The editorial team is currently preparing the latest news.</p>
            </div>
        @endif
    </main>
</div>
@endsection
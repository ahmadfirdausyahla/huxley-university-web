@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24">
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-brand-blue/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-blue-500/5 blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-brand-blue"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Huxley University</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">University News</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Stay informed with the latest stories, academic achievements, campus developments, and community updates from Huxley University.
                </p>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex items-center justify-between mb-8" data-aos="fade-up">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Latest Stories</p>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">What's Happening</h2>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 text-xs font-semibold text-gray-400">
                <span class="w-2 h-2 rounded-full bg-brand-blue"></span>
                Huxley Communication Center
            </span>
        </div>

        @if($news->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($news as $index => $item)
                    @php
                        $imageUrl = filter_var($item->image, FILTER_VALIDATE_URL)
                            ? $item->image
                            : asset('storage/' . $item->image);
                    @endphp

                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                        class="group bg-gray-900 rounded-2xl border border-gray-800 overflow-hidden shadow-lg hover:shadow-brand-blue/10 hover:-translate-y-1.5 transition-all duration-500">
                        <a href="{{ route('news.show', $item) }}" class="block">
                            <div class="relative h-60 bg-gray-800 overflow-hidden">
                                @if($item->image)
                                    <img src="{{ $imageUrl }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                        <i class="fa-regular fa-newspaper text-4xl text-gray-600"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                                <span class="absolute top-5 left-5 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/80 backdrop-blur text-[10px] font-bold tracking-wider text-brand-blue uppercase border border-white/10">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                                    {{ $item->label ?? 'University News' }}
                                </span>
                            </div>
                        </a>

                        <div class="p-6">
                            <div class="flex items-center gap-2 text-[11px] text-brand-blue font-bold uppercase tracking-wider mb-3">
                                <i class="fa-regular fa-calendar"></i>
                                {{ $item->created_at->format('d F Y') }}
                            </div>
                            <h2 class="text-xl font-bold text-white leading-snug mb-3 group-hover:text-brand-blue transition">
                                <a href="{{ route('news.show', $item) }}">{{ $item->title }}</a>
                            </h2>

                            @if($item->content)
                                <p class="text-sm text-gray-400 leading-6 line-clamp-3 mb-6">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}
                                </p>
                            @endif

                            <a href="{{ route('news.show', $item) }}"
                                class="inline-flex items-center gap-3 text-xs font-bold tracking-wider text-white group-hover:text-brand-blue transition">
                                READ FULL STORY
                                <span class="w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center group-hover:border-brand-blue group-hover:bg-brand-blue/20 transition">
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-gray-800 rounded-3xl p-14 text-center shadow-lg" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-800 text-brand-blue flex items-center justify-center mb-5">
                    <i class="fa-regular fa-newspaper text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-black">No News Available</h2>
                <p class="text-sm text-gray-400 mt-2">There are no published stories at the moment. Please check back soon.</p>
            </div>
        @endif
    </main>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-brand-blue/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-blue-500/5 blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-brand-blue"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Huxley Gazette & Media</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">University Newsroom</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Warta terpercaya, liputan riset ilmiah, terobosan akademik, dan dinamika kehidupan kampus langsung dari sumber resmi Huxley University.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 border-b border-gray-800/80 mb-10" data-aos="fade-up">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-blue-400">Jurnal & Berita Terkini</span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Edisi & Liputan Terbaru</h2>
            </div>
            <div class="flex items-center gap-3 text-xs text-gray-400 font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Terverifikasi Biro Komunikasi Huxley</span>
            </div>
        </div>

        @if($news->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $index => $item)
                    @php
                        $imageUrl = filter_var($item->image, FILTER_VALIDATE_URL)
                            ? $item->image
                            : asset('storage/' . $item->image);
                        
                        $plainText = strip_tags($item->content ?? '');
                        $wordCount = str_word_count($plainText);
                        $readTime = max(1, (int) ceil($wordCount / 180));
                    @endphp

                    <!-- Card Berita (Journalism / Editorial Layout) -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="group flex flex-col justify-between bg-gradient-to-b from-gray-900 to-gray-950 rounded-2xl border border-gray-800/90 hover:border-gray-700 overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-400">
                        
                        <div>
                            <!-- Editorial Photo Frame with News Category Kicker -->
                            <div class="relative aspect-[16/10] bg-gray-900 overflow-hidden border-b border-gray-800">
                                @if($item->image)
                                    <img src="{{ $imageUrl }}" alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out filter brightness-[0.92] group-hover:brightness-100">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800/60 text-gray-600">
                                        <i class="fa-regular fa-newspaper text-4xl mb-2"></i>
                                        <span class="text-[10px] uppercase font-bold tracking-widest text-gray-500">Huxley Press</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950/90 via-transparent to-black/20"></div>

                                <!-- News Tag / Rubrik Berita -->
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold tracking-wider uppercase bg-black/85 backdrop-blur-md text-blue-400 border border-white/10 shadow-lg">
                                        <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                                        {{ $item->label ?? 'KABAR KAMPUS' }}
                                    </span>
                                </div>

                                <!-- Reading Time Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[10px] font-medium bg-black/70 backdrop-blur-md text-gray-300 border border-white/10">
                                        <i class="fa-regular fa-clock text-[9px] text-gray-400"></i>
                                        {{ $readTime }} mnt baca
                                    </span>
                                </div>
                            </div>

                            <!-- News Article Editorial Body -->
                            <div class="p-6">
                                <!-- Editorial Meta: Date & Byline -->
                                <div class="flex items-center gap-3 text-[11px] text-gray-400 uppercase tracking-wider font-semibold mb-3">
                                    <span class="text-blue-400 font-bold">Warta</span>
                                    <span class="text-gray-600">•</span>
                                    <time datetime="{{ $item->created_at->toISOString() }}">
                                        {{ $item->created_at->format('d M Y') }}
                                    </time>
                                    <span class="text-gray-600">•</span>
                                    <span class="text-gray-400 normal-case font-medium">Biro Pers</span>
                                </div>

                                <!-- News Title (Editorial Serif Typography) -->
                                <h3 class="text-lg md:text-xl font-serif font-bold text-white leading-snug group-hover:text-blue-400 transition-colors duration-200 line-clamp-2">
                                    <a href="{{ route('news.show', $item) }}">
                                        {{ $item->title }}
                                    </a>
                                </h3>

                                <!-- News Excerpt (Clean Gazette Readability) -->
                                @if($item->content)
                                    <p class="text-xs text-gray-400 leading-relaxed mt-3 line-clamp-3 font-sans">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 140) }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Card Action Footer (Journalistic Link Style) -->
                        <div class="px-6 pb-6 pt-3 mt-auto border-t border-gray-800/60 flex items-center justify-between">
                            <a href="{{ route('news.show', $item) }}" 
                               class="inline-flex items-center gap-2 text-xs font-bold text-blue-400 hover:text-white uppercase tracking-wider transition group-hover:translate-x-1 duration-300">
                                <span>Baca Artikel Lengkap</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                            <span class="text-gray-600 text-xs">
                                <i class="fa-regular fa-bookmark hover:text-blue-400 transition cursor-pointer" title="Simpan Artikel"></i>
                            </span>
                        </div>

                    </article>
                @endforeach
            </div>
        @else
            <div class="bg-gray-900 border border-gray-800 rounded-3xl p-16 text-center shadow-xl" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-800 text-blue-400 flex items-center justify-center mb-5 border border-gray-700">
                    <i class="fa-regular fa-newspaper text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-bold text-white">Belum Ada Warta Diterbitkan</h3>
                <p class="text-xs text-gray-400 mt-2 max-w-sm mx-auto">Redaksi saat ini sedang menyiapkan rilis berita terbaru. Silakan berkunjung kembali nanti.</p>
            </div>
        @endif
    </main>
</div>
@endsection
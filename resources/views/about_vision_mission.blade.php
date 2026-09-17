@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gray-950 border-b border-gray-800">
        <div class="absolute -top-32 right-0 w-96 h-96 rounded-full bg-brand-blue/15 blur-3xl"></div>
        <div class="absolute bottom-0 -left-28 w-80 h-80 rounded-full bg-blue-600/10 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-28">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-brand-blue"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">About Huxley University</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">
                    Vision & Mission
                </h1>
                <p class="max-w-2xl text-gray-400 mt-6 text-sm md:text-base leading-relaxed">
                    Forging enlightened thinkers, ethical innovators, and world-class leaders through interdisciplinary research, inclusive education, and pioneering technology.
                </p>
            </div>
        </div>
    </section>

    <!-- Vision Statement -->
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24 border-b border-gray-900">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5" data-aos="fade-right">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Our Grand Direction</span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mt-2">Vision 2035</h2>
                <div class="w-16 h-1 bg-brand-blue mt-4 mb-6 rounded-full"></div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Huxley University holds an unwavering commitment to becoming a top-tier international university recognized for cutting-edge technological impact and humane values.
                </p>
            </div>

            <div class="lg:col-span-7" data-aos="fade-left">
                <div class="relative p-8 md:p-12 rounded-3xl bg-gradient-to-br from-gray-900/90 to-gray-950 border border-gray-800 shadow-2xl shadow-blue-500/5">
                    <div class="absolute -top-4 -left-4 w-10 h-10 bg-brand-blue/20 rounded-2xl flex items-center justify-center text-brand-blue">
                        <i class="fa-solid fa-quote-left text-lg"></i>
                    </div>
                    <blockquote class="text-lg md:text-2xl font-serif text-white font-medium italic leading-relaxed">
                        "Menjadi universitas riset dan teknologi terkemuka di tingkat global yang berakar pada integritas moral, kepeloporan inovasi, dan dedikasi abadi bagi kemaslahatan peradaban manusia."
                    </blockquote>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-brand-blue flex items-center justify-center text-white text-xs font-bold">
                            HU
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white uppercase tracking-wider">Huxley Senate Council</p>
                            <p class="text-[10px] text-gray-500">Academic Strategic Blueprint 2025–2035</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Pillars -->
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24 border-b border-gray-900">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Strategic Commitments</span>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mt-2">The Four Mission Pillars</h2>
            <p class="text-gray-400 text-xs md:text-sm mt-3">Empowering every facet of our academic community towards excellence and purpose.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div data-aos="fade-up" data-aos-delay="100" class="p-8 rounded-2xl bg-gray-900/80 border border-gray-800 hover:border-brand-blue/40 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-600/10 text-brand-blue flex items-center justify-center text-xl mb-6">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h3 class="text-xl font-bold font-serif text-white mb-3">1. Pendidikan Holistik & Transformatif</h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Menyelenggarakan pendidikan tinggi berbasis kompetensi abad ke-21 dengan kurikulum adaptif, teknologi pembelajaran imersif, serta pembentukan karakter luhur dan jiwa kepemimpinan global.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="200" class="p-8 rounded-2xl bg-gray-900/80 border border-gray-800 hover:border-brand-blue/40 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-600/10 text-brand-blue flex items-center justify-center text-xl mb-6">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <h3 class="text-xl font-bold font-serif text-white mb-3">2. Riset Terapan & Inovasi Berkelanjutan</h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Mendorong ekosistem penelitian multi-disiplin bereputasi internasional yang melahirkan paten, publikasi terindeks tinggi, serta hilirisasi teknologi yang menjawab tantangan industri dan masyarakat.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="300" class="p-8 rounded-2xl bg-gray-900/80 border border-gray-800 hover:border-brand-blue/40 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-600/10 text-brand-blue flex items-center justify-center text-xl mb-6">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <h3 class="text-xl font-bold font-serif text-white mb-3">3. Pengabdian Berdampak Nyata</h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Mendedikasikan segenap kapasitas keilmuan dan keahlian untuk memajukan kesejahteraan masyarakat, inklusivitas sosial, dan pemberdayaan ekonomi regional dan nasional.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="400" class="p-8 rounded-2xl bg-gray-900/80 border border-gray-800 hover:border-brand-blue/40 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-600/10 text-brand-blue flex items-center justify-center text-xl mb-6">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <h3 class="text-xl font-bold font-serif text-white mb-3">4. Kolaborasi Jejaring Global</h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Membangun aliansi strategis dengan universitas ternama dunia, korporasi multinasional, dan lembaga donor untuk memfasilitasi mobilitas internasional mahasiswa dan peneliti.
                </p>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Campus Culture</span>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mt-2">Huxley Core Values</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div data-aos="zoom-in" data-aos-delay="100" class="p-6 rounded-2xl bg-gray-900/50 border border-gray-800 text-center">
                <span class="text-3xl font-serif font-bold text-brand-blue block mb-2">01</span>
                <h4 class="font-bold text-white text-sm">Integrity</h4>
                <p class="text-[11px] text-gray-400 mt-2">Kejujuran akademis, etika profesional, dan transparansi institusi.</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200" class="p-6 rounded-2xl bg-gray-900/50 border border-gray-800 text-center">
                <span class="text-3xl font-serif font-bold text-brand-blue block mb-2">02</span>
                <h4 class="font-bold text-white text-sm">Innovation</h4>
                <p class="text-[11px] text-gray-400 mt-2">Keberanian mengeksplorasi gagasan baru dan memecahkan batasan teknologi.</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300" class="p-6 rounded-2xl bg-gray-900/50 border border-gray-800 text-center">
                <span class="text-3xl font-serif font-bold text-brand-blue block mb-2">03</span>
                <h4 class="font-bold text-white text-sm">Inclusivity</h4>
                <p class="text-[11px] text-gray-400 mt-2">Merayakan keberagaman latar belakang, pemikiran, dan kesetaraan kesempatan.</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="400" class="p-6 rounded-2xl bg-gray-900/50 border border-gray-800 text-center">
                <span class="text-3xl font-serif font-bold text-brand-blue block mb-2">04</span>
                <h4 class="font-bold text-white text-sm">Sustainability</h4>
                <p class="text-[11px] text-gray-400 mt-2">Komitmen terhadap kelestarian lingkungan dan keberlanjutan bumi.</p>
            </div>
        </div>
    </section>
</div>
@endsection

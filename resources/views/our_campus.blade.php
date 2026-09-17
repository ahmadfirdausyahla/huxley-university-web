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
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Campus Life & Heritage</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">
                    Our Campus
                </h1>
                <p class="max-w-2xl text-gray-400 mt-6 text-sm md:text-base leading-relaxed">
                    Step into an interconnected 85-hectare smart campus combining neoclassical architecture, renewable energy installations, and cutting-edge collaborative hubs.
                </p>
            </div>
        </div>
    </section>

    <!-- Key Statistics Bar -->
    <section class="border-b border-gray-900 bg-gray-900/40">
        <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <span class="text-3xl md:text-4xl font-serif font-bold text-brand-blue">85+</span>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wider font-semibold">Hektar Smart Campus</p>
            </div>
            <div>
                <span class="text-3xl md:text-4xl font-serif font-bold text-brand-blue">45+</span>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wider font-semibold">Laboratorium Riset</p>
            </div>
            <div>
                <span class="text-3xl md:text-4xl font-serif font-bold text-brand-blue">120+</span>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wider font-semibold">Organisasi Mahasiswa</p>
            </div>
            <div>
                <span class="text-3xl md:text-4xl font-serif font-bold text-brand-blue">100%</span>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wider font-semibold">Cakupan Wi-Fi 6 & IoT</p>
            </div>
        </div>
    </section>

    <!-- Highlights Section -->
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Ecosystem of Discovery</span>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mt-2">Life at Huxley</h2>
            <p class="text-gray-400 text-xs md:text-sm mt-3">From lively student commons to tranquil study gardens, explore places that spark innovation.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div data-aos="fade-up" data-aos-delay="100" class="group rounded-2xl bg-gray-900/90 border border-gray-800 overflow-hidden hover:border-brand-blue/50 transition duration-500">
                <div class="relative h-60 overflow-hidden bg-gray-800">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=800&q=80" 
                         alt="Main Quadrangle" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                </div>
                <div class="p-6">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-blue">Heritage & Identity</span>
                    <h3 class="text-xl font-bold font-serif text-white mt-1">The Great Quadrangle</h3>
                    <p class="text-xs text-gray-400 mt-3 leading-relaxed">
                        Pusat ikonik kehidupan sosial mahasiswa, tempat penyelenggaraan upacara wisuda, festival seni kampus, dan orientasi mahasiswa baru.
                    </p>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="200" class="group rounded-2xl bg-gray-900/90 border border-gray-800 overflow-hidden hover:border-brand-blue/50 transition duration-500">
                <div class="relative h-60 overflow-hidden bg-gray-800">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=800&q=80" 
                         alt="Central Library" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                </div>
                <div class="p-6">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-blue">Knowledge Sanctuary</span>
                    <h3 class="text-xl font-bold font-serif text-white mt-1">Sir Huxley Memorial Library</h3>
                    <p class="text-xs text-gray-400 mt-3 leading-relaxed">
                        Perpustakaan 6 lantai dengan 500.000+ koleksi buku fisik, akses jurnal internasional tanpa batas, dan zona belajar hening 24 jam.
                    </p>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="300" class="group rounded-2xl bg-gray-900/90 border border-gray-800 overflow-hidden hover:border-brand-blue/50 transition duration-500">
                <div class="relative h-60 overflow-hidden bg-gray-800">
                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80" 
                         alt="Innovation Center" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                </div>
                <div class="p-6">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-blue">Startup Incubator</span>
                    <h3 class="text-xl font-bold font-serif text-white mt-1">Tech Venture Incubator</h3>
                    <p class="text-xs text-gray-400 mt-3 leading-relaxed">
                        Ruang kolaboratif yang menjembatani riset mahasiswa dengan modal ventura dan industri teknologi terkemuka dunia.
                    </p>
                </div>
            </div>
        </div>

        <!-- Campus Location & Visit Info -->
        <div class="mt-16 p-8 md:p-12 rounded-3xl bg-gray-900 border border-gray-800">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Visit & Experience</span>
                    <h3 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Campus Tours & Orientation</h3>
                    <p class="text-xs md:text-sm text-gray-400 mt-4 leading-relaxed">
                        Kami mengundang calon mahasiswa, orang tua, dan mitra untuk merasakan langsung atmosfer akademis Huxley University. Tur kampus terbuka setiap hari Senin hingga Jumat.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-4 text-xs text-gray-300">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-map-pin text-brand-blue"></i>
                            <span>Huxley Boulevard No. 1, Kota Pendidikan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-brand-blue"></i>
                            <span>+62 (021) 8888-HUXLEY</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('facility.index') }}" 
                       class="px-6 py-3.5 rounded-xl bg-brand-blue hover:bg-blue-600 text-white text-xs font-bold text-center transition shadow-lg shadow-blue-500/20">
                        Lihat Fasilitas Lengkap
                    </a>
                    <a href="{{ route('programs.index') }}" 
                       class="px-6 py-3.5 rounded-xl bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold text-center border border-gray-700 transition">
                        Eksplor Program Studi
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

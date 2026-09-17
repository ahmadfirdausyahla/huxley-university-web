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
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Academic Excellence</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Academic Programs</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Discover world-class undergraduate, vocational, and postgraduate curricula engineered to prepare future leaders, innovators, and industry pioneers.
                </p>

                <!-- Filter Jenjang Quick Bar -->
                <div class="flex flex-wrap gap-2.5 mt-8">
                    <a href="{{ route('programs.index') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ !request('degree') ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Semua Jenjang
                    </a>
                    <a href="{{ route('programs.index', ['degree' => 'S1']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('degree') == 'S1' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Sarjana (S1)
                    </a>
                    <a href="{{ route('programs.index', ['degree' => 'D3']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('degree') == 'D3' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Diploma 3 (D3)
                    </a>
                    <a href="{{ route('programs.index', ['degree' => 'S2']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('degree') == 'S2' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Pascasarjana (S2)
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12" data-aos="fade-up">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Curriculum & Degrees</p>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Available Study Programs</h2>
            </div>
            
            <form method="GET" action="{{ route('programs.index') }}" class="flex items-center gap-2">
                @if(request('degree'))
                    <input type="hidden" name="degree" value="{{ request('degree') }}">
                @endif
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program studi..."
                           class="w-full bg-gray-900 border border-gray-800 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-gray-500 focus:border-brand-blue outline-none transition">
                </div>
                <button type="submit" class="px-4 py-2.5 bg-brand-blue hover:bg-blue-600 rounded-xl text-xs font-bold text-white transition">
                    Cari
                </button>
            </form>
        </div>

        @if($programs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $index => $prog)
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="group bg-gray-900/90 rounded-2xl border border-gray-800 overflow-hidden shadow-xl hover:shadow-brand-blue/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between">
                        <div>
                            <div class="relative h-52 bg-gray-800 overflow-hidden">
                                <img src="{{ $prog->image_url }}" alt="{{ $prog->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-black/30"></div>
                                
                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-blue text-white shadow-md">
                                        {{ $prog->degree }}
                                    </span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold tracking-wider bg-black/60 backdrop-blur-md text-emerald-400 border border-emerald-500/30">
                                        Akreditasi {{ $prog->accreditation }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-brand-blue">{{ $prog->faculty }}</span>
                                <h3 class="text-xl font-bold font-serif text-white mt-1 group-hover:text-blue-400 transition">{{ $prog->name }}</h3>
                                
                                <p class="text-xs text-gray-400 mt-3 line-clamp-3 leading-relaxed">
                                    {{ $prog->description ?: 'Program studi unggulan Huxley University yang dirancang untuk menghasilkan lulusan kompeten dan siap kerja secara global.' }}
                                </p>

                                @if($prog->career_prospects)
                                    <div class="mt-4 pt-4 border-t border-gray-800/80">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-2">Prospek Karir:</p>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach(array_slice(explode(',', $prog->career_prospects), 0, 3) as $career)
                                                <span class="text-[10px] bg-gray-800 px-2.5 py-1 rounded-lg text-gray-300">
                                                    {{ trim($career) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0 border-t border-gray-800/50 flex items-center justify-between mt-4">
                            <div>
                                <span class="text-[10px] text-gray-500 uppercase block tracking-wider">Durasi Studi</span>
                                <span class="text-xs font-bold text-gray-300">{{ $prog->duration_years }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] text-gray-500 uppercase block tracking-wider">UKT / Semester</span>
                                <span class="text-xs font-bold text-brand-blue">{{ $prog->tuition_fee ?: 'Sesuai Golongan' }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($programs->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $programs->links() }}
                </div>
            @endif
        @else
            <div class="py-24 text-center rounded-2xl border border-gray-800 bg-gray-900/50">
                <i class="fa-solid fa-graduation-cap text-4xl text-gray-600 mb-4"></i>
                <h3 class="text-lg font-bold text-white">Belum Ada Program Studi yang Ditemukan</h3>
                <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci pencarian lain atau ganti filter jenjang studi.</p>
                <a href="{{ route('programs.index') }}" class="inline-block mt-4 text-xs font-bold text-brand-blue hover:underline">Reset Pencarian</a>
            </div>
        @endif
    </main>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="bg-[#0a0a0a] border-b border-white/8">
        <div class="max-w-7xl mx-auto px-6 py-18 md:py-22">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-8 h-px bg-white/40"></span>
                    <span class="text-[10px] font-bold tracking-[0.3em] text-white/50 uppercase">Endowment & Financial Aid</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight tracking-tight">Scholarships & Grants</h1>
                <p class="max-w-2xl text-gray-400 mt-4 text-sm leading-7">
                    Huxley University berkomitmen membuka akses pendidikan seluas-luasnya melalui beasiswa prestasi akademik, fellowship riset, dan subsidi pembiayaan kuliah bagi generasi penerus bangsa.
                </p>

                <!-- Filter Bar -->
                <div class="flex flex-wrap gap-2 mt-7">
                    <a href="{{ route('scholarships.index') }}"
                       class="px-4 py-1.5 rounded-lg text-xs font-semibold transition border {{ !request('coverage_type') ? 'bg-white text-black border-white' : 'bg-transparent text-white/60 border-white/15 hover:border-white/30 hover:text-white' }}">
                        Semua Program
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'full']) }}"
                       class="px-4 py-1.5 rounded-lg text-xs font-semibold transition border {{ request('coverage_type') == 'full' ? 'bg-white text-black border-white' : 'bg-transparent text-white/60 border-white/15 hover:border-white/30 hover:text-white' }}">
                        Beasiswa Penuh
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'partial']) }}"
                       class="px-4 py-1.5 rounded-lg text-xs font-semibold transition border {{ request('coverage_type') == 'partial' ? 'bg-white text-black border-white' : 'bg-transparent text-white/60 border-white/15 hover:border-white/30 hover:text-white' }}">
                        Beasiswa Sebagian
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'living_allowance']) }}"
                       class="px-4 py-1.5 rounded-lg text-xs font-semibold transition border {{ request('coverage_type') == 'living_allowance' ? 'bg-white text-black border-white' : 'bg-transparent text-white/60 border-white/15 hover:border-white/30 hover:text-white' }}">
                        Tunjangan Hidup
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-18">

        @if(session('success'))
            <div class="bg-white/5 border border-white/10 text-white p-4 rounded-xl mb-10 text-xs flex items-center gap-3" data-aos="fade-down">
                <i class="fa-solid fa-circle-check text-white text-sm"></i>
                <div class="flex-1 font-medium">{{ session('success') }}</div>
            </div>
        @endif

        <!-- Section Header + Search -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 pb-6 border-b border-white/8 mb-10" data-aos="fade-up">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-white/40">Peluang Pendanaan</span>
                <h2 class="text-xl font-bold text-white mt-1">Daftar Program Beasiswa Aktif</h2>
            </div>
            <form method="GET" action="{{ route('scholarships.index') }}" class="flex items-center gap-2">
                @if(request('coverage_type'))
                    <input type="hidden" name="coverage_type" value="{{ request('coverage_type') }}">
                @endif
                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-white/30"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari beasiswa atau mitra..."
                           class="w-full bg-white/5 border border-white/10 rounded-lg pl-9 pr-4 py-2.5 text-xs text-white placeholder-white/30 focus:border-white/30 outline-none transition">
                </div>
                <button type="submit" class="px-4 py-2.5 bg-white hover:bg-white/90 rounded-lg text-xs font-bold text-black transition">
                    Cari
                </button>
            </form>
        </div>

        @if($scholarships->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($scholarships as $index => $item)
                    <!-- Card Beasiswa — Clean Modern -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 80 }}"
                             class="group flex flex-col bg-[#111111] border border-white/8 rounded-2xl overflow-hidden hover:border-white/20 transition-all duration-300">

                        <!-- Image -->
                        <div class="relative h-44 bg-[#1a1a1a] overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                 class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent"></div>

                            <!-- Type Tag -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-black/80 text-white border border-white/10">
                                    <i class="fa-solid fa-award text-[9px]"></i>
                                    {{ $item->coverage_type_label }}
                                </span>
                            </div>

                            <!-- Deadline -->
                            @if($item->deadline)
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[10px] font-medium bg-black/80 border border-white/10 {{ $item->deadline->isPast() ? 'text-red-400' : 'text-white/70' }}">
                                        <i class="fa-regular fa-clock text-[9px]"></i>
                                        {{ $item->deadline->isPast() ? 'Ditutup' : $item->deadline->format('d M Y') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Body -->
                        <div class="flex flex-col flex-1 p-5">
                            <!-- Provider -->
                            <p class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-1.5">
                                {{ $item->provider ?: 'Huxley University' }}
                            </p>

                            <!-- Title -->
                            <h3 class="text-base font-bold text-white leading-snug line-clamp-2 group-hover:text-white/80 transition">
                                {{ $item->title }}
                            </h3>

                            <!-- Description -->
                            <p class="text-xs text-white/40 leading-relaxed mt-2.5 line-clamp-2 flex-1">
                                {{ $item->description ?: 'Bantuan biaya pendidikan dari Huxley University untuk mahasiswa berprestasi dan berdedikasi tinggi.' }}
                            </p>

                            <!-- Amount -->
                            @if($item->amount)
                                <div class="mt-4 pt-4 border-t border-white/8 flex items-center justify-between text-xs">
                                    <span class="text-white/40 text-[10px] uppercase tracking-wider font-semibold">Nilai Bantuan</span>
                                    <span class="font-bold text-white font-mono">{{ $item->amount }}</span>
                                </div>
                            @endif

                            <!-- Requirements -->
                            @if($item->requirements)
                                <div class="mt-3 flex flex-wrap gap-1.5">
                                    @foreach(array_slice(explode(',', $item->requirements), 0, 3) as $req)
                                        <span class="text-[10px] bg-white/5 border border-white/8 px-2 py-0.5 rounded text-white/50">
                                            {{ trim($req) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Action -->
                            <div class="mt-5 pt-4 border-t border-white/8 flex items-center gap-2">
                                <a href="{{ route('scholarships.apply', $item) }}"
                                   class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white hover:bg-white/90 text-black font-bold text-xs transition">
                                    <i class="fa-solid fa-file-pen text-[11px]"></i>
                                    <span>Ajukan Beasiswa</span>
                                </a>
                                @if($item->link)
                                    <a href="{{ $item->link }}" target="_blank" title="Tautan Resmi"
                                       class="p-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-white/60 hover:text-white transition border border-white/8">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
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
            <div class="border border-white/8 rounded-2xl p-16 text-center" data-aos="fade-up">
                <div class="w-14 h-14 mx-auto rounded-xl bg-white/5 border border-white/8 text-white/30 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-white">Belum Ada Program Beasiswa</h3>
                <p class="text-xs text-white/40 mt-2 max-w-sm mx-auto">Coba gunakan kata kunci pencarian lain atau pilih filter yang berbeda.</p>
                <a href="{{ route('scholarships.index') }}" class="inline-block mt-4 text-xs font-bold text-white/50 hover:text-white underline underline-offset-4">Reset Pencarian</a>
            </div>
        @endif
    </main>
</div>
@endsection

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
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Financial Aid & Grants</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Scholarships & Grants</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Huxley University is committed to empowering talented students worldwide through merit awards, research fellowships, and full-coverage education sponsorships.
                </p>

                <!-- Filter Quick Bar -->
                <div class="flex flex-wrap gap-2.5 mt-8">
                    <a href="{{ route('scholarships.index') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ !request('coverage_type') ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Semua Beasiswa
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'full']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('coverage_type') == 'full' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Beasiswa Penuh (Full)
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'partial']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('coverage_type') == 'partial' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Beasiswa Sebagian
                    </a>
                    <a href="{{ route('scholarships.index', ['coverage_type' => 'living_allowance']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ request('coverage_type') == 'living_allowance' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'bg-gray-800/80 text-gray-400 hover:text-white hover:bg-gray-800' }}">
                        Biaya Hidup
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12" data-aos="fade-up">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-blue">Empowering Potential</p>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Open Opportunities</h2>
            </div>
            
            <form method="GET" action="{{ route('scholarships.index') }}" class="flex items-center gap-2">
                @if(request('coverage_type'))
                    <input type="hidden" name="coverage_type" value="{{ request('coverage_type') }}">
                @endif
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari beasiswa atau mitra..."
                           class="w-full bg-gray-900 border border-gray-800 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-gray-500 focus:border-brand-blue outline-none transition">
                </div>
                <button type="submit" class="px-4 py-2.5 bg-brand-blue hover:bg-blue-600 rounded-xl text-xs font-bold text-white transition">
                    Cari
                </button>
            </form>
        </div>

        @if($scholarships->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($scholarships as $index => $item)
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="group bg-gray-900/90 rounded-2xl border border-gray-800 overflow-hidden shadow-xl hover:shadow-brand-blue/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between">
                        <div>
                            <div class="relative h-56 bg-gray-800 overflow-hidden">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-black/30"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $item->coverage_type === 'full' ? 'bg-emerald-600 text-white' : 'bg-brand-blue text-white' }} shadow-md">
                                        {{ $item->coverage_type_label }}
                                    </span>
                                </div>

                                @if($item->deadline)
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-black/60 backdrop-blur-md {{ $item->deadline->isPast() ? 'text-red-400 border border-red-500/30' : 'text-amber-300 border border-amber-500/30' }}">
                                            <i class="fa-regular fa-clock text-[9px]"></i>
                                            {{ $item->deadline->isPast() ? 'Ditutup' : 'Deadline: ' . $item->deadline->format('d M Y') }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-brand-blue">{{ $item->provider ?: 'Huxley University' }}</span>
                                <h3 class="text-xl font-bold font-serif text-white mt-1 group-hover:text-blue-400 transition">{{ $item->title }}</h3>
                                
                                @if($item->amount)
                                    <div class="mt-2 inline-block px-2.5 py-1 rounded-lg bg-blue-950/60 border border-blue-800/40 text-blue-300 text-[11px] font-semibold">
                                        <i class="fa-solid fa-gift mr-1 text-[10px]"></i> {{ $item->amount }}
                                    </div>
                                @endif

                                <p class="text-xs text-gray-400 mt-3 line-clamp-3 leading-relaxed">
                                    {{ $item->description ?: 'Bantuan biaya pendidikan dari Huxley University untuk mahasiswa berprestasi dan berdedikasi tinggi.' }}
                                </p>

                                @if($item->requirements)
                                    <div class="mt-4 pt-4 border-t border-gray-800/80">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-2">Persyaratan Utama:</p>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach(array_slice(explode(',', $item->requirements), 0, 3) as $req)
                                                <span class="text-[10px] bg-gray-800 px-2.5 py-1 rounded-lg text-gray-300">
                                                    {{ trim($req) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0 mt-3">
                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank"
                                   class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-brand-blue hover:bg-blue-600 text-white font-bold text-xs transition shadow-md shadow-blue-500/10">
                                    <span>Informasi & Pendaftaran</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            @else
                                <div class="w-full py-2.5 px-4 rounded-xl bg-gray-800/60 border border-gray-700/50 text-center text-xs text-gray-300 font-medium">
                                    Pendaftaran via Kemahasiswaan Kampus
                                </div>
                            @endif
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
            <div class="py-24 text-center rounded-2xl border border-gray-800 bg-gray-900/50">
                <i class="fa-solid fa-graduation-cap text-4xl text-gray-600 mb-4"></i>
                <h3 class="text-lg font-bold text-white">Belum Ada Program Beasiswa</h3>
                <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci pencarian lain atau pilih filter yang berbeda.</p>
                <a href="{{ route('scholarships.index') }}" class="inline-block mt-4 text-xs font-bold text-brand-blue hover:underline">Reset Pencarian</a>
            </div>
        @endif
    </main>
</div>
@endsection

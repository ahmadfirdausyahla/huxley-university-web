@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="bg-slate-50 min-h-screen py-10 text-slate-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumb & Navigation -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-blue-600 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-3 shadow-sm">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div>
                    <span class="font-bold block text-sm">Sukses</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Grid Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Content Left Column -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Main Header Image -->
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        @if($event->image)
                            <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-100">
                                <i class="fa-regular fa-image text-4xl mb-2"></i>
                                <span class="text-xs font-medium">Tidak ada gambar cover</span>
                            </div>
                        @endif

                        <span class="absolute top-4 left-4 {{ $event->isMahasiswaOnly() ? 'bg-indigo-600' : 'bg-blue-600' }} text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow">
                            {{ $event->category_label }}
                        </span>
                    </div>

                    <div class="p-6 sm:p-8 space-y-4">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                            {{ $event->title }}
                        </h1>

                        @if($event->description)
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed border-l-4 border-blue-500 pl-4 bg-slate-50 py-2">
                                {{ $event->description }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Content Article Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm space-y-4">
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider pb-3 border-b border-slate-100">
                        Tentang Event Ini
                    </h2>
                    <div class="prose prose-slate prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed">
                        {!! $event->content ?? '<p class="text-slate-400 italic">Belum ada rincian lengkap untuk event ini.</p>' !!}
                    </div>
                </div>

            </div>

            <!-- Sidebar Info Right Column -->
            <div class="space-y-6">
                
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm sticky top-6 space-y-6">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider pb-4 border-b border-slate-100">
                        Rincian Pelaksanaan
                    </h3>

                    <div class="space-y-4 text-xs">
                        <!-- Tanggal Event -->
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                <i class="fa-regular fa-calendar-check text-base"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold uppercase text-slate-400">Tanggal</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d F Y') : 'Tanggal Belum Ditetapkan' }}
                                </span>
                            </div>
                        </div>

                        <!-- Lokasi Event -->
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                <i class="fa-solid fa-location-dot text-base"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold uppercase text-slate-400">Lokasi</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->location ?? 'Online / TBD' }}
                                </span>
                            </div>
                        </div>

                        <!-- Kuota Peserta -->
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                <i class="fa-solid fa-users text-base"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold uppercase text-slate-400">Kuota</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->quota ? $event->quota . ' Orang' : 'Terbatas' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-4 border-t border-slate-100">
                        @if($event->registration_open)
                            <a href="{{ $event->isMahasiswaOnly() ? route('events.register.student', $event) : route('events.register.public', $event) }}" 
                               class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-3.5 px-4 rounded-xl transition shadow-md shadow-blue-500/10">
                                <span>Daftar Event Sekarang</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        @else
                            <button disabled class="w-full bg-slate-100 text-slate-400 font-bold text-xs py-3.5 px-4 rounded-xl cursor-not-allowed text-center">
                                Pendaftaran Ditutup
                            </button>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
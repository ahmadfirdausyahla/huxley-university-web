@extends('layouts.app')

@section('title', $event->title)

@section('content')
<!-- Background utama diubah ke slate-900 (dark navy/grey) seperti referensi, sisa konten tetap putih -->
<div class="bg-slate-900 min-h-screen pt-28 pb-12 text-slate-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumb & Navigation - Disesuaikan agar terbaca di bg gelap -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition">
            <i class="fa-solid fa-arrow-left"></i> Back to Home
        </a>

        @if(session('success'))
            <!-- Alert success tetap dipertahankan warna hijaunya -->
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-3 shadow-md">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div>
                    <span class="font-bold block text-sm">Success</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Grid Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Content Left Column (2 Cols) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Main Header Image & Title Card - Dikembalikan ke Putih -->
                <div class="bg-white rounded-3xl border-0 overflow-hidden shadow-2xl shadow-black/20">
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        @if($event->image)
                            <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-100">
                                <i class="fa-regular fa-image text-4xl mb-2"></i>
                                <span class="text-xs font-medium">No image</span>
                            </div>
                        @endif

                        <span class="absolute top-4 left-4 {{ $event->isMahasiswaOnly() ? 'bg-indigo-600' : 'bg-blue-600' }} text-white text-[10px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full shadow-lg">
                            {{ $event->category_label }}
                        </span>
                    </div>

                    <div class="p-6 sm:p-8 space-y-4">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                            {{ $event->title }}
                        </h1>

                        @if($event->description)
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed border-l-4 border-blue-500 pl-4 bg-slate-50 py-3 rounded-r-xl">
                                {{ $event->description }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Content Article Card - Dikembalikan ke Putih -->
                <div class="bg-white rounded-3xl border-0 p-6 sm:p-8 shadow-2xl shadow-black/20 space-y-4">
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider pb-3 border-b border-slate-100">
                        About This Event
                    </h2>
                    <div class="prose prose-slate prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed">
                        {!! $event->content ?? '<p class="text-slate-400 italic">No detailed information available for this event yet.</p>' !!}
                    </div>
                </div>

            </div>

            <!-- Sidebar Info Right Column (1 Col) -->
            <div class="space-y-6">
                
                <!-- Sidebar Card - Dikembalikan ke Putih -->
                <div class="bg-white rounded-3xl border-0 p-6 shadow-2xl shadow-black/20 sticky top-28 space-y-6">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider pb-4 border-b border-slate-100">
                        Event Details
                    </h3>

                    <div class="space-y-5 text-xs">
                        <!-- Event Date -->
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                <i class="fa-regular fa-calendar-check text-base"></i>
                            </div>
                            <div class="pt-0.5">
                                <span class="block text-[10px] font-bold uppercase text-slate-400 mb-0.5">Date</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->event_date ? $event->event_date->format('d F Y') : 'Date Not Set' }}
                                </span>
                            </div>
                        </div>

                        <!-- Event Location -->
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                <i class="fa-solid fa-location-dot text-base"></i>
                            </div>
                            <div class="pt-0.5">
                                <span class="block text-[10px] font-bold uppercase text-slate-400 mb-0.5">Location</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->location ?? 'Online / TBD' }}
                                </span>
                            </div>
                        </div>

                        <!-- Event Quota -->
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                <i class="fa-solid fa-users text-base"></i>
                            </div>
                            <div class="pt-0.5">
                                <span class="block text-[10px] font-bold uppercase text-slate-400 mb-0.5">Quota</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->quota ? $event->quota . ' People' : 'Limited' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-5 border-t border-slate-100">
                        @if($event->registration_open)
                            <a href="{{ $event->isMahasiswaOnly() ? route('events.register.student', $event) : route('events.register.public', $event) }}" 
                               class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-3.5 px-4 rounded-xl transition shadow-lg shadow-blue-500/30">
                                <span>Register for Event Now</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        @else
                            <button disabled class="w-full bg-slate-100 text-slate-400 font-bold text-xs py-3.5 px-4 rounded-xl cursor-not-allowed text-center">
                                Registration Closed
                            </button>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
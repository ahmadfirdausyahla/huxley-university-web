@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="relative min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/40 to-indigo-50/40 py-10 text-slate-800 overflow-hidden">
    
    <!-- Decorative Background Elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-400/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[10%] right-[-5%] w-[400px] h-[400px] bg-indigo-400/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumb & Navigation -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-blue-600 transition bg-white/50 px-4 py-2 rounded-full backdrop-blur-sm border border-white">
            <i class="fa-solid fa-arrow-left"></i> Back to Home
        </a>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/10 backdrop-blur-md border border-emerald-500/20 text-emerald-800 text-xs flex items-center gap-3 shadow-lg shadow-emerald-500/5">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20">
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
                
                <!-- Main Header Image -->
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl border border-white/60 overflow-hidden shadow-xl shadow-blue-900/5">
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        @if($event->image)
                            <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-gradient-to-br from-slate-100 to-slate-200">
                                <i class="fa-regular fa-image text-4xl mb-2"></i>
                                <span class="text-xs font-medium">No image</span>
                            </div>
                        @endif

                        <span class="absolute top-5 left-5 {{ $event->isMahasiswaOnly() ? 'bg-indigo-600' : 'bg-blue-600' }} text-white text-[10px] font-bold uppercase tracking-wider px-4 py-1.5 rounded-full shadow-lg border border-white/20 backdrop-blur-md">
                            {{ $event->category_label }}
                        </span>
                    </div>

                    <div class="p-6 sm:p-8 space-y-4">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                            {{ $event->title }}
                        </h1>

                        @if($event->description)
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed border-l-4 border-blue-500 pl-4 bg-blue-50/50 py-3 pr-3 rounded-r-xl">
                                {{ $event->description }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Content Article Card -->
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl border border-white/60 p-6 sm:p-8 shadow-xl shadow-blue-900/5 space-y-4">
                    <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-circle-info"></i> About This Event
                    </h2>
                    <div class="prose prose-slate prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed">
                        {!! $event->content ?? '<p class="text-slate-400 italic">No detailed information available for this event yet.</p>' !!}
                    </div>
                </div>

            </div>

            <!-- Sidebar Info Right Column (1 Col) -->
            <div class="space-y-6">
                
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl border border-white/60 p-6 shadow-xl shadow-blue-900/5 sticky top-6 space-y-6">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider pb-4 border-b border-slate-100">
                        Event Details
                    </h3>

                    <div class="space-y-5 text-xs">
                        <!-- Event Date -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 text-blue-600 flex items-center justify-center shrink-0 border border-blue-200 shadow-inner">
                                <i class="fa-regular fa-calendar-check text-lg"></i>
                            </div>
                            <div class="pt-1">
                                <span class="block text-[10px] font-bold uppercase text-slate-400 mb-0.5">Date</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->event_date ? $event->event_date->format('d F Y') : 'Date Not Set' }}
                                </span>
                            </div>
                        </div>

                        <!-- Event Location -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 border border-indigo-200 shadow-inner">
                                <i class="fa-solid fa-location-dot text-lg"></i>
                            </div>
                            <div class="pt-1">
                                <span class="block text-[10px] font-bold uppercase text-slate-400 mb-0.5">Location</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->location ?? 'Online / TBD' }}
                                </span>
                            </div>
                        </div>

                        <!-- Event Quota -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-200 shadow-inner">
                                <i class="fa-solid fa-users text-lg"></i>
                            </div>
                            <div class="pt-1">
                                <span class="block text-[10px] font-bold uppercase text-slate-400 mb-0.5">Quota</span>
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">
                                    {{ $event->quota ? $event->quota . ' People' : 'Limited' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-6 border-t border-slate-100">
                        @if($event->registration_open)
                            <a href="{{ $event->isMahasiswaOnly() ? route('events.register.student', $event) : route('events.register.public', $event) }}" 
                               class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-xs py-4 px-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transform hover:-translate-y-0.5">
                                <span>Register for Event Now</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        @else
                            <button disabled class="w-full bg-slate-100 text-slate-400 font-bold text-xs py-4 px-4 rounded-xl cursor-not-allowed text-center border border-slate-200">
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
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-28 right-0 w-80 h-80 rounded-full bg-amber-500/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 w-72 h-72 rounded-full bg-brand-blue/10 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-amber-400"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-amber-400 uppercase">Agenda & Konferensi Kampus</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Events & Activities</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Ikuti simposium akademik, kuliah umum bersama praktisi industri, workshop riset, dan festival kampus bergengsi yang membuka ruang kolaborasi global.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 pb-6 border-b border-gray-800/80 mb-10" data-aos="fade-up">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-amber-400">Kalender Kegiatan</span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Jadwal Agenda Mendatang</h2>
            </div>
            <div class="flex items-center gap-3 text-xs font-semibold text-gray-400">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-900 border border-gray-800 text-gray-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span> Registrasi Online Tersedia
                </span>
            </div>
        </div>

        @if($events->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $index => $event)
                    @php
                        $imageUrl = filter_var($event->image, FILTER_VALIDATE_URL)
                            ? $event->image
                            : asset('storage/' . $event->image);
                        
                        $eventDate = $event->event_date ?? $event->date;
                    @endphp

                    <!-- Card Event (Ticket Notice & Conference Announcement Pass) -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                             class="group relative flex flex-col justify-between bg-gray-900 rounded-3xl border border-gray-800 hover:border-amber-500/50 overflow-hidden shadow-2xl transition-all duration-400 hover:-translate-y-2">
                        
                        <div>
                            <!-- Event Image Header with Calendar Badge Overlay -->
                            <div class="relative h-56 bg-gray-950 overflow-hidden">
                                @if($event->image)
                                    <img src="{{ $imageUrl }}" alt="{{ $event->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 filter brightness-90">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800/50 text-gray-500">
                                        <i class="fa-regular fa-calendar-days text-4xl mb-2"></i>
                                        <span class="text-[10px] font-bold uppercase tracking-widest">Huxley Events</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/40 to-transparent"></div>

                                <!-- Tear-Off Calendar Date Box (Announcement Style) -->
                                <div class="absolute top-4 left-4 bg-black/90 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden shadow-2xl text-center min-w-[62px]">
                                    <div class="bg-amber-500 text-black text-[10px] font-extrabold uppercase tracking-wider py-0.5 px-2">
                                        {{ $eventDate ? $eventDate->format('M') : 'TBA' }}
                                    </div>
                                    <div class="py-1 px-2">
                                        <span class="block text-2xl font-black font-sans text-white leading-none">
                                            {{ $eventDate ? $eventDate->format('d') : '01' }}
                                        </span>
                                        <span class="block text-[9px] font-bold text-gray-400 uppercase mt-0.5">
                                            {{ $eventDate ? $eventDate->format('D') : 'DAY' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Audience Eligibility Tag -->
                                <div class="absolute top-4 right-4 flex flex-col items-end gap-1.5">
                                    @if($event->isMahasiswaOnly())
                                        <span class="px-3 py-1 rounded-full bg-blue-600/90 text-white text-[10px] font-bold uppercase tracking-wider backdrop-blur-md shadow-md border border-blue-400/40">
                                            <i class="fa-solid fa-graduation-cap text-[9px] mr-1"></i> Khusus Mahasiswa
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-emerald-600/90 text-white text-[10px] font-bold uppercase tracking-wider backdrop-blur-md shadow-md border border-emerald-400/40">
                                            <i class="fa-solid fa-users text-[9px] mr-1"></i> Umum & Mahasiswa
                                        </span>
                                    @endif

                                    @if($event->quota)
                                        <span class="px-2.5 py-0.5 rounded-full bg-black/75 text-gray-300 text-[9px] font-semibold border border-white/10">
                                            Kuota: {{ $event->quota }} Kursi
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Event Details Body -->
                            <div class="p-6">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-amber-400">
                                    {{ $event->category ?? 'SEMINAR & WORKSHOP' }}
                                </span>

                                <h3 class="text-xl font-bold font-serif text-white group-hover:text-amber-400 transition-colors leading-snug mt-1 line-clamp-2">
                                    <a href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
                                </h3>

                                @if($event->description)
                                    <p class="text-xs text-gray-400 leading-relaxed mt-2.5 line-clamp-2">
                                        {{ $event->description }}
                                    </p>
                                @endif

                                <!-- Event Logistics Chips (Time & Location) -->
                                <div class="mt-4 pt-4 border-t border-gray-800/80 space-y-2 text-xs">
                                    <div class="flex items-center gap-2.5 text-gray-300">
                                        <span class="w-6 h-6 rounded-lg bg-gray-800 text-amber-400 flex items-center justify-center shrink-0 text-[11px] border border-gray-700">
                                            <i class="fa-regular fa-clock"></i>
                                        </span>
                                        <span class="font-medium text-[11px]">
                                            @if($event->start_time)
                                                {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB
                                                @if($event->end_time)
                                                    - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB
                                                @endif
                                            @else
                                                09:00 WIB s/d Selesai
                                            @endif
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2.5 text-gray-300">
                                        <span class="w-6 h-6 rounded-lg bg-gray-800 text-amber-400 flex items-center justify-center shrink-0 text-[11px] border border-gray-700">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <span class="font-medium text-[11px] line-clamp-1">
                                            {{ $event->location ?: 'Kampus Utama Huxley University' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Perforated Ticket Divider & Action Footer -->
                        <div class="px-6 pb-6 pt-4 border-t border-dashed border-gray-800 relative">
                            <!-- Left and Right Ticket Notches -->
                            <div class="absolute -left-3 top-[-9px] w-4 h-4 bg-black rounded-full border-r border-gray-800"></div>
                            <div class="absolute -right-3 top-[-9px] w-4 h-4 bg-black rounded-full border-l border-gray-800"></div>

                            <div class="grid grid-cols-2 gap-2.5">
                                <a href="{{ route('events.show', $event) }}"
                                   class="inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-gray-800/80 hover:bg-gray-800 text-gray-300 hover:text-white text-xs font-bold transition border border-gray-700">
                                    <span>Detail Acara</span>
                                    <i class="fa-solid fa-circle-info text-[10px]"></i>
                                </a>

                                <a href="{{ route('events.register', $event) }}"
                                   class="inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-extrabold transition shadow-lg shadow-amber-500/20 group-hover:scale-[1.02]">
                                    <i class="fa-solid fa-ticket text-[11px]"></i>
                                    <span>Daftar Event</span>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>
        @else
            <div class="bg-gray-900 border border-gray-800 rounded-3xl p-16 text-center shadow-xl" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-800 text-amber-400 flex items-center justify-center mb-5 border border-gray-700">
                    <i class="fa-regular fa-calendar-xmark text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-bold text-white">Belum Ada Agenda Terjadwal</h3>
                <p class="text-xs text-gray-400 mt-2 max-w-sm mx-auto">Pantau terus pengumuman jadwal kegiatan dan seminar akademik mendatang di halaman ini.</p>
            </div>
        @endif
    </main>
</div>
@endsection
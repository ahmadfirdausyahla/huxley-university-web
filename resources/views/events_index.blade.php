@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-28 right-0 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 w-72 h-72 rounded-full bg-brand-blue/10 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="w-10 h-px bg-blue-500"></span>
                    <span class="text-[11px] font-bold tracking-[0.28em] text-blue-500 uppercase">Campus Agenda & Conferences</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Events & Activities</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Attend academic symposiums, lectures with industry practitioners, research workshops, and prestigious campus festivals that open spaces for global collaboration.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 pb-6 border-b border-gray-800/80 mb-10" data-aos="fade-up">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-blue-400">Activity Calendar</span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Upcoming Events Schedule</h2>
            </div>
            <div class="flex items-center gap-3 text-xs font-semibold text-gray-400">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-900 border border-gray-800 text-gray-300">
                    <i class="fa-solid fa-globe text-blue-400"></i> Online Registration Available
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
                        
                        // Menangani perbedaan nama kolom waktu (start_time atau time)
                        $timeToDisplay = '09:00';
                        if (!empty($event->start_time)) {
                            $timeToDisplay = \Carbon\Carbon::parse($event->start_time)->format('H:i');
                        } elseif (!empty($event->time)) {
                            $timeToDisplay = \Carbon\Carbon::parse($event->time)->format('H:i');
                        }
                    @endphp

                    <!-- Ticket-Style Event Card -->
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                        class="group relative flex flex-col bg-white rounded-[24px] overflow-hidden shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-white/10 transition-all duration-300">
                        
                        <!-- Top Content Area -->
                        <div class="p-4 pb-6 bg-white relative z-10">
                            <!-- Image Container -->
                            <div class="relative h-56 rounded-2xl overflow-hidden mb-5">
                                @if($event->image)
                                    <img src="{{ $imageUrl }}" alt="{{ $event->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <i class="fa-regular fa-calendar text-4xl"></i>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                
                                <!-- Category Badge inside Image -->
                                <div class="absolute bottom-3 left-3">
                                    <span class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-white/95 backdrop-blur-sm text-gray-900 shadow-sm flex items-center gap-1.5">
                                        @if($event->isMahasiswaOnly())
                                            <i class="fa-solid fa-graduation-cap"></i> Students Only
                                        @else
                                            <i class="fa-solid fa-users"></i> Public Event
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Text Details -->
                            <div class="px-2">
                                <span class="text-[10px] font-bold tracking-widest text-blue-500 mb-1.5 block uppercase">
                                    {{ $event->category ?? 'Campus Agenda' }}
                                </span>
                                <h3 class="text-[22px] font-bold text-gray-900 leading-[1.2] mb-3 group-hover:text-blue-600 transition-colors line-clamp-2 font-sans tracking-tight">
                                    <a href="{{ route('events.show', $event) }}" class="before:absolute before:inset-0">{{ $event->title }}</a>
                                </h3>

                                <!-- Time Info -->
                                <div class="flex items-center gap-2 text-[13px] font-bold text-blue-600">
                                    <i class="fa-solid fa-circle-play text-[12px]"></i>
                                    <span>
                                        {{ $eventDate ? $eventDate->format('M d') : 'TBA' }}, at {{ $timeToDisplay }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Cut-out Dividers -->
                        <div class="relative h-px bg-transparent z-20">
                            <!-- Background lingkaran menyesuaikan dengan warna background website (hitam) -->
                            <div class="absolute left-0 -top-3 w-6 h-6 bg-black rounded-full -translate-x-1/2"></div>
                            <div class="absolute right-0 -top-3 w-6 h-6 bg-black rounded-full translate-x-1/2"></div>
                            <!-- Dashed Line -->
                            <div class="absolute inset-x-5 top-0 border-t border-dashed border-gray-300"></div>
                        </div>

                        <!-- Bottom Area (Location & Action) -->
                        <div class="p-5 px-6 bg-gray-50 flex items-center justify-between gap-4 relative z-10">
                            <!-- Location Info -->
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="w-10 h-10 rounded-full bg-white border border-gray-200 flex-shrink-0 flex items-center justify-center shadow-sm">
                                     <i class="fa-solid fa-location-dot text-gray-400"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-gray-400 block mb-0.5 uppercase tracking-wider">Location</span>
                                    <span class="text-[13px] font-bold text-gray-900 leading-tight block line-clamp-1">
                                        {{ $event->location ?? 'Huxley Main Campus' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Register Button (Z-index dinaikkan agar bisa diklik di atas link absolut judul) -->
                            <a href="{{ route('events.register', $event) }}" 
                               class="relative z-20 flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-transform shadow-md hover:scale-105 hover:shadow-lg" 
                               title="Register Now">
                                <i class="fa-solid fa-arrow-right -rotate-45"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-gray-900 border border-gray-800 rounded-[24px] p-16 text-center shadow-xl" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-800 text-blue-500 flex items-center justify-center mb-5 border border-gray-700">
                    <i class="fa-regular fa-calendar-xmark text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-bold text-white">No Events Scheduled Yet</h3>
                <p class="text-xs text-gray-400 mt-2 max-w-sm mx-auto">Keep checking the announcements for upcoming event and academic seminar schedules on this page.</p>
            </div>
        @endif
    </main>
</div>
@endsection
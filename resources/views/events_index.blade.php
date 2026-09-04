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
                    <span class="text-[11px] font-bold tracking-[0.28em] text-brand-blue uppercase">Huxley University</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">Events & Activities</h1>
                <p class="max-w-2xl text-gray-400 mt-5 text-sm md:text-base leading-7">
                    Join academic gatherings, workshops, student activities, and university programs designed to connect and inspire the Huxley community.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="flex items-end justify-between gap-6 mb-8" data-aos="fade-up">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Campus Calendar</p>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-white mt-1">Upcoming Opportunities</h2>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 text-xs font-semibold text-gray-400">
                <span class="w-2 h-2 rounded-full bg-brand-blue"></span>
                Open to the Huxley Community
            </span>
        </div>

        @if($events->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($events as $index => $event)
                    @php
                        $imageUrl = filter_var($event->image, FILTER_VALIDATE_URL)
                            ? $event->image
                            : asset('storage/' . $event->image);
                    @endphp

                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                        class="group bg-gray-900 rounded-2xl border border-gray-800 overflow-hidden shadow-lg hover:shadow-brand-blue/10 hover:-translate-y-1.5 transition-all duration-500">
                        <a href="{{ route('events.show', $event) }}" class="block">
                            <div class="relative h-56 bg-gray-800 overflow-hidden">
                                @if($event->image)
                                    <img src="{{ $imageUrl }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                        <i class="fa-regular fa-calendar text-4xl text-gray-600"></i>
                                    </div>
                                @endif

                                <div class="absolute top-5 left-5">
                                    @if($event->type === 'student')
                                        <span class="px-3 py-1.5 rounded-full bg-black/80 backdrop-blur text-brand-blue text-[10px] font-bold uppercase tracking-wider border border-white/10">Students</span>
                                    @else
                                        <span class="px-3 py-1.5 rounded-full bg-brand-blue text-white text-[10px] font-bold uppercase tracking-wider">Public</span>
                                    @endif
                                </div>
                            </div>
                        </a>

                        <div class="p-6">
                            <div class="flex items-center gap-2 text-[11px] text-brand-blue font-bold uppercase tracking-wider mb-3">
                                <i class="fa-regular fa-calendar"></i>
                                @if($event->date)
                                    {{ $event->date->format('d F Y') }}
                                @else
                                    Date TBA
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-white leading-snug mb-3 group-hover:text-brand-blue transition">
                                <a href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
                            </h2>

                            @if($event->description)
                                <p class="text-sm text-gray-400 leading-6 line-clamp-3 mb-5">{{ $event->description }}</p>
                            @endif

                            <div class="space-y-2 text-xs text-gray-400 mb-6">
                                @if($event->time)
                                    <div class="flex items-center gap-2">
                                        <i class="fa-regular fa-clock text-brand-blue w-4"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB</span>
                                    </div>
                                @endif
                                @if($event->location)
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-location-dot text-brand-blue w-4"></i>
                                        <span class="line-clamp-1">{{ $event->location }}</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('events.show', $event) }}"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-black border border-gray-700 text-white py-3 text-xs font-bold tracking-wider hover:bg-brand-blue hover:border-brand-blue transition">
                                VIEW EVENT
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-gray-800 rounded-3xl p-14 text-center shadow-lg" data-aos="fade-up">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-800 text-brand-blue flex items-center justify-center mb-5">
                    <i class="fa-regular fa-calendar text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-black">No Upcoming Events</h2>
                <p class="text-sm text-gray-400 mt-2">There are currently no events available. Please check back soon.</p>
            </div>
        @endif
    </main>
</div>
@endsection
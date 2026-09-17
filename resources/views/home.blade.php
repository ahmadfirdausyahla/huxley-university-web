@extends('layouts.app')

@section('content')

<section id="home"
    class="relative w-full h-[85vh] min-h-[650px] bg-cover bg-center flex flex-col justify-center items-center text-center pt-36 pb-20"
    style="background-image: linear-gradient(rgba(0,0,0,0.58), rgba(0,0,0,0.86)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070');">
    <div data-aos="zoom-in" class="relative z-10 w-full max-w-4xl mx-auto px-6 flex flex-col items-center text-center">
        <div class="relative flex items-center justify-center mb-8">
            <span class="absolute w-28 h-28 md:w-36 md:h-36 rounded-full border border-brand-blue/30 animate-[ping_2.5s_ease-out_infinite]"></span>
            <span class="absolute w-24 h-24 md:w-32 md:h-32 rounded-full bg-brand-blue/10 blur-xl animate-pulse"></span>
            <div class="relative w-20 h-20 md:w-28 md:h-28 rounded-full flex items-center justify-center animate-[heroPulse_2.5s_ease-in-out_infinite]">
                <img src="{{ asset('storage/assets/logo.png') }}" alt="Huxley University Crest"
                    class="w-full h-full object-contain drop-shadow-[0_0_25px_rgba(59,130,246,0.45)]">
            </div>
        </div>

        <p class="text-[10px] md:text-xs tracking-[0.4em] uppercase mb-3 font-bold text-gray-300 text-center">
            Welcome To The Best Tech Institut
        </p>

        <h1 class="text-5xl md:text-7xl font-serif font-normal tracking-wide text-white text-center">
            Huxley University
        </h1>

        <div class="mt-7 h-8 flex items-center justify-center">
            <p id="hero-typing" class="text-xs md:text-sm tracking-[0.3em] text-gray-300 font-semibold uppercase text-center"></p>
            <span id="hero-cursor" class="ml-1 h-4 w-px bg-white animate-pulse"></span>
        </div>
    </div>
</section>

<style>
@keyframes heroPulse {
    0%, 100% { transform: scale(1); filter: drop-shadow(0 0 8px rgba(59,130,246,0.15)); }
    50% { transform: scale(1.07); filter: drop-shadow(0 0 22px rgba(59,130,246,0.55)); }
}
</style>

<section id="features" class="relative z-20 -mt-16 px-6">
    @php
        $features = [
            [
                'icon' => 'fa-solid fa-graduation-cap',
                'title' => 'ADMISSIONS',
                'desc' => 'Explore opportunities to join Huxley University and begin your academic journey.',
                'url' => url('/pendaftaran'),
            ],
            [
                'icon' => 'fa-solid fa-building-columns',
                'title' => 'CAMPUS LIFE',
                'desc' => 'Discover our learning environment, facilities, student community, and campus experience.',
                'url' => '#about',
            ],
            [
                'icon' => 'fa-solid fa-book-open',
                'title' => 'ACADEMIC PROGRAMS',
                'desc' => 'Explore programs designed to develop knowledge, skills, character, and future leaders.',
                'url' => Route::has('programs.index') ? route('programs.index') : '#about',
            ],
        ];
    @endphp

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($features as $index => $feature)
                <a href="{{ $feature['url'] }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 100 }}"
                    class="group relative bg-white rounded-2xl p-7 border border-gray-100 shadow-[0_15px_50px_rgba(0,0,0,0.15)] hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(0,0,0,0.22)] transition-all duration-500 overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-brand-blue/5 group-hover:bg-brand-blue/10 transition duration-500"></div>

                    <div class="relative z-10 flex items-start gap-5">
                        <div class="w-14 h-14 shrink-0 rounded-xl bg-black text-white flex items-center justify-center text-lg group-hover:bg-brand-blue group-hover:scale-105 transition-all duration-300">
                            <i class="{{ $feature['icon'] }}"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-sm font-bold tracking-[0.12em] text-gray-900">{{ $feature['title'] }}</h3>
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-gray-400 group-hover:text-brand-blue transition"></i>
                            </div>
                            <p class="text-sm text-gray-500 leading-6">{{ $feature['desc'] }}</p>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 w-0 h-1 bg-brand-blue group-hover:w-full transition-all duration-500"></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section id="about" class="py-32 bg-black">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <span class="text-xs font-bold tracking-[0.2em] text-brand-blue uppercase mb-2 block">
                    Message from the President
                </span>

                <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-6 leading-tight">
                    Knowledge, Character, and Excellence for the Future
                </h2>

                <p class="text-sm text-gray-300 leading-relaxed mb-4">
                    Welcome to Huxley University. We are committed to creating an outstanding educational experience built on academic excellence, integrity, innovation, and meaningful collaboration.
                </p>

                <p class="text-sm text-gray-300 leading-relaxed mb-6">
                    Through dedicated faculty, modern learning spaces, and a supportive academic community, we empower students to grow with confidence and create positive impact in the world.
                </p>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-brand-blue flex items-center justify-center text-white font-bold text-lg">
                        DR
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-white">Dr. Robert Henderson, Ph.D.</h4>
                        <p class="text-xs text-gray-500">President of Huxley University</p>
                    </div>
                </div>
            </div>

            <div data-aos="fade-left" class="relative">
                <div class="w-full h-[480px] rounded-2xl overflow-hidden shadow-xl">
                    <img src="{{ asset('storage/assets/template.jpg') }}" alt="Huxley University Campus"
                        class="w-full h-full object-cover">
                </div>

                <div class="absolute -bottom-6 -left-6 bg-brand-blue text-white p-6 rounded-xl hidden sm:block shadow-xl">
                    <p class="text-2xl font-bold" data-count="25" data-suffix="+">0</p>
                    <p class="text-xs tracking-wider uppercase">Years of Academic Excellence</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="statistics" class="py-20 bg-gray-800">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
        <div data-aos="fade-up">
            <h3 class="text-4xl md:text-5xl font-bold font-serif text-brand-blue mb-2">
                <span class="counter" data-target="12000" data-suffix="+">0</span>
            </h3>
            <p class="text-xs uppercase tracking-widest text-gray-400">Active Students</p>
        </div>

        <div data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-4xl md:text-5xl font-bold font-serif text-brand-blue mb-2">
                <span class="counter" data-target="450" data-suffix="+">0</span>
            </h3>
            <p class="text-xs uppercase tracking-widest text-gray-400">Faculty Members</p>
        </div>

        <div data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-4xl md:text-5xl font-bold font-serif text-brand-blue mb-2">
                <span class="counter" data-target="35" data-suffix="+">0</span>
            </h3>
            <p class="text-xs uppercase tracking-widest text-gray-400">Academic Programs</p>
        </div>

        <div data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-4xl md:text-5xl font-bold font-serif text-brand-blue mb-2">
                <span class="counter" data-target="98" data-suffix="%">0</span>
            </h3>
            <p class="text-xs uppercase tracking-widest text-gray-400">Graduate Employment</p>
        </div>
    </div>
</section>

<section id="news" class="py-24 relative bg-cover bg-center"
    style="background-image: linear-gradient(rgba(15,15,15,0.9), rgba(15,15,15,0.95)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070');">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10" data-aos="fade-up">
            <div>
                <h2 class="text-3xl font-bold flex items-center gap-2 text-white">
                    <span class="w-3 h-3 rounded-full bg-brand-blue inline-block"></span>
                    News.
                </h2>
                <p class="text-xs text-gray-400 mt-2">Latest news, achievements, and updates from Huxley University</p>
            </div>

            <a href="{{ route('news.index') }}"
                class="text-xs font-bold text-brand-blue hover:text-white transition inline-flex items-center gap-2">
                VIEW ALL NEWS <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-[250px]">
            @foreach($news as $index => $item)
                @php
                    $colSpan = $index === 0 ? 'col-span-1 md:col-span-2' : 'col-span-1';
                    $rowSpan = $index === 0 ? 'row-span-1 md:row-span-2' : 'row-span-1';
                @endphp

                <a href="{{ Route::has('news.show') ? route('news.show', $item->id) : url('/berita/' . $item->id) }}"
                    data-aos="fade-up"
                    class="{{ $colSpan }} {{ $rowSpan }} relative rounded-2xl overflow-hidden group cursor-pointer block"
                    aria-label="Read news: {{ $item->title }}">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent p-6 flex flex-col justify-end">
                        <span class="text-[10px] text-gray-300 font-bold tracking-widest mb-2">{{ $item->label ?? 'NEWS' }}</span>
                        <h3 class="text-lg md:text-xl font-bold text-white mb-4 line-clamp-3">{{ $item->title }}</h3>
                        <span class="bg-brand-blue text-white text-xs px-4 py-2 rounded-full font-bold inline-flex items-center gap-2 w-max hover:bg-blue-600 transition">
                            READ NEWS <i class="fa-solid fa-angles-right"></i>
                        </span>
                    </div>
                </a>
            @endforeach


            <div data-aos="fade-up" class="col-span-1 row-span-1 bg-brand-blue rounded-2xl p-6 flex flex-col justify-center relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="text-[10px] text-blue-200 font-bold tracking-widest mb-2 block">ADMISSIONS</span>
                    <h3 class="text-xl font-bold text-white mb-4">Begin Your Journey at Huxley University</h3>
                    <a href="{{ url('/pendaftaran') }}"
                        class="bg-white text-brand-blue text-xs px-4 py-2 rounded-full font-bold inline-flex items-center gap-2 w-max">
                        APPLY NOW <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-white opacity-10 rounded-full group-hover:scale-150 transition duration-500"></div>
            </div>

            <div id="university-calendar" data-aos="fade-up"
                class="col-span-1 row-span-1 bg-gray-100 text-black rounded-2xl p-4 flex flex-col justify-between">
                <div class="flex justify-between items-center mb-2 border-b border-gray-300 pb-2">
                    <button type="button" id="calendar-prev" aria-label="Previous month" class="w-7 h-7 rounded-full hover:bg-gray-200 transition">
                        <i class="fa-solid fa-chevron-left text-xs text-gray-500"></i>
                    </button>
                    <span id="calendar-title" class="text-sm font-bold"></span>
                    <button type="button" id="calendar-next" aria-label="Next month" class="w-7 h-7 rounded-full hover:bg-gray-200 transition">
                        <i class="fa-solid fa-chevron-right text-xs text-gray-500"></i>
                    </button>
                </div>

                <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-bold text-gray-500 mb-1">
                    <div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div><div>S</div>
                </div>

                <div id="calendar-days" class="grid grid-cols-7 gap-1 text-center text-xs"></div>
            </div>
        </div>
    </div>
</section>

<section id="events" class="relative py-28 bg-[#0d1526] overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-[420px] h-[420px] rounded-full bg-brand-blue/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] rounded-full bg-blue-500/5 blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.035]"
            style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 50px 50px;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12" data-aos="fade-up">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-px bg-brand-blue"></span>
                    <span class="text-[11px] font-bold tracking-[0.25em] text-brand-blue uppercase">Campus Agenda</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-white">Upcoming Events</h2>
                <p class="mt-3 text-sm text-gray-400 max-w-lg">
                    Discover academic events, workshops, student activities, and opportunities happening at Huxley University.
                </p>
            </div>

            <a href="{{ route('events.index') }}"
                class="group inline-flex items-center gap-3 text-xs font-bold tracking-wider text-white border border-white/20 rounded-full px-5 py-3 hover:bg-white hover:text-black transition-all duration-300">
                VIEW ALL EVENTS
                <span class="w-6 h-6 rounded-full bg-brand-blue text-white flex items-center justify-center group-hover:bg-black transition">
                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($events as $index => $event)
                <article data-aos="fade-up" data-aos-delay="{{ $index * 100 }}"
                    class="group relative bg-white rounded-2xl overflow-hidden border border-white/10 shadow-xl hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                    <div class="h-1.5 bg-brand-blue"></div>
                    <div class="p-7">
                        <div class="flex items-start justify-between gap-4 mb-7">
                            @if($event->date)
                                <div class="w-16 h-16 rounded-xl bg-blue-50 border border-blue-100 flex flex-col items-center justify-center text-brand-blue">
                                    <span class="text-[10px] font-bold uppercase tracking-wider">{{ $event->date->format('M') }}</span>
                                    <span class="text-2xl font-bold leading-none mt-1">{{ $event->date->format('d') }}</span>
                                </div>
                            @else
                                <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                            @endif

                            <span class="text-[9px] font-bold uppercase tracking-[0.15em] text-brand-blue bg-blue-50 px-3 py-1.5 rounded-full">
                                {{ strtoupper($event->type ?? 'EVENT') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 leading-snug mb-3 group-hover:text-brand-blue transition">
                            {{ $event->title }}
                        </h3>

                        <div class="space-y-2 mb-6">
                            @if($event->time)
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <i class="fa-regular fa-clock text-brand-blue w-4"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB</span>
                                </div>
                            @endif

                            @if($event->location)
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <i class="fa-solid fa-location-dot text-brand-blue w-4"></i>
                                    <span class="line-clamp-1">{{ $event->location }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="pt-5 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-[10px] font-bold tracking-wider uppercase text-gray-400">Upcoming</span>
                            <a href="{{ route('events.show', $event) }}"
                                class="text-xs font-bold text-brand-blue inline-flex items-center gap-2 hover:gap-3 transition-all">
                                VIEW EVENT <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="md:col-span-3 bg-white rounded-3xl p-12 md:p-16 text-center shadow-xl" data-aos="fade-up">
                    <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center text-2xl">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">No Upcoming Events</h3>
                    <p class="text-sm text-gray-500">There are currently no upcoming events. Please check back soon.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const typingElement = document.getElementById('hero-typing');
    const cursorElement = document.getElementById('hero-cursor');
    const phrases = ['Academic Excellence', 'Character & Leadership', 'Your Future Starts Here'];
    let phraseIndex = 0;
    let characterIndex = 0;
    let deleting = false;

    function typePhrase() {
        if (!typingElement) return;
        const currentPhrase = phrases[phraseIndex];

        if (!deleting) {
            typingElement.textContent = currentPhrase.substring(0, characterIndex + 1);
            characterIndex++;

            if (characterIndex === currentPhrase.length) {
                deleting = true;
                setTimeout(typePhrase, 1800);
                return;
            }

            setTimeout(typePhrase, 70);
            return;
        }

        typingElement.textContent = currentPhrase.substring(0, characterIndex - 1);
        characterIndex--;

        if (characterIndex === 0) {
            deleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            setTimeout(typePhrase, 400);
            return;
        }

        setTimeout(typePhrase, 40);
    }

    setTimeout(typePhrase, 700);

    const counters = document.querySelectorAll('.counter, [data-count]');

    function formatNumber(number) {
        return number.toLocaleString('en-US');
    }

    function animateCounter(element) {
        if (element.dataset.counted === 'true') return;

        element.dataset.counted = 'true';
        const target = parseInt(element.dataset.target || element.dataset.count || 0);
        const suffix = element.dataset.suffix || '';
        const duration = 1600;
        const startTime = performance.now();

        function updateCounter(currentTime) {
            const progress = Math.min((currentTime - startTime) / duration, 1);
            const easedProgress = 1 - Math.pow(1 - progress, 3);
            element.textContent = formatNumber(Math.floor(target * easedProgress)) + suffix;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = formatNumber(target) + suffix;
            }
        }

        requestAnimationFrame(updateCounter);
    }

    const counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) animateCounter(entry.target);
        });
    }, { threshold: 0.35 });

    counters.forEach(function (counter) {
        counterObserver.observe(counter);
    });

    const calendarTitle = document.getElementById('calendar-title');
    const calendarDays = document.getElementById('calendar-days');
    const previousButton = document.getElementById('calendar-prev');
    const nextButton = document.getElementById('calendar-next');

    if (calendarTitle && calendarDays && previousButton && nextButton) {
        let calendarDate = new Date();

        function renderCalendar() {
            const year = calendarDate.getFullYear();
            const month = calendarDate.getMonth();
            const firstDay = (new Date(year, month, 1).getDay() + 6) % 7;
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            calendarTitle.textContent = new Intl.DateTimeFormat('en-US', {
                month: 'long',
                year: 'numeric'
            }).format(calendarDate);

            calendarDays.innerHTML = '';

            for (let i = 0; i < firstDay; i++) {
                calendarDays.insertAdjacentHTML('beforeend', '<div></div>');
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const isToday =
                    day === today.getDate() &&
                    month === today.getMonth() &&
                    year === today.getFullYear();

                const cell = document.createElement('div');
                cell.textContent = day;
                cell.className = isToday
                    ? 'bg-brand-blue text-white rounded-full flex items-center justify-center w-6 h-6 mx-auto font-bold'
                    : 'py-0.5 rounded-full hover:bg-gray-200 transition';

                calendarDays.appendChild(cell);
            }
        }

        previousButton.addEventListener('click', function () {
            calendarDate.setMonth(calendarDate.getMonth() - 1);
            renderCalendar();
        });

        nextButton.addEventListener('click', function () {
            calendarDate.setMonth(calendarDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    }
});
</script>

@endsection

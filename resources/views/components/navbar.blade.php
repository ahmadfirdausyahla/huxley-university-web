<nav class="fixed top-0 left-0 w-full z-50 bg-black/95 backdrop-blur-md border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="h-20 flex items-center justify-between">

            {{-- Logo & Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('storage/assets/logo.png') }}" alt="Huxley University"
                    class="w-11 h-11 object-contain transition duration-300 group-hover:scale-105">

                <div class="hidden sm:block leading-none">
                    <span class="block text-sm font-bold text-white">
                        Huxley University
                    </span>
                    <span class="block mt-1 text-[8px] tracking-[0.2em] text-gray-400">
                        STATE COLLEGE
                    </span>
                </div>
            </a>

            {{-- Desktop Navigation (Fungsi Tombol Mengarah ke Setiap Halaman) --}}
            <ul class="hidden lg:flex items-center gap-8 text-[11px] uppercase tracking-[0.15em] font-bold text-gray-300">

                {{-- HOME --}}
                <li>
                    <a href="{{ route('home') }}" class="relative py-7 transition hover:text-brand-blue {{ request()->routeIs('home') ? 'text-brand-blue' : '' }}">
                        Home
                        @if(request()->routeIs('home'))
                            <span class="absolute left-0 right-0 -bottom-[1px] h-0.5 bg-brand-blue"></span>
                        @endif
                    </a>
                </li>

                {{-- EXPLORE DROPDOWN --}}
                <li class="relative group">
                    <button type="button" class="flex items-center gap-2 py-7 transition hover:text-brand-blue {{ request()->is('beasiswa', 'kampus', 'program', 'programs', 'about*') ? 'text-brand-blue' : '' }}">
                        Explore
                        <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>

                    <div class="absolute left-1/2 -translate-x-1/2 top-full invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200">
                        <div class="w-64 mt-1 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden p-2">
                            
                            {{-- Scholarship --}}
                            <a href="{{ url('/beasiswa') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-blue-50 transition group/item">
                                <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700 group-hover/item:bg-brand-blue group-hover/item:text-white transition">
                                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                                </span>
                                <span>
                                    <span class="block text-[11px] font-bold tracking-wider text-gray-900">Scholarship</span>
                                    <span class="block mt-1 text-[10px] normal-case tracking-normal text-gray-400">Financial aid & opportunities</span>
                                </span>
                            </a>

                            {{-- Our Campus --}}
                            <a href="{{ url('/kampus') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-blue-50 transition group/item">
                                <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700 group-hover/item:bg-brand-blue group-hover/item:text-white transition">
                                    <i class="fa-solid fa-building-columns text-sm"></i>
                                </span>
                                <span>
                                    <span class="block text-[11px] font-bold tracking-wider text-gray-900">Our Campus</span>
                                    <span class="block mt-1 text-[10px] normal-case tracking-normal text-gray-400">Campus & university life</span>
                                </span>
                            </a>

                            {{-- Academic Programs --}}
                            <a href="{{ route('programs.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-blue-50 transition group/item">
                                <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700 group-hover/item:bg-brand-blue group-hover/item:text-white transition">
                                    <i class="fa-solid fa-book-open text-sm"></i>
                                </span>
                                <span>
                                    <span class="block text-[11px] font-bold tracking-wider text-gray-900">Academic Programs</span>
                                    <span class="block mt-1 text-[10px] normal-case tracking-normal text-gray-400">Explore our study programs</span>
                                </span>
                            </a>

                            {{-- Vision & Mission --}}
                            <a href="{{ url('/about') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-blue-50 transition group/item">
                                <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700 group-hover/item:bg-brand-blue group-hover/item:text-white transition">
                                    <i class="fa-solid fa-compass text-sm"></i>
                                </span>
                                <span>
                                    <span class="block text-[11px] font-bold tracking-wider text-gray-900">Vision & Mission</span>
                                    <span class="block mt-1 text-[10px] normal-case tracking-normal text-gray-400">Our direction & values</span>
                                </span>
                            </a>

                        </div>
                    </div>
                </li>

                {{-- FACILITY --}}
                <li>
                    <a href="{{ route('facility.index') }}" class="relative py-7 transition hover:text-brand-blue {{ request()->routeIs('facility.*') ? 'text-brand-blue' : '' }}">
                        Facility
                        @if(request()->routeIs('facility.*'))
                            <span class="absolute left-0 right-0 -bottom-[1px] h-0.5 bg-brand-blue"></span>
                        @endif
                    </a>
                </li>

                {{-- NEWS --}}
                <li>
                    <a href="{{ route('news.index') }}" class="relative py-7 transition hover:text-brand-blue {{ request()->routeIs('news.*') ? 'text-brand-blue' : '' }}">
                        News
                        @if(request()->routeIs('news.*'))
                            <span class="absolute left-0 right-0 -bottom-[1px] h-0.5 bg-brand-blue"></span>
                        @endif
                    </a>
                </li>

                {{-- EVENTS --}}
                <li>
                    <a href="{{ route('events.index') }}" class="relative py-7 transition hover:text-brand-blue {{ request()->routeIs('events.*') ? 'text-brand-blue' : '' }}">
                        Events
                        @if(request()->routeIs('events.*'))
                            <span class="absolute left-0 right-0 -bottom-[1px] h-0.5 bg-brand-blue"></span>
                        @endif
                    </a>
                </li>

            </ul>

            {{-- Social Media Links --}}
            <div class="hidden md:flex items-center gap-4 text-brand-blue">
                <a href="#" class="hover:text-white hover:-translate-y-1 transition"><i class="fab fa-facebook-f text-sm"></i></a>
                <a href="#" class="hover:text-white hover:-translate-y-1 transition"><i class="fab fa-twitter text-sm"></i></a>
                <a href="#" class="hover:text-white hover:-translate-y-1 transition"><i class="fab fa-instagram text-sm"></i></a>
                <a href="#" class="hover:text-white hover:-translate-y-1 transition"><i class="fab fa-youtube text-sm"></i></a>
            </div>

            {{-- Mobile Menu Button --}}
            <button type="button" id="mobile-menu-button" class="lg:hidden w-10 h-10 rounded-xl border border-white/10 text-white flex items-center justify-center">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

        {{-- Mobile Navigation Dropdown --}}
        <div id="mobile-menu" class="lg:hidden hidden border-t border-white/10 py-5">
            <div class="flex flex-col gap-1">
                <a href="{{ route('home') }}" class="px-4 py-3 rounded-lg text-xs uppercase tracking-widest hover:bg-white/5">Home</a>
                
                <button type="button" id="mobile-explore-button" class="px-4 py-3 rounded-lg text-xs uppercase tracking-widest hover:bg-white/5 flex items-center justify-between">
                    <span>Explore</span>
                    <i class="fa-solid fa-chevron-down text-[9px]"></i>
                </button>

                <div id="mobile-explore" class="hidden pl-4">
                    <a href="{{ url('/beasiswa') }}" class="block px-4 py-2.5 text-[11px] text-gray-400 hover:text-white">Scholarship</a>
                    <a href="{{ url('/kampus') }}" class="block px-4 py-2.5 text-[11px] text-gray-400 hover:text-white">Our Campus</a>
                    <a href="{{ route('programs.index') }}" class="block px-4 py-2.5 text-[11px] text-gray-400 hover:text-white">Academic Programs</a>
                    <a href="{{ url('/about') }}" class="block px-4 py-2.5 text-[11px] text-gray-400 hover:text-white">Vision & Mission</a>
                </div>

                <a href="{{ route('facility.index') }}" class="px-4 py-3 rounded-lg text-xs uppercase tracking-widest hover:bg-white/5">Facility</a>
                <a href="{{ route('news.index') }}" class="px-4 py-3 rounded-lg text-xs uppercase tracking-widest hover:bg-white/5">News</a>
                <a href="{{ route('events.index') }}" class="px-4 py-3 rounded-lg text-xs uppercase tracking-widest hover:bg-white/5">Events</a>
            </div>
        </div>

    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mobileButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const exploreButton = document.getElementById('mobile-explore-button');
    const exploreMenu = document.getElementById('mobile-explore');

    if (mobileButton && mobileMenu) {
        mobileButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (exploreButton && exploreMenu) {
        exploreButton.addEventListener('click', function () {
            exploreMenu.classList.toggle('hidden');
        });
    }
});
</script>
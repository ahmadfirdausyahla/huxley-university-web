<footer class="bg-black border-t border-gray-800 pt-16 pb-8 relative mt-20">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-5 gap-8">
        
        <div class="flex flex-col items-center md:items-start" data-aos="fade-up">
            <img src="{{ asset('storage/assets/logo.png') }}" alt="Huxley University Logo" class="w-16 h-16 mb-4 object-contain">
            <h3 class="text-xl font-serif text-white">Huxley University</h3>
            <p class="text-xs text-gray-500 mt-2 text-center md:text-left">THE CHARACTER OF SUCCESS</p>
            <div class="flex gap-3 mt-4 text-brand-blue">
                <a href="#" class="hover:text-white transition"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="100">
            <h4 class="font-bold text-white mb-4">Quick Links</h4>
            <ul class="text-sm text-gray-400 space-y-2">
                <li><a href="{{ route('home') }}" class="hover:text-brand-blue transition">Home</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-brand-blue transition">News</a></li>
                <li><a href="{{ route('events.index') }}" class="hover:text-brand-blue transition">Events</a></li>
                <li><a href="{{ route('facility.index') }}" class="hover:text-brand-blue transition">Facility</a></li>
            </ul>
        </div>

        <div data-aos="fade-up" data-aos-delay="200">
            <h4 class="font-bold text-white mb-4">Explore</h4>
            <ul class="text-sm text-gray-400 space-y-2">
                <li><a href="{{ route('programs.index') }}" class="hover:text-brand-blue transition">Programs</a></li>
                <li><a href="{{ url('/kampus') }}" class="hover:text-brand-blue transition">Campus Life</a></li>
                <li><a href="{{ url('/beasiswa') }}" class="hover:text-brand-blue transition">Scholarship</a></li>
            </ul>
        </div>

        <div data-aos="fade-up" data-aos-delay="300">
            <h4 class="font-bold text-white mb-4">About</h4>
            <ul class="text-sm text-gray-400 space-y-2">
                <li><a href="{{ url('/about') }}" class="hover:text-brand-blue transition">Vision & Mission</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-brand-blue transition">Press Release</a></li>
            </ul>
        </div>

        <div data-aos="fade-up" data-aos-delay="400">
            <h4 class="font-bold text-white mb-4">Contact</h4>
            <p class="text-sm text-gray-400 leading-relaxed">
                State College, Huxley University Campus. Dedicated to academic excellence, innovation, and character building.
            </p>
        </div>

    </div>

    <div class="text-center text-xs text-gray-600 mt-16">
        &copy; {{ date('Y') }} Huxley University. All rights reserved.
    </div>
</footer>
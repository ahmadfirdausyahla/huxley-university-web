@extends('layouts.app')

@section('title', 'Registration - ' . $event->title)

@section('content')

<!-- Background diubah ke slate-900 (Dark Navy/Grey) -->
<section class="relative pt-28 pb-24 min-h-screen overflow-hidden bg-slate-900 text-slate-800">
    <!-- Hiasan blur disesuaikan dengan tema gelap agar lebih menyatu -->
    <div class="absolute top-20 right-0 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>
    <div class="absolute bottom-0 left-[-10%] w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6">

        <!-- Tombol Back disesuaikan agar terbaca di bg gelap -->
        <a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition bg-white/10 px-4 py-2 rounded-full backdrop-blur-md border border-white/20 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Back to Event
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mt-8">

            {{-- Event Summary Sidebar --}}
            <div class="lg:col-span-2">
                <!-- Card Sidebar Putih -->
                <div class="bg-white border-0 rounded-3xl overflow-hidden shadow-2xl shadow-black/30">
                    <div class="relative aspect-video">
                        <img src="{{ filter_var($event->image_url, FILTER_VALIDATE_URL) ? $event->image_url : asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>
                    
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 bg-blue-50 border border-blue-100 text-[10px] font-bold text-blue-600 uppercase tracking-wider rounded-full shadow-sm">
                            For Public
                        </span>

                        <h1 class="text-2xl font-extrabold text-gray-900 mt-4 leading-tight">
                            {{ $event->title }}
                        </h1>

                        <div class="mt-5 space-y-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <p class="text-xs text-gray-600 flex items-center gap-3">
                                <span class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-blue-500 shadow-sm"><i class="fa-solid fa-calendar"></i></span>
                                <span class="font-semibold">{{ $event->event_date->format('d F Y') }}</span>
                            </p>
                            <p class="text-xs text-gray-600 flex items-center gap-3">
                                <span class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-indigo-500 shadow-sm"><i class="fa-solid fa-location-dot"></i></span>
                                <span class="font-semibold">{{ $event->location }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Registration Form --}}
            <div class="lg:col-span-3">
                <!-- Card Form Putih -->
                <div class="bg-white border-0 rounded-3xl p-7 md:p-10 shadow-2xl shadow-black/30">

                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm shadow-md shadow-blue-500/30">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </span>
                        <span class="text-[10px] font-bold tracking-widest text-blue-600 uppercase">
                            Public Registration
                        </span>
                    </div>

                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">
                        Participant Data
                    </h2>

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 rounded-2xl p-5 text-xs shadow-sm">
                            <p class="font-bold mb-2 flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> Failed to submit registration:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.register.public.store', $event) }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Budi Santoso" required
                                class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Active Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Example: budi@gmail.com" required
                                class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                WhatsApp / Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Example: 081234567890" required
                                class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Asal Institusi / Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="institution" value="{{ old('institution') }}" placeholder="Sekolah / Universitas / Instansi / Umum" required
                                class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Additional Notes (Optional)
                            </label>
                            <textarea name="notes" rows="3" placeholder="Write a message or additional note..."
                                class="w-full bg-slate-50 border border-gray-200 rounded-2xl p-5 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none resize-none transition-all">{{ old('notes') }}</textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-4 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                Send Registration
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection
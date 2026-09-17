@extends('layouts.app')

@section('title', 'Pendaftaran - ' . $event->title)

@section('content')

<section class="pt-32 pb-24 bg-gray-50 min-h-screen">

    <div class="max-w-5xl mx-auto px-6">

        <a
            href="{{ route('events.show', $event) }}"
            class="text-xs text-gray-500 hover:text-brand-blue"
        >
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali ke event
        </a>


        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mt-8">


            {{-- event --}}

            <div class="lg:col-span-2">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <img
                        src="{{ $event->image_url }}"
                        alt="{{ $event->title }}"
                        class="w-full h-52 object-cover"
                    >

                    <div class="p-6">

                        <span class="text-[10px] font-bold text-brand-blue uppercase">
                            Untuk Umum
                        </span>

                        <h1 class="text-2xl font-serif font-bold text-gray-900 mt-2">
                            {{ $event->title }}
                        </h1>

                        <p class="text-xs text-gray-500 mt-4">
                            {{ $event->event_date->format('d F Y') }}
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fa-solid fa-location-dot text-brand-blue mr-2"></i>
                            {{ $event->location }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- form --}}

            <div class="lg:col-span-3">

                <div class="bg-white border border-gray-200 rounded-2xl p-7 md:p-9">

                    <span class="text-[10px] font-bold tracking-wider text-brand-blue uppercase">
                        Pendaftaran Peserta Umum
                    </span>

                    <h2 class="text-2xl font-bold text-gray-900 mt-2">
                        Data Peserta
                    </h2>

                    @if($errors->any())
                        <div class="mt-5 bg-red-50 border border-red-200 text-red-600 rounded-xl p-4 text-xs">
                            <p class="font-bold mb-1">Gagal mengirim pendaftaran:</p>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form
                        action="{{ route('events.register.public.store', $event) }}"
                        method="POST"
                        class="mt-8 space-y-5"
                    >

                        @csrf


                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Budi Santoso"
                                class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:border-brand-blue focus:ring-4 focus:ring-blue-50 outline-none transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Email Aktif <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Contoh: budi@gmail.com"
                                class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:border-brand-blue focus:ring-4 focus:ring-blue-50 outline-none transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Contoh: 081234567890"
                                class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:border-brand-blue focus:ring-4 focus:ring-blue-50 outline-none transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Asal Institusi / Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="institution"
                                value="{{ old('institution') }}"
                                placeholder="Sekolah / Universitas / Instansi / Umum"
                                class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:border-brand-blue focus:ring-4 focus:ring-blue-50 outline-none transition"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Catatan Tambahan (Opsional)
                            </label>
                            <textarea
                                name="notes"
                                rows="3"
                                placeholder="Tuliskan pesan atau catatan tambahan..."
                                class="w-full bg-white border border-gray-300 rounded-xl p-4 text-sm text-gray-900 font-medium placeholder:text-gray-400 focus:border-brand-blue focus:ring-4 focus:ring-blue-50 outline-none resize-none transition"
                            >{{ old('notes') }}</textarea>
                        </div>


                        <button
                            type="submit"
                            class="w-full bg-brand-blue text-white py-4 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-blue-600 transition"
                        >
                            Kirim Pendaftaran
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
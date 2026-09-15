@extends('layouts.app')

@section('title', 'Pendaftaran Mahasiswa - ' . $event->title)

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


            <div class="lg:col-span-2">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <img
                        src="{{ $event->image_url }}"
                        alt="{{ $event->title }}"
                        class="w-full h-52 object-cover"
                    >

                    <div class="p-6">

                        <span class="text-[10px] font-bold text-brand-blue uppercase">
                            Khusus Mahasiswa
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


            <div class="lg:col-span-3">

                <div class="bg-white border border-gray-200 rounded-2xl p-7 md:p-9">

                    <span class="text-[10px] font-bold tracking-wider text-brand-blue uppercase">
                        Pendaftaran Mahasiswa
                    </span>

                    <h2 class="text-2xl font-bold text-gray-900 mt-2">
                        Data Mahasiswa
                    </h2>

                    <p class="text-xs text-gray-500 mt-2">
                        Gunakan data akademik yang terdaftar di universitas.
                    </p>


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
                        action="{{ route('events.register.student.store', $event) }}"
                        method="POST"
                        class="mt-8 space-y-5"
                    >

                        @csrf


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50"
                                required
                            >
                        </div>


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                NIM
                            </label>

                            <input
                                type="text"
                                name="nim"
                                value="{{ old('nim') }}"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50"
                                required
                            >
                        </div>


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                Email Kampus
                            </label>

                            <input
                                type="email"
                                name="campus_email"
                                value="{{ old('campus_email') }}"
                                placeholder="nama@kampus.ac.id"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50"
                                required
                            >
                        </div>


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                Program Studi
                            </label>

                            <input
                                type="text"
                                name="study_program"
                                value="{{ old('study_program') }}"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50"
                                required
                            >
                        </div>


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                Fakultas
                            </label>

                            <input
                                type="text"
                                name="faculty"
                                value="{{ old('faculty') }}"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50"
                                required
                            >
                        </div>


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                Nomor WhatsApp
                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50"
                                required
                            >
                        </div>


                        <div>
                            <label class="text-xs font-bold text-gray-700">
                                Catatan
                            </label>

                            <textarea
                                name="notes"
                                rows="4"
                                class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 resize-none"
                            >{{ old('notes') }}</textarea>
                        </div>


                        <button
                            type="submit"
                            class="w-full bg-gray-900 text-white py-4 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-brand-blue transition"
                        >
                            Daftar Sebagai Mahasiswa
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
@extends('layouts.app')

@section('title', 'Pendaftaran Mahasiswa - ' . $event->title)

@section('content')

<section class="pt-32 pb-24 bg-gray-50 min-h-screen text-slate-800">

    <div class="max-w-5xl mx-auto px-6">

        <a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-brand-blue transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Event
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mt-8">

            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-52 object-cover">

                    <div class="p-6">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-brand-blue uppercase tracking-wider border border-blue-200">
                            Khusus Mahasiswa
                        </span>

                        <h1 class="text-2xl font-serif font-bold text-gray-900 mt-3">
                            {{ $event->title }}
                        </h1>

                        <div class="mt-4 pt-4 border-t border-gray-100 space-y-2 text-xs text-gray-600">
                            <p class="flex items-center gap-2">
                                <i class="fa-regular fa-calendar text-brand-blue w-4"></i>
                                <span>{{ $event->event_date->format('d F Y') }}</span>
                            </p>
                            @if($event->start_time)
                                <p class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-brand-blue w-4"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</span>
                                </p>
                            @endif
                            <p class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-brand-blue w-4"></i>
                                <span>{{ $event->location ?? 'Kampus Huxley' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white border border-gray-200 rounded-2xl p-7 md:p-9 shadow-sm">

                    <span class="text-[10px] font-bold tracking-wider text-brand-blue uppercase">
                        Formulir Registrasi Mahasiswa
                    </span>

                    <h2 class="text-2xl font-bold text-gray-900 mt-1">
                        Lengkapi Data Pendaftar
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Masukkan NIM dan data diri Anda untuk divalidasi ke sistem kemahasiswaan.
                    </p>

                    @if($errors->any())
                        <div class="mt-5 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-xs">
                            <p class="font-bold mb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-exclamation"></i> Gagal mengirim pendaftaran:
                            </p>
                            <ul class="list-disc list-inside space-y-0.5 pl-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.register.student.store', $event) }}" method="POST" class="mt-6 space-y-5">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Nama Lengkap Mahasiswa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Muhammad Rayhan" required
                                   class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                        </div>

                        <!-- NIM -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Nomor Induk Mahasiswa (NIM) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 202610370311001" required
                                   class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                            <p class="text-[11px] text-gray-500 mt-1">Sistem akan memvalidasi apakah NIM terdaftar sebagai mahasiswa aktif.</p>
                        </div>

                        <!-- Email Pendaftar (Bukan email kampus paksaan, tapi email aktif pendaftar) -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Email Aktif Pendaftar <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', old('campus_email')) }}" placeholder="Contoh: pendaftar@gmail.com" required
                                   class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                            <p class="text-[11px] text-gray-500 mt-1">Konfirmasi pendaftaran dan e-tiket akan dikirimkan ke alamat email ini.</p>
                        </div>

                        <!-- Program Studi / Jurusan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Jurusan / Program Studi <span class="text-red-500">*</span>
                            </label>
                            @if(isset($departments) && $departments->count())
                                <select id="study_program_select" name="study_program" required
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                                    <option value="" disabled {{ old('study_program') ? '' : 'selected' }}>Pilih Jurusan / Program Studi Anda</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->name }}" data-faculty="{{ $dept->faculty }}" {{ old('study_program') == $dept->name ? 'selected' : '' }}>
                                            {{ $dept->degree }} {{ $dept->name }} ({{ $dept->faculty }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" name="study_program" value="{{ old('study_program') }}" placeholder="Contoh: Teknik Informatika" required
                                       class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                            @endif
                        </div>

                        <!-- Fakultas -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Fakultas
                            </label>
                            <input type="text" id="faculty_input" name="faculty" value="{{ old('faculty') }}" placeholder="Contoh: Fakultas Ilmu Komputer"
                                   class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required
                                   class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition">
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                                Catatan / Pertanyaan (Opsional)
                            </label>
                            <textarea name="notes" rows="3" placeholder="Tuliskan catatan tambahan jika ada..."
                                      class="w-full bg-white border border-gray-300 rounded-xl p-4 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition resize-none">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 px-6 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md shadow-blue-500/20 flex items-center justify-center gap-2">
                            <span>Kirim Pendaftaran Mahasiswa</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </form>

                </div>
            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const programSelect = document.getElementById('study_program_select');
    const facultyInput = document.getElementById('faculty_input');

    if (programSelect && facultyInput) {
        programSelect.addEventListener('change', function () {
            const selectedOption = programSelect.options[programSelect.selectedIndex];
            const faculty = selectedOption.getAttribute('data-faculty');
            if (faculty) {
                facultyInput.value = faculty;
            }
        });
    }
});
</script>

@endsection
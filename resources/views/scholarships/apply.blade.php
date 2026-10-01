@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-20">
    <!-- Header Section -->
    <section class="relative overflow-hidden bg-gray-900 border-b border-gray-800">
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-brand-blue/15 blur-3xl"></div>
        <div class="absolute -bottom-28 -left-20 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-16 md:py-20">
            <div data-aos="fade-up">
                <a href="{{ route('scholarships.index') }}" 
                   class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-brand-blue uppercase tracking-widest transition mb-6">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Beasiswa
                </a>

                <div class="flex flex-wrap items-center gap-2.5 mb-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $scholarship->coverage_type === 'full' ? 'bg-emerald-600/90 text-white' : 'bg-brand-blue text-white' }} shadow-md">
                        {{ $scholarship->coverage_type_label }}
                    </span>
                    @if($scholarship->deadline)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-semibold bg-gray-800 text-amber-300 border border-amber-500/30">
                            <i class="fa-regular fa-clock text-[9px]"></i>
                            Batas Akhir: {{ $scholarship->deadline->format('d M Y') }}
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-5xl font-serif font-bold text-white leading-tight">
                    Formulir Pengajuan Beasiswa
                </h1>
                <p class="text-lg text-blue-400 font-serif mt-2 font-medium">
                    {{ $scholarship->title }}
                </p>
                <p class="text-xs text-gray-400 mt-2">
                    Diselenggarakan oleh {{ $scholarship->provider ?: 'Huxley University Endowment Fund' }}. Lengkapi data di bawah ini secara jujur dan akurat.
                </p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <main class="max-w-4xl mx-auto px-6 mt-12">
        <div class="bg-gray-900/90 border border-gray-800 rounded-3xl p-6 sm:p-10 shadow-2xl backdrop-blur-xl">
            
            @if ($errors->any())
                <div class="bg-red-950/50 border border-red-800 text-red-300 p-4 rounded-2xl mb-8 text-xs">
                    <div class="font-bold flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-triangle-exclamation text-red-400"></i> Mohon periksa kembali formulir Anda:
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('scholarships.apply.store', $scholarship) }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section 1: Profil & Identitas -->
                <div>
                    <div class="flex items-center gap-3 pb-3 border-b border-gray-800 mb-6">
                        <span class="w-7 h-7 rounded-xl bg-brand-blue/20 text-brand-blue font-bold flex items-center justify-center text-xs border border-brand-blue/30">
                            1
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider">Identitas & Status Pemohon</h3>
                            <p class="text-[11px] text-gray-400">Pilih status akademik Anda saat ini</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                        <label class="cursor-pointer border border-gray-800 rounded-2xl p-4 bg-gray-950 hover:border-brand-blue transition flex flex-col justify-between has-[:checked]:border-brand-blue has-[:checked]:bg-blue-950/30">
                            <input type="radio" name="applicant_type" value="student" class="sr-only" {{ old('applicant_type', 'student') === 'student' ? 'checked' : '' }}>
                            <div class="flex items-center justify-between mb-2">
                                <i class="fa-solid fa-graduation-cap text-brand-blue text-lg"></i>
                                <span class="w-3 h-3 rounded-full border border-gray-700 peer-checked:bg-brand-blue"></span>
                            </div>
                            <span class="text-xs font-bold text-white">Mahasiswa Huxley</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Sudah memiliki NIM aktif</span>
                        </label>

                        <label class="cursor-pointer border border-gray-800 rounded-2xl p-4 bg-gray-950 hover:border-brand-blue transition flex flex-col justify-between has-[:checked]:border-brand-blue has-[:checked]:bg-blue-950/30">
                            <input type="radio" name="applicant_type" value="prospective_student" class="sr-only" {{ old('applicant_type') === 'prospective_student' ? 'checked' : '' }}>
                            <div class="flex items-center justify-between mb-2">
                                <i class="fa-solid fa-user-graduate text-purple-400 text-lg"></i>
                                <span class="w-3 h-3 rounded-full border border-gray-700"></span>
                            </div>
                            <span class="text-xs font-bold text-white">Calon Mahasiswa Baru</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Siswa SMA/SMK/Sederajat</span>
                        </label>

                        <label class="cursor-pointer border border-gray-800 rounded-2xl p-4 bg-gray-950 hover:border-brand-blue transition flex flex-col justify-between has-[:checked]:border-brand-blue has-[:checked]:bg-blue-950/30">
                            <input type="radio" name="applicant_type" value="general" class="sr-only" {{ old('applicant_type') === 'general' ? 'checked' : '' }}>
                            <div class="flex items-center justify-between mb-2">
                                <i class="fa-solid fa-earth-americas text-emerald-400 text-lg"></i>
                                <span class="w-3 h-3 rounded-full border border-gray-700"></span>
                            </div>
                            <span class="text-xs font-bold text-white">Peserta Umum / Riset</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Peneliti / Mitra Kampus</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Nama Lengkap Sesuai KTP / KTM <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Muhammad Arya Pratama"
                                   class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Alamat Email Aktif <span class="text-red-400">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@huxley.ac.id atau email pribadi"
                                   class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Nomor WhatsApp / Telepon <span class="text-red-400">*</span>
                            </label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Contoh: 081234567890"
                                   class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                NIM atau Sekolah / Institusi Asal
                            </label>
                            <input type="text" name="nim" value="{{ old('nim') }}" placeholder="NIM: 202401019 / SMA Negeri 1 ..."
                                   class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Akademik -->
                <div>
                    <div class="flex items-center gap-3 pb-3 border-b border-gray-800 mb-6">
                        <span class="w-7 h-7 rounded-xl bg-brand-blue/20 text-brand-blue font-bold flex items-center justify-center text-xs border border-brand-blue/30">
                            2
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider">Latar Belakang Akademik</h3>
                            <p class="text-[11px] text-gray-400">Informasi program studi dan prestasi yang pernah diraih</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="sm:col-span-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Program Studi / Minat
                            </label>
                            <select name="study_program" class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white focus:border-brand-blue outline-none transition">
                                <option value="">Pilih Program Studi...</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->name }}" {{ old('study_program') == $program->name ? 'selected' : '' }}>
                                        {{ $program->name }} ({{ $program->degree }})
                                    </option>
                                @endforeach
                                <option value="Lainnya / Umum" {{ old('study_program') == 'Lainnya / Umum' ? 'selected' : '' }}>Lainnya / Luar Kampus</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Semester Saat Ini
                            </label>
                            <select name="semester" class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white focus:border-brand-blue outline-none transition">
                                <option value="">Pilih Semester...</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                IPK Terakhir / Rata-rata Rapor
                            </label>
                            <input type="number" step="0.01" min="0" max="4.00" name="gpa" value="{{ old('gpa') }}" placeholder="Contoh: 3.75"
                                   class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                            Prestasi / Pengalaman Organisasi (Opsional)
                        </label>
                        <textarea name="achievements" rows="3" placeholder="Tuliskan juara lomba, kepengurusan himpunan, publikasi ilmiah, atau portofolio relevan..."
                                  class="w-full bg-gray-950 border border-gray-800 rounded-xl p-4 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">{{ old('achievements') }}</textarea>
                    </div>
                </div>

                <!-- Section 3: Surat Motivasi & Berkas -->
                <div>
                    <div class="flex items-center gap-3 pb-3 border-b border-gray-800 mb-6">
                        <span class="w-7 h-7 rounded-xl bg-brand-blue/20 text-brand-blue font-bold flex items-center justify-center text-xs border border-brand-blue/30">
                            3
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider">Surat Motivasi & Tautan Dokumen</h3>
                            <p class="text-[11px] text-gray-400">Jelaskan komitmen akademik dan unggah dokumen pendukung</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Surat Motivasi (Motivation Letter) <span class="text-red-400">*</span>
                            </label>
                            <p class="text-[11px] text-gray-500 mb-2">
                                Ceritakan alasan Anda mengajukan beasiswa ini, rencana karir, serta kontribusi yang akan Anda berikan bagi komunitas kampus Huxley.
                            </p>
                            <textarea name="motivation_letter" rows="6" required minlength="50" placeholder="Tuliskan surat motivasi Anda di sini (minimal 50 karakter)..."
                                      class="w-full bg-gray-950 border border-gray-800 rounded-xl p-4 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition leading-relaxed">{{ old('motivation_letter') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-300 mb-2">
                                Tautan Dokumen / Portofolio (Google Drive / Dropbox)
                            </label>
                            <p class="text-[11px] text-gray-500 mb-2">
                                Pastikan tautan diatur dengan izin akses publik atau <em>"Anyone with the link can view"</em> (gabungkan scan KTP/KTM, Transkrip Nilai, & Sertifikat).
                            </p>
                            <div class="relative">
                                <i class="fa-solid fa-link absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                                <input type="url" name="document_url" value="{{ old('document_url') }}" placeholder="https://drive.google.com/..."
                                       class="w-full bg-gray-950 border border-gray-800 rounded-xl pl-10 pr-4 py-3 text-xs text-white placeholder-gray-600 focus:border-brand-blue outline-none transition">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submission Agreement & Button -->
                <div class="pt-6 border-t border-gray-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <p class="text-[11px] text-gray-500 max-w-md">
                        <i class="fa-solid fa-shield-halved text-brand-blue mr-1"></i>
                        Data Anda aman dan hanya digunakan untuk keperluan seleksi beasiswa resmi Huxley University.
                    </p>

                    <button type="submit" 
                            class="px-8 py-3.5 bg-brand-blue hover:bg-blue-600 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-500/20 transition flex items-center justify-center gap-2 group">
                        <span>Kirim Pengajuan Beasiswa</span>
                        <i class="fa-solid fa-paper-plane text-[10px] group-hover:translate-x-1 transition"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

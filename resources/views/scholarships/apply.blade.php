@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900 text-white pt-24 pb-20">
    <!-- Header Section with Poster Background -->
    <section class="relative overflow-hidden bg-slate-950 border-b border-slate-800/80">
        
        <!-- Background Image Poster -->
        @if(!empty($scholarship->image_url))
            <div class="absolute inset-0 z-0">
                <img src="{{ $scholarship->image_url }}" alt="{{ $scholarship->title }}"
                     class="w-full h-full object-cover opacity-100 scale-105">
                <!-- Overlay Gradient Gelap Agar Teks Tetap Jelas Terbaca -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-950/80 to-slate-950/70"></div>
                <div class="absolute inset-0 bg-slate-950/30 backdrop-blur-[2px]"></div>
            </div>
        @else
            <!-- Fallback Glow Effect jika tidak ada gambar -->
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-blue-600/10 blur-[100px]"></div>
            <div class="absolute -bottom-28 -left-20 w-80 h-80 rounded-full bg-blue-500/10 blur-[100px]"></div>
        @endif

        <div class="relative z-10 max-w-4xl mx-auto px-6 py-14 md:py-20">
            <div data-aos="fade-up">
                <a href="{{ route('scholarships.index') }}" 
                   class="inline-flex items-center gap-2 text-xs font-semibold text-slate-300 hover:text-white transition bg-slate-900/60 hover:bg-slate-800/80 px-4 py-2 rounded-full backdrop-blur-md border border-white/10 shadow-sm mb-6">
                    <i class="fa-solid fa-arrow-left"></i> Back to Scholarships List
                </a>

                <div class="flex flex-wrap items-center gap-2.5 mb-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $scholarship->coverage_type === 'full' ? 'bg-emerald-600 text-white' : 'bg-blue-600 text-white' }} shadow-sm">
                        {{ $scholarship->coverage_type_label }}
                    </span>
                    @if($scholarship->deadline)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-semibold bg-slate-900/80 backdrop-blur-md text-amber-300 border border-amber-500/30">
                            <i class="fa-regular fa-clock text-[9px]"></i>
                            Deadline: {{ $scholarship->deadline->format('d M Y') }}
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-5xl font-serif font-bold text-white leading-tight drop-shadow-md">
                    Scholarship Application Form
                </h1>
                <p class="text-lg text-blue-400 font-serif mt-2 font-medium">
                    {{ $scholarship->title }}
                </p>
                <p class="text-xs text-slate-300 mt-2 max-w-2xl leading-relaxed">
                    Organized by {{ $scholarship->provider ?: 'Huxley University Endowment Fund' }}. Complete the information below honestly and accurately.
                </p>
            </div>
        </div>
    </section>

    <!-- Clean White Form Section -->
    <main class="max-w-4xl mx-auto px-6 mt-10">
        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-2xl shadow-black/50 border-0 text-slate-800">
            
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl mb-8 text-xs shadow-sm">
                    <div class="font-bold flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-circle-exclamation text-red-600"></i> Please check your form again:
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-red-600">
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
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                        <span class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs border border-slate-200">
                            1
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Applicant Identity & Status</h3>
                            <p class="text-[11px] text-gray-500">Select your current academic status</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                        <label class="cursor-pointer border border-gray-200 rounded-2xl p-4 bg-slate-50 hover:border-blue-500 transition flex flex-col justify-between has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50">
                            <input type="radio" name="applicant_type" value="student" class="sr-only" {{ old('applicant_type', 'student') === 'student' ? 'checked' : '' }}>
                            <div class="flex items-center justify-between mb-2">
                                <i class="fa-solid fa-graduation-cap text-gray-600 text-base"></i>
                                <span class="w-3.5 h-3.5 rounded-full border border-gray-300 peer-checked:bg-blue-600"></span>
                            </div>
                            <span class="text-xs font-bold text-gray-900">Huxley Student</span>
                            <span class="text-[10px] text-gray-500 mt-0.5">Already have an active student ID</span>
                        </label>

                        <label class="cursor-pointer border border-gray-200 rounded-2xl p-4 bg-slate-50 hover:border-blue-500 transition flex flex-col justify-between has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50">
                            <input type="radio" name="applicant_type" value="prospective_student" class="sr-only" {{ old('applicant_type') === 'prospective_student' ? 'checked' : '' }}>
                            <div class="flex items-center justify-between mb-2">
                                <i class="fa-solid fa-user-graduate text-gray-600 text-base"></i>
                                <span class="w-3.5 h-3.5 rounded-full border border-gray-300"></span>
                            </div>
                            <span class="text-xs font-bold text-gray-900">Prospective New Student</span>
                            <span class="text-[10px] text-gray-500 mt-0.5">High School / Vocational Student</span>
                        </label>

                        <label class="cursor-pointer border border-gray-200 rounded-2xl p-4 bg-slate-50 hover:border-blue-500 transition flex flex-col justify-between has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50">
                            <input type="radio" name="applicant_type" value="general" class="sr-only" {{ old('applicant_type') === 'general' ? 'checked' : '' }}>
                            <div class="flex items-center justify-between mb-2">
                                <i class="fa-solid fa-earth-americas text-gray-600 text-base"></i>
                                <span class="w-3.5 h-3.5 rounded-full border border-gray-300"></span>
                            </div>
                            <span class="text-xs font-bold text-gray-900">General Participant / Researcher</span>
                            <span class="text-[10px] text-gray-500 mt-0.5">Researcher / Campus Partner</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                Full Name According to ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Example: Muhammad Arya Pratama"
                                   class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                Active Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@huxley.ac.id or personal email"
                                   class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                WhatsApp / Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Example: 081234567890"
                                   class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                Student ID or School / Institution
                            </label>
                            <input type="text" name="nim" value="{{ old('nim') }}" placeholder="ID: 202401019 / SMA Negeri 1 ..."
                                   class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Akademik -->
                <div>
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                        <span class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs border border-slate-200">
                            2
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Academic Background</h3>
                            <p class="text-[11px] text-gray-500">Study program information and achievements</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="sm:col-span-1">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                Study Program / Interest
                            </label>
                            <select name="study_program" class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all appearance-none">
                                <option value="">Select Study Program...</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->name }}" {{ old('study_program') == $program->name ? 'selected' : '' }}>
                                        {{ $program->name }} ({{ $program->degree }})
                                    </option>
                                @endforeach
                                <option value="Lainnya / Umum" {{ old('study_program') == 'Lainnya / Umum' ? 'selected' : '' }}>Other / Outside Campus</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                Current Semester
                            </label>
                            <select name="semester" class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all appearance-none">
                                <option value="">Select Semester...</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                                Latest GPA / Average Score
                            </label>
                            <input type="number" step="0.01" min="0" max="4.00" name="gpa" value="{{ old('gpa') }}" placeholder="Example: 3.75"
                                   class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-2 pl-1">
                            Achievements / Organization Experience (Optional)
                        </label>
                        <textarea name="achievements" rows="3" placeholder="Write competition awards, organization leadership, scientific publications, or relevant portfolio..."
                                  class="w-full bg-slate-50 border border-gray-200 rounded-2xl p-4 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all resize-none">{{ old('achievements') }}</textarea>
                    </div>
                </div>

                <!-- Section 3: Surat Motivasi & Berkas -->
                <div>
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                        <span class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs border border-slate-200">
                            3
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Motivation Letter & Document Links</h3>
                            <p class="text-[11px] text-gray-500">Explain your academic commitment and upload supporting documents</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-1 pl-1">
                                Motivation Letter <span class="text-red-500">*</span>
                            </label>
                            <p class="text-[11px] text-gray-500 mb-2 pl-1">
                                Tell us why you're applying for this scholarship, your career plans, and what contribution you'll make to the Huxley campus community.
                            </p>
                            <textarea name="motivation_letter" rows="5" required minlength="50" placeholder="Write your motivation letter here (minimum 50 characters)..."
                                      class="w-full bg-slate-50 border border-gray-200 rounded-2xl p-4 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all leading-relaxed resize-none">{{ old('motivation_letter') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-700 mb-1 pl-1">
                                Document / Portfolio Link (Google Drive / Dropbox)
                            </label>
                            <p class="text-[11px] text-gray-500 mb-2 pl-1">
                                Make sure the link has public access or <em>"Anyone with the link can view"</em> (include scans of ID/Student Card, Transcript, & Certificates).
                            </p>
                            <div class="relative">
                                <i class="fa-solid fa-link absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                                <input type="url" name="document_url" value="{{ old('document_url') }}" placeholder="https://drive.google.com/..."
                                       class="w-full bg-slate-50 border border-gray-200 rounded-2xl pl-10 pr-4 py-3 text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submission Agreement & Button -->
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <p class="text-[11px] text-gray-500 max-w-md flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved text-gray-400"></i>
                        <span>Your data is safe and only used for Huxley University's official scholarship selection.</span>
                    </p>

                    <button type="submit" 
                            class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-blue-500/20 transition-all flex items-center justify-center gap-2 group">
                        <span>Submit Scholarship Application</span>
                        <i class="fa-solid fa-paper-plane text-[10px] group-hover:translate-x-1 transition"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
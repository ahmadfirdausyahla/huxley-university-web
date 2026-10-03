@extends('layouts.app')

@section('title', 'Student Registration - ' . $event->title)

@section('content')

<section class="relative pt-32 pb-24 min-h-screen overflow-hidden bg-slate-50 text-slate-800">
    <!-- Premium Background Gradient & Blur -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/60 via-slate-50 to-blue-50/50 -z-20"></div>
    <div class="absolute top-[10%] left-[-5%] w-[500px] h-[500px] bg-indigo-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
    <div class="absolute bottom-[20%] right-[-5%] w-[400px] h-[400px] bg-purple-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6">

        <a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-indigo-600 transition bg-white/60 px-4 py-2 rounded-full backdrop-blur-sm border border-gray-200 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Back to Event
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mt-8">

            <div class="lg:col-span-2">
                <div class="bg-white/80 backdrop-blur-xl border border-white rounded-3xl overflow-hidden shadow-xl shadow-indigo-900/5">
                    <div class="relative">
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-52 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>

                    <div class="p-6">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold bg-indigo-50/80 backdrop-blur-sm border border-indigo-100 text-indigo-600 uppercase tracking-wider shadow-sm">
                            Students Only
                        </span>

                        <h1 class="text-2xl font-serif font-bold text-gray-900 mt-4 leading-tight">
                            {{ $event->title }}
                        </h1>

                        <div class="mt-5 space-y-3 p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                            <p class="text-xs text-gray-600 flex items-center gap-3">
                                <span class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-indigo-500 shadow-sm"><i class="fa-regular fa-calendar"></i></span>
                                <span class="font-semibold">{{ $event->event_date->format('d F Y') }}</span>
                            </p>
                            @if($event->start_time)
                                <p class="text-xs text-gray-600 flex items-center gap-3">
                                    <span class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-indigo-500 shadow-sm"><i class="fa-regular fa-clock"></i></span>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</span>
                                </p>
                            @endif
                            <p class="text-xs text-gray-600 flex items-center gap-3">
                                <span class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-indigo-500 shadow-sm"><i class="fa-solid fa-location-dot"></i></span>
                                <span class="font-semibold">{{ $event->location ?? 'Huxley Campus' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white/90 backdrop-blur-xl border border-white rounded-3xl p-7 md:p-10 shadow-2xl shadow-indigo-900/5">

                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm shadow-md shadow-indigo-500/30">
                            <i class="fa-solid fa-user-graduate"></i>
                        </span>
                        <span class="text-[10px] font-bold tracking-widest text-indigo-600 uppercase">
                            Student Registration Form
                        </span>
                    </div>

                    <h2 class="text-2xl font-extrabold text-gray-900 mt-1">
                        Complete Registrant Information
                    </h2>

                    <p class="text-xs text-gray-500 mt-2 bg-indigo-50/50 p-3 rounded-xl border border-indigo-100/50">
                        Enter your student ID and personal information for validation with the student administration system.
                    </p>

                    @if($errors->any())
                        <div class="mt-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5 text-xs shadow-sm">
                            <p class="font-bold mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation"></i> Failed to submit registration:
                            </p>
                            <ul class="list-disc list-inside space-y-1 pl-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.register.student.store', $event) }}" method="POST" class="mt-8 space-y-5">
                        @csrf

                        <!-- Full Name -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Student Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Muhammad Rayhan" required
                                   class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        </div>

                        <!-- NIM -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Student ID Number (NIM) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Example: 202610370311001" required
                                   class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all">
                            <p class="text-[10px] font-medium text-gray-500 mt-2 pl-2"><i class="fa-solid fa-shield-halved text-indigo-400 mr-1"></i> System will validate if the student ID is active.</p>
                        </div>

                        <!-- Registrant Email -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Active Email Registrant <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', old('campus_email')) }}" placeholder="Example: registrant@gmail.com" required
                                   class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        </div>

                        <!-- Program Studi / Jurusan -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Major / Study Program <span class="text-red-500">*</span>
                            </label>
                            @if(isset($departments) && $departments->count())
                                <select id="study_program_select" name="study_program" required
                                        class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all appearance-none">
                                    <option value="" disabled {{ old('study_program') ? '' : 'selected' }}>Select Your Major / Study Program</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->name }}" data-faculty="{{ $dept->faculty }}" {{ old('study_program') == $dept->name ? 'selected' : '' }}>
                                            {{ $dept->degree }} {{ $dept->name }} ({{ $dept->faculty }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" name="study_program" value="{{ old('study_program') }}" placeholder="Example: Information Technology" required
                                       class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all">
                            @endif
                        </div>

                        <!-- Fakultas -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Fakultas
                            </label>
                            <input type="text" id="faculty_input" name="faculty" value="{{ old('faculty') }}" placeholder="Example: Faculty of Computer Science"
                                   class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        </div>

                        <!-- WhatsApp Number -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                WhatsApp / Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Example: 081234567890" required
                                   class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2 pl-1">
                                Notes / Questions (Optional)
                            </label>
                            <textarea name="notes" rows="3" placeholder="Write additional notes if any..."
                                      class="w-full bg-slate-50/50 border border-gray-200 rounded-2xl p-5 text-sm text-gray-900 placeholder:text-gray-400 font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all resize-none">{{ old('notes') }}</textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white py-4 px-6 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span>Send Student Registration</span>
                                <i class="fa-solid fa-arrow-right text-sm"></i>
                            </button>
                        </div>
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
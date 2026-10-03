@extends('layouts.admin')

@section('title', 'Add Study Program')
@section('page_title', 'ADD NEW STUDY PROGRAM')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900">New Study Program Form</h2>
            <p class="text-xs text-slate-400 mt-1">Complete information for the new study program to be published.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl mb-6 text-xs">
            <div class="font-bold mb-1 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> There were input errors:
            </div>
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Study Program Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Information Technology" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Education Level <span class="text-red-500">*</span></label>
                <select name="degree" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
                    <option value="S1" {{ old('degree') == 'S1' ? 'selected' : '' }}>Bachelor (S1)</option>
                    <option value="D3" {{ old('degree') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                    <option value="S2" {{ old('degree') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                    <option value="S3" {{ old('degree') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Faculty <span class="text-red-500">*</span></label>
                <input type="text" name="faculty" value="{{ old('faculty') }}" placeholder="Example: Faculty of Computer Science" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Accreditation <span class="text-red-500">*</span></label>
                <input type="text" name="accreditation" value="{{ old('accreditation', 'Excellent (BAN-PT)') }}" placeholder="Example: Excellent / Grade A Accreditation" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Normal Study Duration</label>
                <input type="text" name="duration_years" value="{{ old('duration_years', '4 Years (8 Semester)') }}" placeholder="Example: 4 Years (8 Semester)"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Estimated Tuition Cost (UKT)</label>
                <input type="text" name="tuition_fee" value="{{ old('tuition_fee') }}" placeholder="Example: Rp 6,500,000 / semester"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Short Description</label>
            <textarea name="description" rows="4" placeholder="Explain the curriculum, subject focus, and advantages of this study program..."
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Career Prospects & Graduates (Separate with commas)</label>
            <input type="text" name="career_prospects" value="{{ old('career_prospects') }}" placeholder="Software Engineer, Data Scientist, Cloud Architect, AI Specialist"
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Image / Cover Photo of Program</label>
            <input type="file" name="image_file" accept="image/*"
                   class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            <p class="text-[11px] text-slate-400 mt-1">Image format: JPG, PNG, WEBP (Max. 3MB). If left blank, default image will be used.</p>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
            <label for="is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Activate and display on public portal</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.programs.index') }}" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-900 transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-sm">
                Save Study Program
            </button>
        </div>
    </form>
</div>
@endsection

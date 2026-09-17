@extends('layouts.admin')

@section('title', 'Edit Program Studi')
@section('page_title', 'EDIT PROGRAM STUDI')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit {{ $program->name }}</h2>
            <p class="text-xs text-slate-400 mt-1">Perbarui informasi kurikulum, akreditasi, dan biaya program studi.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl mb-6 text-xs">
            <div class="font-bold mb-1 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> Terdapat kesalahan pengisian:
            </div>
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Program Studi <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $program->name) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                <select name="degree" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
                    <option value="S1" {{ old('degree', $program->degree) == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                    <option value="D3" {{ old('degree', $program->degree) == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                    <option value="S2" {{ old('degree', $program->degree) == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                    <option value="S3" {{ old('degree', $program->degree) == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Fakultas <span class="text-red-500">*</span></label>
                <input type="text" name="faculty" value="{{ old('faculty', $program->faculty) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Akreditasi <span class="text-red-500">*</span></label>
                <input type="text" name="accreditation" value="{{ old('accreditation', $program->accreditation) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Masa Studi Normal</label>
                <input type="text" name="duration_years" value="{{ old('duration_years', $program->duration_years) }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Estimasi Biaya Kuliah (UKT)</label>
                <input type="text" name="tuition_fee" value="{{ old('tuition_fee', $program->tuition_fee) }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Deskripsi Singkat</label>
            <textarea name="description" rows="4"
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">{{ old('description', $program->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Prospek Karir & Lulusan (Pisahkan dengan koma)</label>
            <input type="text" name="career_prospects" value="{{ old('career_prospects', $program->career_prospects) }}"
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Foto / Cover Program</label>
            @if($program->image)
                <div class="mb-3 w-40 h-24 rounded-xl overflow-hidden border border-slate-200">
                    <img src="{{ $program->image_url }}" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" name="image_file" accept="image/*"
                   class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah foto cover.</p>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
            <label for="is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Aktifkan dan tampilkan di portal publik</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.programs.index') }}" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-900 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-sm">
                Perbarui Program Studi
            </button>
        </div>
    </form>
</div>
@endsection

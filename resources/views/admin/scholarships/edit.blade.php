@extends('layouts.admin')

@section('title', 'Edit Beasiswa')
@section('page_title', 'EDIT PROGRAM BEASISWA')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit {{ $scholarship->title }}</h2>
            <p class="text-xs text-slate-400 mt-1">Perbarui nominal bantuan, persyaratan, atau batas akhir pendaftaran.</p>
        </div>
        <a href="{{ route('admin.scholarships.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
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

    <form action="{{ route('admin.scholarships.update', $scholarship->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Program Beasiswa <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $scholarship->title) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Jenis Cakupan <span class="text-red-500">*</span></label>
                <select name="coverage_type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
                    <option value="full" {{ old('coverage_type', $scholarship->coverage_type) == 'full' ? 'selected' : '' }}>Beasiswa Penuh (Full)</option>
                    <option value="partial" {{ old('coverage_type', $scholarship->coverage_type) == 'partial' ? 'selected' : '' }}>Sebagian (Partial)</option>
                    <option value="living_allowance" {{ old('coverage_type', $scholarship->coverage_type) == 'living_allowance' ? 'selected' : '' }}>Tunjangan Hidup</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Penyelenggara / Sponsor</label>
                <input type="text" name="provider" value="{{ old('provider', $scholarship->provider) }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nominal / Nilai Manfaat</label>
                <input type="text" name="amount" value="{{ old('amount', $scholarship->amount) }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Batas Akhir Pendaftaran</label>
                <input type="date" name="deadline" value="{{ old('deadline', $scholarship->deadline ? $scholarship->deadline->format('Y-m-d') : '') }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Deskripsi Ringkas Beasiswa</label>
            <textarea name="description" rows="3"
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">{{ old('description', $scholarship->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Persyaratan Pendaftar (Pisahkan baris atau koma)</label>
            <textarea name="requirements" rows="3"
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">{{ old('requirements', $scholarship->requirements) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Tautan Eksternal / Dokumen Panduan</label>
                <input type="url" name="link" value="{{ old('link', $scholarship->link) }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Poster / Brosur Beasiswa</label>
                @if($scholarship->image)
                    <div class="mb-3 w-32 h-20 rounded-xl overflow-hidden border border-slate-200">
                        <img src="{{ $scholarship->image_url }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="image_file" accept="image/*"
                       class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah poster.</p>
            </div>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $scholarship->is_active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
            <label for="is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Buka pendaftaran beasiswa (tampilkan di portal)</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.scholarships.index') }}" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-900 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-sm">
                Perbarui Beasiswa
            </button>
        </div>
    </form>
</div>
@endsection

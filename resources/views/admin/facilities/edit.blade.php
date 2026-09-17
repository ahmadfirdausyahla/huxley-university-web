@extends('layouts.admin')

@section('title', 'Edit Fasilitas')
@section('page_title', 'EDIT FASILITAS KAMPUS')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit {{ $facility->name }}</h2>
            <p class="text-xs text-slate-400 mt-1">Perbarui rincian, lokasi, atau kapasitas sarana kampus.</p>
        </div>
        <a href="{{ route('admin.facilities.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
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

    <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Fasilitas <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $facility->name) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Kategori Fasilitas <span class="text-red-500">*</span></label>
                <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
                    <option value="laboratorium" {{ old('category', $facility->category) == 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                    <option value="perpustakaan" {{ old('category', $facility->category) == 'perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                    <option value="olahraga" {{ old('category', $facility->category) == 'olahraga' ? 'selected' : '' }}>Olahraga & Kebugaran</option>
                    <option value="aula" {{ old('category', $facility->category) == 'aula' ? 'selected' : '' }}>Aula & Auditorium</option>
                    <option value="layanan" {{ old('category', $facility->category) == 'layanan' ? 'selected' : '' }}>Layanan Mahasiswa</option>
                    <option value="umum" {{ old('category', $facility->category) == 'umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Lokasi / Gedung <span class="text-red-500">*</span></label>
                <input type="text" name="location" value="{{ old('location', $facility->location) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Kapasitas (Orang)</label>
                <input type="number" name="capacity" value="{{ old('capacity', $facility->capacity) }}" min="1"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Deskripsi Fasilitas</label>
            <textarea name="description" rows="4"
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">{{ old('description', $facility->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Fitur / Kelengkapan (Pisahkan dengan koma)</label>
            <input type="text" name="features" value="{{ old('features', $facility->features) }}"
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Foto Fasilitas</label>
            @if($facility->image)
                <div class="mb-3 w-40 h-24 rounded-xl overflow-hidden border border-slate-200">
                    <img src="{{ $facility->image_url }}" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" name="image_file" accept="image/*"
                   class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti foto fasilitas.</p>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $facility->is_active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
            <label for="is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Fasilitas aktif dan siap digunakan</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.facilities.index') }}" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-900 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-sm">
                Perbarui Fasilitas
            </button>
        </div>
    </form>
</div>
@endsection

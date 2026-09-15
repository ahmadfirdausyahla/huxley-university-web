@extends('layouts.admin')

@section('title', 'Tambah Event')
@section('page_title', 'BUAT EVENT BARU')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">
    
    <!-- Link Kembali -->
    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-800 transition font-medium">
        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Event
    </a>

    <!-- Form Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-8 shadow-sm">
        
        <h3 class="font-bold text-slate-900 text-sm pb-5 mb-6 border-b border-slate-100">Form Publikasi Event</h3>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
                <p class="font-bold mb-1">Periksa kembali data yang dimasukkan:</p>
                <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul Event -->
            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">JUDUL EVENT *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan judul event..." required 
                       class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
            </div>

            <!-- Target & Kuota -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">KATEGORI EVENT *</label>
                    <select name="category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-800 focus:border-blue-500 outline-none transition">
                        <option value="public" {{ old('category') == 'public' ? 'selected' : '' }}>Umum (Public)</option>
                        <option value="mahasiswa" {{ old('category') == 'mahasiswa' ? 'selected' : '' }}>Khusus Mahasiswa</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">KUOTA PESERTA</label>
                    <input type="number" name="quota" value="{{ old('quota') }}" placeholder="Contoh: 100" 
                           class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>
            </div>

            <!-- Tanggal & Lokasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">TANGGAL EVENT *</label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}" required 
                           class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-800 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">LOKASI PELAKSANAAN *</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Auditorium Gedung Utama" required 
                           class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">DESKRIPSI SINGKAT</label>
                <input type="text" name="description" value="{{ old('description') }}" placeholder="Ringkasan 1-2 kalimat..." 
                       class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
            </div>

            <!-- Drag & Drop Upload Gambar Header -->
            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">GAMBAR HEADER / COVER</label>
                <div class="relative border-2 border-dashed border-blue-200 bg-blue-50/20 hover:bg-blue-50/40 rounded-2xl p-8 text-center transition cursor-pointer group">
                    <input type="file" name="image_file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="w-10 h-10 bg-blue-500/10 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition">
                        <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-800">Klik atau seret gambar ke sini</p>
                    <p class="text-[10px] text-slate-400 mt-1">Format PNG, JPG, WEBP (Maksimal 2MB)</p>
                </div>
            </div>

            <!-- Isi Lengkap Acara (Simulasi Editor Toolbar) -->
            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">ISI DETAIL EVENT LENGKAP</label>
                <div class="border border-slate-200 rounded-xl overflow-hidden focus-within:border-blue-500 transition">
                    <!-- Toolbar UI -->
                    <div class="bg-slate-50 border-b border-slate-200 p-2.5 flex items-center gap-2 text-slate-500 text-xs overflow-x-auto">
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-rotate-left"></i></button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-rotate-right"></i></button>
                        <span class="w-px h-4 bg-slate-300 mx-1"></span>
                        <span class="text-[11px] font-semibold text-slate-600">Paragraph</span>
                        <span class="w-px h-4 bg-slate-300 mx-1"></span>
                        <button type="button" class="p-1 font-bold hover:bg-slate-200 rounded">B</button>
                        <button type="button" class="p-1 italic hover:bg-slate-200 rounded">I</button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-link"></i></button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-regular fa-image"></i></button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-table"></i></button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-quote-right"></i></button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-list-ul"></i></button>
                        <button type="button" class="p-1 hover:bg-slate-200 rounded"><i class="fa-solid fa-list-ol"></i></button>
                    </div>
                    <textarea name="content" rows="6" placeholder="Tuliskan jadwal, narasumber, serta alur pendaftaran secara lengkap..." 
                              class="w-full p-4 text-xs text-slate-900 outline-none resize-none placeholder-slate-400">{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- Checkbox Status -->
            <div class="pt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="registration_open" value="1" checked class="w-4 h-4 text-blue-600 rounded border-slate-300">
                    <span class="text-xs font-semibold text-slate-700">Buka Pendaftaran Langsung Saat Diterbitkan</span>
                </label>
            </div>

            <!-- Action Buttons Right Aligned -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.events.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition shadow-sm">
                    Publikasikan Event
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
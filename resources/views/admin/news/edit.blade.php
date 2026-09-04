@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page_title', 'EDIT BERITA KAMPUS')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">
    
    <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-800 transition font-medium">
        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Berita
    </a>

    <div class="bg-white border border-slate-200/80 rounded-2xl p-8 shadow-sm">
        
        <h3 class="font-bold text-slate-900 text-sm pb-5 mb-6 border-b border-slate-100">Form Edit Berita</h3>

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">JUDUL BERITA *</label>
                <input type="text" name="title" value="{{ old('title', $news->title) }}" placeholder="Masukkan judul artikel..." required 
                       class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">LABEL / BADGE</label>
                    <input type="text" name="label" value="{{ old('label', $news->label) }}" placeholder="Contoh: AKADEMIK" 
                           class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">UKURAN KARTU BERANDA</label>
                    <select name="card_size" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-800 focus:border-blue-500 outline-none transition">
                        <option value="1 Baris (Standar)" {{ old('card_size', $news->card_size) == '1 Baris (Standar)' ? 'selected' : '' }}>1 Baris (Standar)</option>
                        <option value="2 Baris (Unggulan)" {{ old('card_size', $news->card_size) == '2 Baris (Unggulan)' ? 'selected' : '' }}>2 Baris (Unggulan)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">DESKRIPSI SINGKAT</label>
                <input type="text" name="description" value="{{ old('description', $news->description) }}" placeholder="Ringkasan 1-2 kalimat..." 
                       class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-900 focus:border-blue-500 outline-none placeholder-slate-400 transition">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">GAMBAR HEADER / COVER</label>
                
                @if($news->image)
                <div class="mb-3 flex items-center gap-3 p-3 bg-slate-50 border border-slate-200 rounded-xl">
                    <img src="{{ filter_var($news->image, FILTER_VALIDATE_URL) ? $news->image : asset('storage/' . $news->image) }}" class="w-16 h-12 object-cover rounded-lg border border-slate-200">
                    <span class="text-[11px] text-slate-500">Gambar saat ini terpasang. Unggah baru jika ingin mengganti.</span>
                </div>
                @endif

                <div class="relative border-2 border-dashed border-blue-200 bg-blue-50/20 hover:bg-blue-50/40 rounded-2xl p-8 text-center transition cursor-pointer group">
                    <input type="file" name="image_file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="w-10 h-10 bg-blue-500/10 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition">
                        <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-800">Klik atau seret gambar ke sini</p>
                    <p class="text-[10px] text-slate-400 mt-1">Format PNG, JPG, WEBP (Maksimal 2MB)</p>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">ISI BERITA LENGKAP</label>
                <div class="border border-slate-200 rounded-xl overflow-hidden focus-within:border-blue-500 transition">
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
                    <textarea name="content" rows="6" placeholder="Tuliskan berita lengkap..." 
                              class="w-full p-4 text-xs text-slate-900 outline-none resize-none placeholder-slate-400">{{ old('content', $news->content) }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition shadow-sm">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
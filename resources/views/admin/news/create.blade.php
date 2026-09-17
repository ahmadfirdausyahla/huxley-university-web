@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page_title', 'Buat Berita Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <a href="{{ route('admin.news.index') }}" class="text-xs text-slate-500 hover:text-slate-800 transition flex items-center gap-1">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Berita
    </a>

    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <h2 class="text-base font-bold text-slate-900 pb-4 border-b border-slate-200 mb-6">Form Publikasi Berita</h2>

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1.5 uppercase tracking-wider">Judul Berita *</label>
                <input type="text" name="title" placeholder="Masukkan judul artikel..." required 
                       class="w-full bg-white border border-slate-300 rounded-xl p-3 text-xs text-slate-900 focus:border-brand-blue outline-none placeholder-slate-400">
            </div>

            <!-- Grid Label & Laying -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-1.5 uppercase tracking-wider">Label / Badge</label>
                    <input type="text" name="label" placeholder="Contoh: AKADEMIK" 
                           class="w-full bg-white border border-slate-300 rounded-xl p-3 text-xs text-slate-900 focus:border-brand-blue outline-none placeholder-slate-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-1.5 uppercase tracking-wider">Ukuran Kartu Beranda</label>
                    <select name="row_span" class="w-full bg-white border border-slate-300 rounded-xl p-3 text-xs text-slate-900 focus:border-brand-blue outline-none">
                        <option value="row-span-1">1 Baris (Standar)</option>
                        <option value="row-span-1 md:row-span-2">2 Baris (Kartu Utama)</option>
                    </select>
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1.5 uppercase tracking-wider">Deskripsi Singkat</label>
                <input type="text" name="description" placeholder="Ringkasan 1-2 kalimat..." 
                       class="w-full bg-white border border-slate-300 rounded-xl p-3 text-xs text-slate-900 focus:border-brand-blue outline-none placeholder-slate-400">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1.5 uppercase tracking-wider">Gambar Header / Cover</label>
                <div class="border-2 border-dashed border-slate-300 hover:border-brand-blue rounded-xl p-6 text-center bg-slate-50 transition relative" id="upload-box">
                    <input type="file" name="image_file" id="image-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                    <div id="upload-placeholder">
                        <i class="fa-solid fa-cloud-arrow-up text-2xl text-brand-blue mb-1"></i>
                        <p class="text-xs font-bold text-slate-700">Klik atau seret gambar ke sini</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Format PNG, JPG, WEBP (Maksimal 2MB)</p>
                    </div>
                    <img id="image-preview" class="hidden max-h-40 mx-auto rounded-lg object-cover">
                </div>
            </div>

            <!-- Konten Lengkap -->
            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1.5 uppercase tracking-wider">Isi Berita Lengkap</label>
                <textarea id="editor" name="content" rows="6" class="w-full bg-white text-slate-900 p-3 rounded-xl border border-slate-300 focus:border-brand-blue outline-none"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.news.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 text-xs font-bold transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-blue hover:bg-brand-blue-hover text-white text-xs font-bold transition shadow-sm">
                    Publikasikan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });

    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const uploadPlaceholder = document.getElementById('upload-placeholder');

    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
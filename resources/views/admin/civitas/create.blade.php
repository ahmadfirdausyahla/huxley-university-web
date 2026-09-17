@extends('layouts.admin')

@section('title', 'Tambah Data Civitas / Mahasiswa')
@section('page_title', 'TAMBAH DATA CIVITAS & MAHASISWA')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Form Data Civitas Baru</h2>
            <p class="text-xs text-slate-400 mt-1">Daftarkan mahasiswa, dosen, atau tenaga kependidikan ke database kampus.</p>
        </div>
        <a href="{{ route('admin.civitas.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
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

    <form action="{{ route('admin.civitas.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Muhammad Rayhan / Prof. Dr. Aris Subagyo" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
                    <option value="mahasiswa" {{ old('type') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="dosen" {{ old('type') == 'dosen' ? 'selected' : '' }}>Dosen Pengajar</option>
                    <option value="tendik" {{ old('type') == 'tendik' ? 'selected' : '' }}>Tenaga Kependidikan</option>
                    <option value="pimpinan" {{ old('type') == 'pimpinan' ? 'selected' : '' }}>Pimpinan Kampus</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">NIM / NIP / ID Pengenal <span class="text-red-500">*</span></label>
                <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 202610370311001" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
                <p class="text-[11px] text-slate-400 mt-1">Digunakan untuk validasi pendaftaran event khusus mahasiswa.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Peran / Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="role" value="{{ old('role', 'Mahasiswa Aktif') }}" placeholder="Contoh: Mahasiswa Aktif / Kaprodi TI" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Program Studi / Jurusan</label>
                <input type="text" name="department" value="{{ old('department') }}" placeholder="Contoh: Teknik Informatika"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Fakultas</label>
                <input type="text" name="faculty" value="{{ old('faculty') }}" placeholder="Contoh: Fakultas Ilmu Komputer"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Email Kampus / Personal</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="mahasiswa@student.huxley.ac.id"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="081234567890"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Bio / Catatan Khusus</label>
            <textarea name="bio" rows="3" placeholder="Informasi singkat atau riwayat pendidikan..."
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition">{{ old('bio') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Foto Profil (Opsional)</label>
            <input type="file" name="image_file" accept="image/*"
                   class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            <p class="text-[11px] text-slate-400 mt-1">Jika dikosongkan, sistem otomatis membuat avatar inisial nama.</p>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
            <label for="is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Status aktif di universitas</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.civitas.index') }}" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-900 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-sm">
                Simpan Civitas
            </button>
        </div>
    </form>
</div>
@endsection

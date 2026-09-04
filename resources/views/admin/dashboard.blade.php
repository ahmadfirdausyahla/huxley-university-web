@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Overview Sistem Admin')

@section('content')
<div class="space-y-6">

    <!-- Hero Card Banner (Mengikuti Layout Gambar Acuan) -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl">
        <div class="relative z-10 max-w-2xl space-y-3">
            <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-blue-400 bg-blue-500/10 border border-blue-500/20 uppercase">
                PORTAL ADMINISTRATOR
            </span>
            <h2 class="text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white">
                Selamat Datang di Huxley University System
            </h2>
            <p class="text-xs text-slate-300 leading-relaxed font-normal">
                Kelola publikasi berita, pendaftaran acara internal/publik, beasiswa, serta validasi data warga sekolah dari satu tempat secara terstruktur.
            </p>
        </div>
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- 4 Metrics Cards (Real-Time Counter) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Berita -->
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex items-center justify-between hover:border-blue-300 transition">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">TOTAL BERITA</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\News') ? \App\Models\News::count() : 0 }}
                </h3>
                <p class="text-[10px] font-semibold text-blue-600 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-file-lines text-[9px]"></i> Berita terpublikasi
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-lg border border-blue-100">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <!-- Total Events -->
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex items-center justify-between hover:border-amber-300 transition">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">TOTAL EVENTS</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\Event') ? \App\Models\Event::count() : 0 }}
                </h3>
                <p class="text-[10px] font-semibold text-amber-600 mt-1 flex items-center gap-1">
                    <i class="fa-regular fa-calendar-check text-[9px]"></i> Agenda terdaftar
                </p>
            </div>
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-lg border border-amber-100">
                <i class="fa-regular fa-calendar-days"></i>
            </div>
        </div>

        <!-- Program Beasiswa -->
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex items-center justify-between hover:border-emerald-300 transition">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">PROGRAM BEASISWA</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\Scholarship') ? \App\Models\Scholarship::count() : 0 }}
                </h3>
                <p class="text-[10px] font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i> Program aktif
                </p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-lg border border-emerald-100">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <!-- Warga Sekolah -->
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex items-center justify-between hover:border-purple-300 transition">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">WARGA SEKOLAH</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\User') ? \App\Models\User::count() : 0 }}
                </h3>
                <p class="text-[10px] font-semibold text-purple-600 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-users text-[9px]"></i> Akun terverifikasi
                </p>
            </div>
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-lg border border-purple-100">
                <i class="fa-solid fa-address-card"></i>
            </div>
        </div>
    </div>

    <!-- Bottom Layout (Pintasan & Panduan) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pintasan Manajemen Konten (2 Columns) -->
        <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm">
            <h3 class="font-bold text-slate-900 text-sm">Pintasan Manajemen Konten</h3>
            <p class="text-xs text-slate-400 mt-0.5 mb-5">Pilih tindakan cepat untuk memperbarui data portal kampus.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.news.create') }}" 
                   class="bg-slate-900 hover:bg-slate-800 text-white p-4 rounded-2xl flex items-center gap-4 transition group shadow-md">
                    <div class="w-10 h-10 rounded-xl bg-blue-600/30 text-blue-400 flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Buat Berita Baru</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Tambah berita & pengumuman kampus</p>
                    </div>
                </a>

                <a href="{{ route('admin.events.create') }}" 
                   class="bg-slate-900 hover:bg-slate-800 text-white p-4 rounded-2xl flex items-center gap-4 transition group shadow-md">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/30 text-amber-400 flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-regular fa-calendar-plus text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Buat Event Baru</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Atur seminar, workshop, ormawa</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Panduan Pengelolaan -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-slate-900 text-sm mb-2">Panduan Pengelolaan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Pastikan gambar header berita dan event memiliki aspek rasio lanskap (16:9) dengan ukuran maksimal 2MB untuk hasil tampilan optimal.
                </p>
            </div>

            <div class="pt-6 mt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                <span>Huxley System v2.0</span>
                <span class="inline-flex items-center gap-1.5 text-emerald-600 font-bold text-[11px]">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Operational
                </span>
            </div>
        </div>
    </div>

</div>
@endsection
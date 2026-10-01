@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Overview Sistem Admin')

@section('content')
<div class="space-y-6">

    <!-- Hero Banner -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-7 text-white relative overflow-hidden">
        <div class="relative z-10 max-w-2xl space-y-2">
            <span class="inline-block px-2.5 py-1 rounded text-[10px] font-bold tracking-widest text-slate-400 bg-slate-800 border border-slate-700 uppercase">
                PORTAL ADMINISTRATOR
            </span>
            <h2 class="text-2xl font-bold tracking-tight text-white">
                Huxley University — Admin Panel
            </h2>
            <p class="text-xs text-slate-400 leading-relaxed">
                Kelola publikasi berita, pendaftaran acara, beasiswa, serta data warga akademik dari satu tempat secara terstruktur.
            </p>
        </div>
    </div>

    <!-- 4 Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Berita -->
        <div class="bg-white border border-slate-200 p-5 rounded-xl flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Berita</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\News') ? \App\Models\News::count() : 0 }}
                </h3>
                <p class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-file-lines text-[9px]"></i> Berita terpublikasi
                </p>
            </div>
            <div class="w-11 h-11 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center text-base border border-slate-200">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <!-- Total Events -->
        <div class="bg-white border border-slate-200 p-5 rounded-xl flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Events</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\Event') ? \App\Models\Event::count() : 0 }}
                </h3>
                <p class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                    <i class="fa-regular fa-calendar-check text-[9px]"></i> Agenda terdaftar
                </p>
            </div>
            <div class="w-11 h-11 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center text-base border border-slate-200">
                <i class="fa-regular fa-calendar-days"></i>
            </div>
        </div>

        <!-- Program Beasiswa -->
        <div class="bg-white border border-slate-200 p-5 rounded-xl flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Program Beasiswa</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\Scholarship') ? \App\Models\Scholarship::count() : 0 }}
                </h3>
                <p class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i> Program aktif
                </p>
            </div>
            <div class="w-11 h-11 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center text-base border border-slate-200">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <!-- Warga Sekolah -->
        <div class="bg-white border border-slate-200 p-5 rounded-xl flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pengguna Sistem</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ class_exists('App\Models\User') ? \App\Models\User::count() : 0 }}
                </h3>
                <p class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-users text-[9px]"></i> Akun terverifikasi
                </p>
            </div>
            <div class="w-11 h-11 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center text-base border border-slate-200">
                <i class="fa-solid fa-address-card"></i>
            </div>
        </div>
    </div>

    <!-- Bottom Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-6">
            <h3 class="font-bold text-slate-900 text-sm">Pintasan Manajemen Konten</h3>
            <p class="text-xs text-slate-400 mt-0.5 mb-5">Pilih tindakan cepat untuk memperbarui data portal kampus.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <a href="{{ route('admin.news.create') }}"
                   class="bg-slate-900 hover:bg-slate-800 text-white p-4 rounded-xl flex items-center gap-3 transition group">
                    <div class="w-9 h-9 rounded-lg bg-slate-700 text-slate-300 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Buat Berita</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Tambah warta kampus</p>
                    </div>
                </a>

                <a href="{{ route('admin.events.create') }}"
                   class="bg-slate-900 hover:bg-slate-800 text-white p-4 rounded-xl flex items-center gap-3 transition group">
                    <div class="w-9 h-9 rounded-lg bg-slate-700 text-slate-300 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-calendar-plus text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Buat Event</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Atur agenda kegiatan</p>
                    </div>
                </a>

                <!-- Kotak Masuk Event -->
                <a href="{{ route('admin.events.all-registrations') }}"
                   class="bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 p-4 rounded-xl flex items-center gap-3 transition group">
                    <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-inbox text-sm"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <p class="text-xs font-bold text-slate-800">Masuk Event</p>
                            @php $eventRegCount = \App\Models\EventRegistration::count(); @endphp
                            <span class="text-[10px] font-bold bg-slate-200 text-slate-700 px-1.5 py-0.5 rounded">{{ $eventRegCount }}</span>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-0.5">Rekap pendaftar</p>
                    </div>
                </a>

                <!-- Kotak Masuk Beasiswa -->
                <a href="{{ route('admin.scholarships.applications.index') }}"
                   class="bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 p-4 rounded-xl flex items-center gap-3 transition group">
                    <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-envelope-open-text text-sm"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <p class="text-xs font-bold text-slate-800">Masuk Beasiswa</p>
                            @php $schCount = \App\Models\ScholarshipApplication::where('status', 'pending')->count(); @endphp
                            <span class="text-[10px] font-bold bg-slate-200 text-slate-700 px-1.5 py-0.5 rounded">{{ $schCount }}</span>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-0.5">Pengajuan masuk</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-slate-900 text-sm mb-2">Panduan Pengelolaan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Pastikan gambar header berita dan event memiliki aspek rasio lanskap (16:9) dengan ukuran maksimal 2MB untuk hasil tampilan optimal.
                </p>
            </div>
            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                <span>Huxley System v2.0</span>
                <span class="inline-flex items-center gap-1.5 text-slate-500 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Operational
                </span>
            </div>
        </div>
    </div>

</div>
@endsection
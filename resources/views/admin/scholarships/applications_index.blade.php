@extends('layouts.admin')

@section('title', 'Kotak Masuk Beasiswa')
@section('page_title', 'KOTAK MASUK BEASISWA')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Kotak Masuk Pengajuan Beasiswa</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola dan verifikasi seluruh formulir pendaftaran beasiswa dari mahasiswa dan calon mahasiswa.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.scholarships.index') }}" 
               class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
                <i class="fa-solid fa-graduation-cap"></i> Kelola Program Beasiswa
            </a>
        </div>
    </div>

    <!-- Stats Counter Bar -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
        <div class="bg-white border border-slate-200/80 p-4 rounded-xl shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Masuk</p>
            <p class="text-xl font-extrabold text-slate-800 mt-0.5">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-amber-50/60 border border-amber-200 p-4 rounded-xl shadow-sm">
            <p class="text-[10px] font-bold text-amber-700 uppercase tracking-wider flex items-center gap-1">
                <i class="fa-regular fa-clock"></i> Menunggu
            </p>
            <p class="text-xl font-extrabold text-amber-800 mt-0.5">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-blue-50/60 border border-blue-200 p-4 rounded-xl shadow-sm">
            <p class="text-[10px] font-bold text-blue-700 uppercase tracking-wider flex items-center gap-1">
                <i class="fa-solid fa-magnifying-glass"></i> Seleksi
            </p>
            <p class="text-xl font-extrabold text-blue-800 mt-0.5">{{ $stats['under_review'] }}</p>
        </div>
        <div class="bg-emerald-50/60 border border-emerald-200 p-4 rounded-xl shadow-sm">
            <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider flex items-center gap-1">
                <i class="fa-solid fa-circle-check"></i> Diterima
            </p>
            <p class="text-xl font-extrabold text-emerald-800 mt-0.5">{{ $stats['approved'] }}</p>
        </div>
        <div class="bg-rose-50/60 border border-rose-200 p-4 rounded-xl shadow-sm">
            <p class="text-[10px] font-bold text-rose-700 uppercase tracking-wider flex items-center gap-1">
                <i class="fa-solid fa-circle-xmark"></i> Ditolak
            </p>
            <p class="text-xl font-extrabold text-rose-800 mt-0.5">{{ $stats['rejected'] }}</p>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        
        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('admin.scholarships.applications.index') }}" class="flex flex-col lg:flex-row items-center justify-between gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                <div class="relative w-full sm:w-60">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, email, prodi..." 
                           class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>

                <select name="scholarship_id" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition max-w-xs">
                    <option value="">Semua Program Beasiswa</option>
                    @foreach($scholarships as $item)
                        <option value="{{ $item->id }}" {{ request('scholarship_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->title }}
                        </option>
                    @endforeach
                </select>

                <select name="status" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Sedang Diseleksi</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>

                <select name="applicant_type" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition">
                    <option value="">Semua Kategori Pemohon</option>
                    <option value="student" {{ request('applicant_type') == 'student' ? 'selected' : '' }}>Mahasiswa Huxley</option>
                    <option value="prospective_student" {{ request('applicant_type') == 'prospective_student' ? 'selected' : '' }}>Calon Mahasiswa</option>
                    <option value="general" {{ request('applicant_type') == 'general' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
            <div class="text-[11px] font-medium text-slate-400 whitespace-nowrap">
                Total: {{ $applications->total() }} Pengajuan
            </div>
        </form>

        <!-- Table Grid -->
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-4">PEMOHON BEASISWA</th>
                        <th class="py-3.5 px-4">PROGRAM BEASISWA</th>
                        <th class="py-3.5 px-4">STATUS AKADEMIK</th>
                        <th class="py-3.5 px-4">KONTAK</th>
                        <th class="py-3.5 px-4">STATUS SELEKSI</th>
                        <th class="py-3.5 px-4">WAKTU DAFTAR</th>
                        <th class="py-3.5 px-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $app)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-slate-900 text-xs flex items-center gap-1.5">
                                {{ $app->name }}
                                @if($app->applicant_type === 'student')
                                    <span class="inline-block px-1.5 py-0.5 bg-blue-50 text-blue-700 text-[9px] font-bold rounded">Mhs</span>
                                @elseif($app->applicant_type === 'prospective_student')
                                    <span class="inline-block px-1.5 py-0.5 bg-purple-50 text-purple-700 text-[9px] font-bold rounded">Camaba</span>
                                @endif
                            </div>
                            <div class="text-[11px] text-slate-400 font-mono mt-0.5">
                                {{ $app->nim ? 'NIM: ' . $app->nim : ($app->current_institution ?: 'Institusi Asal') }}
                            </div>
                        </td>
                        <td class="py-3.5 px-4 max-w-xs">
                            <div class="font-semibold text-slate-800 line-clamp-1">
                                {{ $app->scholarship->title ?? 'Program Dihapus' }}
                            </div>
                            <span class="text-[10px] text-slate-400">
                                {{ $app->scholarship ? $app->scholarship->provider : '' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="text-slate-800 font-medium">
                                {{ $app->study_program ?: '-' }}
                            </div>
                            <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-0.5">
                                @if($app->semester)
                                    <span>Smt {{ $app->semester }}</span>
                                @endif
                                @if($app->gpa)
                                    <span class="font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">IPK {{ number_format($app->gpa, 2) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="text-slate-700">{{ $app->email }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">
                                <i class="fa-brands fa-whatsapp text-emerald-500 mr-1"></i>{{ $app->phone }}
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $app->status_badge_class }}">
                                @if($app->status === 'pending')
                                    <i class="fa-regular fa-clock text-[9px]"></i>
                                @elseif($app->status === 'under_review')
                                    <i class="fa-solid fa-spinner text-[9px]"></i>
                                @elseif($app->status === 'approved')
                                    <i class="fa-solid fa-check text-[9px]"></i>
                                @elseif($app->status === 'rejected')
                                    <i class="fa-solid fa-xmark text-[9px]"></i>
                                @endif
                                {{ $app->status_label }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-slate-400 text-[11px]">
                            {{ $app->created_at ? $app->created_at->format('d M Y, H:i') : '-' }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('admin.scholarships.applications.show', $app) }}" 
                                   class="px-2.5 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold transition" title="Lihat Berkas & Detail">
                                    <i class="fa-solid fa-eye mr-1 text-[10px]"></i> Detail
                                </a>
                                <form action="{{ route('admin.scholarships.applications.destroy', $app) }}" method="POST" onsubmit="return confirm('Hapus pengajuan dari {{ $app->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 transition" title="Hapus Pengajuan">
                                        <i class="fa-regular fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-16 text-slate-400">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-inbox text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Kotak Masuk Beasiswa Kosong</p>
                            <p class="text-[11px] text-slate-400 mt-1">Belum ada pengajuan pendaftaran beasiswa yang masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Detail Pengajuan Beasiswa - ' . $application->name)
@section('page_title', 'DETAIL PENGAJUAN BEASISWA')

@section('content')
<div class="space-y-6 max-w-5xl">
    <!-- Back Button & Breadcrumbs -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.scholarships.applications.index') }}" 
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Kotak Masuk Beasiswa
        </a>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $application->status_badge_class }}">
                {{ $application->status_label }}
            </span>
        </div>
    </div>

    <!-- Main Grid: Info + Status Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Applicant Dossier (2 cols) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Applicant Header Card -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md">
                            {{ $application->scholarship->title ?? 'Program Beasiswa' }}
                        </span>
                        <h2 class="text-xl font-bold text-slate-900 mt-2">{{ $application->name }}</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Diajukan pada {{ $application->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-lg font-bold">
                        {{ strtoupper(substr($application->name, 0, 2)) }}
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 pt-6 border-t border-slate-100 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Email Pemohon</span>
                        <a href="mailto:{{ $application->email }}" class="text-blue-600 font-semibold hover:underline">{{ $application->email }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nomor WhatsApp / Telp</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $application->phone) }}" target="_blank" class="text-emerald-600 font-semibold hover:underline flex items-center gap-1">
                            <i class="fa-brands fa-whatsapp"></i> {{ $application->phone }}
                        </a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Kategori Pemohon</span>
                        <span class="font-medium text-slate-800">
                            {{ $application->applicant_type === 'student' ? 'Mahasiswa Aktif Huxley' : ($application->applicant_type === 'prospective_student' ? 'Calon Mahasiswa Baru' : 'Masyarakat Umum') }}
                        </span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">NIM / No Identitas</span>
                        <span class="font-mono font-bold text-slate-800">{{ $application->nim ?: ($application->current_institution ?: '-') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Program Studi / Jurusan</span>
                        <span class="font-medium text-slate-800">{{ $application->study_program ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Semester & IPK</span>
                        <span class="font-medium text-slate-800">
                            {{ $application->semester ? 'Semester ' . $application->semester : '-' }}
                            @if($application->gpa)
                                • <strong class="text-emerald-600 font-bold">IPK {{ number_format($application->gpa, 2) }}</strong>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Motivation Letter -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                    <i class="fa-solid fa-feather text-blue-600"></i> Surat Motivasi & Alasan Pengajuan
                </h3>
                <div class="p-4 bg-slate-50 rounded-xl text-slate-700 text-xs leading-relaxed whitespace-pre-line border border-slate-100">
                    {{ $application->motivation_letter }}
                </div>
            </div>

            <!-- Achievements & Document URL -->
            @if($application->achievements)
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                    <i class="fa-solid fa-trophy text-amber-500"></i> Ringkasan Prestasi & Portofolio
                </h3>
                <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line">
                    {{ $application->achievements }}
                </p>
            </div>
            @endif

            <!-- Document / Portfolio Link -->
            @if($application->document_url)
            <div class="bg-blue-50/60 border border-blue-200 rounded-2xl p-5 flex items-center justify-between gap-4">
                <div>
                    <h4 class="text-xs font-bold text-blue-900">Berkas Pendukung / Portofolio Terlampir</h4>
                    <p class="text-[11px] text-blue-700 mt-0.5 line-clamp-1">{{ $application->document_url }}</p>
                </div>
                <a href="{{ $application->document_url }}" target="_blank" 
                   class="shrink-0 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition inline-flex items-center gap-2">
                    <span>Buka Tautan</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>
            @endif

        </div>

        <!-- Right: Status Decision & Action Box (1 col) -->
        <div class="space-y-6">
            
            <!-- Update Status Card -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-blue-600"></i> Keputusan Seleksi
                </h3>

                <form action="{{ route('admin.scholarships.applications.update-status', $application) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Pengajuan</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none transition font-medium">
                            <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>⏳ Menunggu Verifikasi</option>
                            <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>🔍 Sedang Diseleksi / Wawancara</option>
                            <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>✅ Diterima / Lolos Beasiswa</option>
                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>❌ Tidak Lolos</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Catatan Administrator / Dewan Seleksi</label>
                        <textarea name="admin_notes" rows="4" placeholder="Tuliskan catatan internal atau alasan kelolosan..."
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs text-slate-800 focus:border-blue-500 outline-none transition placeholder-slate-400">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md transition">
                        Simpan Perubahan Status
                    </button>
                </form>
            </div>

            <!-- Program Info Card -->
            <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 space-y-3">
                <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-700">Tentang Program</h4>
                <p class="text-xs font-bold text-slate-900">{{ $application->scholarship->title ?? 'Program Beasiswa' }}</p>
                <div class="text-[11px] text-slate-500 space-y-1">
                    <p><i class="fa-solid fa-building-ngo w-4 text-slate-400"></i> Mitra: {{ $application->scholarship->provider ?? '-' }}</p>
                    <p><i class="fa-solid fa-gift w-4 text-slate-400"></i> Cakupan: {{ $application->scholarship->coverage_type_label ?? '-' }}</p>
                    @if($application->scholarship && $application->scholarship->amount)
                        <p><i class="fa-solid fa-coins w-4 text-slate-400"></i> Nilai: {{ $application->scholarship->amount }}</p>
                    @endif
                </div>
            </div>

            <!-- Delete Form -->
            <form action="{{ route('admin.scholarships.applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajuan ini secara permanen?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-2.5 px-4 border border-rose-200 bg-rose-50/50 hover:bg-rose-100 text-rose-700 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2">
                    <i class="fa-regular fa-trash-can"></i> Hapus Berkas Pengajuan
                </button>
            </form>

        </div>
    </div>
</div>
@endsection

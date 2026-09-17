@extends('layouts.admin')

@section('title', 'Semua Pendaftaran Event')
@section('page_title', 'SEMUA PENDAFTARAN EVENT')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Rekap Seluruh Pendaftar Event</h2>
            <p class="text-xs text-slate-400 mt-1">Pantau seluruh pendaftaran mahasiswa dan umum pada seluruh kegiatan Huxley University.</p>
        </div>
        <a href="{{ route('admin.events.index') }}" 
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl transition">
            <i class="fa-regular fa-calendar-check"></i> Kelola Acara
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        
        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('admin.events.all-registrations') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, email..." 
                           class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>

                <select name="event_id" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition max-w-xs">
                    <option value="">Semua Event</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>{{ $ev->title }}</option>
                    @endforeach
                </select>

                <select name="type" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition">
                    <option value="">Semua Peserta</option>
                    <option value="student" {{ request('type') == 'student' ? 'selected' : '' }}>Khusus Mahasiswa</option>
                    <option value="public" {{ request('type') == 'public' ? 'selected' : '' }}>Peserta Umum</option>
                </select>
            </div>
            <span class="text-[11px] font-medium text-slate-400">Total: {{ $registrations->total() }} Pendaftar</span>
        </form>

        <!-- Table Grid -->
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-4">EVENT</th>
                        <th class="py-3.5 px-4">TIPE</th>
                        <th class="py-3.5 px-4">NAMA PESERTA</th>
                        <th class="py-3.5 px-4">IDENTITAS (NIM / INSTANSI)</th>
                        <th class="py-3.5 px-4">KONTAK</th>
                        <th class="py-3.5 px-4">CATATAN</th>
                        <th class="py-3.5 px-4">WAKTU DAFTAR</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4 font-bold text-slate-900 max-w-xs">
                            <a href="{{ route('admin.events.registrations', $reg->event_id) }}" class="hover:text-blue-600 transition line-clamp-1">
                                {{ $reg->event->title ?? '-' }}
                            </a>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($reg->type === 'student')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <i class="fa-solid fa-graduation-cap text-[9px]"></i> Mahasiswa
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <i class="fa-solid fa-user text-[9px]"></i> Umum
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <h4 class="font-bold text-slate-900 text-xs">{{ $reg->name }}</h4>
                            @if($reg->study_program)
                                <p class="text-[10px] text-blue-600 font-medium">{{ $reg->study_program }}</p>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if($reg->type === 'student')
                                <span class="font-mono font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded text-[11px]">
                                    NIM: {{ $reg->nim ?? '-' }}
                                </span>
                            @else
                                <span class="text-slate-700 font-medium">
                                    {{ $reg->institution ?? 'Masyarakat Umum' }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="text-slate-700">{{ $reg->email ?: $reg->campus_email }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">
                                <i class="fa-brands fa-whatsapp text-emerald-500 mr-1"></i>{{ $reg->phone ?? '-' }}
                            </div>
                        </td>
                        <td class="py-3.5 px-4 max-w-xs">
                            <span class="text-slate-500 text-[11px] line-clamp-2">{{ $reg->notes ?: '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-slate-400 text-[11px]">
                            {{ $reg->created_at ? $reg->created_at->format('d M Y, H:i') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-16 text-slate-400">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-regular fa-clipboard text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Belum Ada Pendaftaran Event</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
            <div class="mt-4">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

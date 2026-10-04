@extends('layouts.admin')

@section('title', 'Daftar Pendaftar Event')
@section('page_title', 'DATA PENDAFTARAN EVENT')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.events.index') }}" class="text-xs text-slate-500 hover:text-slate-800 transition inline-flex items-center gap-1.5 mb-2 font-semibold">
                <i class="fa-solid fa-arrow-left"></i> Back to Event List
            </a>
            <div class="flex items-center gap-3">
                <h2 class="text-xl font-bold text-slate-900">{{ $event->title }}</h2>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $event->isMahasiswaOnly() ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800' }}">
                    {{ $event->category_label }}
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1">
                Jadwal: {{ $event->event_date->format('d M Y') }} &bull; Lokasi: {{ $event->location ?? 'Kampus Huxley' }} &bull; Total Kuota: {{ $event->quota ?? 'Unlimited' }}
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="bg-blue-50 border border-blue-100 px-4 py-2 rounded-xl text-center">
                <span class="text-[10px] uppercase font-bold text-blue-600 block">Total Pendaftar</span>
                <span class="text-lg font-extrabold text-blue-900">{{ $registrations->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-4">TIPE</th>
                        <th class="py-3.5 px-4">NAMA PESERTA</th>
                        <th class="py-3.5 px-4">IDENTITAS (NIM / INSTANSI)</th>
                        <th class="py-3.5 px-4">CONTACT</th>
                        <th class="py-3.5 px-4">CATATAN</th>
                        <th class="py-3.5 px-4">WAKTU DAFTAR</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50/60 transition">
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
                                <p class="text-[10px] text-blue-600 font-medium">{{ $reg->study_program }} {{ $reg->faculty ? '• ' . $reg->faculty : '' }}</p>
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
                        <td colspan="6" class="text-center py-16 text-slate-400">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-regular fa-clipboard text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Belum Ada Peserta yang Mendaftar</p>
                            <p class="text-[11px] text-slate-400 mt-1">Registrations coming through the portal will appear here.</p>
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
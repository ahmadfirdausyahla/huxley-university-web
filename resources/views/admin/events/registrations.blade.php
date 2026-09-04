@extends('layouts.admin')

@section('title', 'Daftar Pendaftar')
@section('page_title', 'Data Pendaftar Event')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.events.index') }}" class="text-xs text-slate-500 hover:text-slate-800 transition flex items-center gap-1 mb-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Event
            </a>
            <h2 class="text-lg font-bold text-slate-900">{{ $event->title }}</h2>
            <p class="text-xs text-slate-500">Daftar peserta yang mendaftar pada acara ini.</p>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-5">Nama Lengkap</th>
                        <th class="py-3.5 px-5">Email</th>
                        <th class="py-3.5 px-5">Nomor Telepon</th>
                        <th class="py-3.5 px-5">Tanggal Mendaftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-3 px-5 font-bold text-slate-800">{{ $reg->name ?? $reg->user->name ?? '-' }}</td>
                        <td class="py-3 px-5 text-slate-600">{{ $reg->email ?? $reg->user->email ?? '-' }}</td>
                        <td class="py-3 px-5 text-slate-600">{{ $reg->phone ?? '-' }}</td>
                        <td class="py-3 px-5 text-slate-400">{{ $reg->created_at ? $reg->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-400">
                            Belum ada peserta yang mendaftar pada event ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
            <div class="p-4 border-t border-slate-200 bg-slate-50">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
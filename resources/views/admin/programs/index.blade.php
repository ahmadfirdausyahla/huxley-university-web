@extends('layouts.admin')

@section('title', 'Daftar Program Studi')
@section('page_title', 'KELOLA PROGRAM AKADEMIK')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Program Studi & Akademik</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola jenjang diploma, sarjana, hingga pascasarjana di Huxley University.</p>
        </div>
        <a href="{{ route('admin.programs.create') }}" 
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Program Studi</span>
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        
        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('admin.programs.index') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program studi atau fakultas..." 
                           class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>
                <select name="degree" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition">
                    <option value="">Semua Jenjang</option>
                    <option value="D3" {{ request('degree') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                    <option value="S1" {{ request('degree') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                    <option value="S2" {{ request('degree') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                    <option value="S3" {{ request('degree') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                </select>
            </div>
            <span class="text-[11px] font-medium text-slate-400">Total: {{ $programs->total() }} Program</span>
        </form>

        <!-- Table Grid -->
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">GAMBAR / ICON</th>
                        <th class="py-3 px-4">PROGRAM STUDI</th>
                        <th class="py-3 px-4">FAKULTAS</th>
                        <th class="py-3 px-4">AKREDITASI</th>
                        <th class="py-3 px-4">BIAYA / SEMESTER</th>
                        <th class="py-3 px-4">STATUS</th>
                        <th class="py-3 px-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($programs as $prog)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3 px-4">
                            <div class="w-14 h-10 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                <img src="{{ $prog->image_url }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase {{ $prog->degree === 'S1' ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'bg-purple-50 text-purple-600 border border-purple-100' }}">
                                    {{ $prog->degree }}
                                </span>
                                <h4 class="font-bold text-slate-800 text-xs">{{ $prog->name }}</h4>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-0.5">{{ $prog->duration_years }}</p>
                        </td>
                        <td class="py-3 px-4 text-slate-600">
                            {{ $prog->faculty }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                <i class="fa-solid fa-certificate text-[9px]"></i> {{ $prog->accreditation }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-700 font-medium">
                            {{ $prog->tuition_fee ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            @if($prog->is_active)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-700">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-slate-100 text-slate-500">Non-aktif</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.programs.edit', $prog->id) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-blue-600 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('admin.programs.destroy', $prog->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus program studi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-red-600 transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-16 text-center text-slate-400">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-book-open text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Belum Ada Program Studi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($programs->hasPages())
        <div class="mt-4">
            {{ $programs->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

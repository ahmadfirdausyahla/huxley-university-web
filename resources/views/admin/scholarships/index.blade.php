@extends('layouts.admin')

@section('title', 'Daftar Beasiswa')
@section('page_title', 'KELOLA PROGRAM BEASISWA')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Daftar Program Beasiswa</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola informasi beasiswa prestasi, bantuan riset, dan pendanaan pendidikan.</p>
        </div>
        <a href="{{ route('admin.scholarships.create') }}" 
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Beasiswa Baru</span>
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        
        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('admin.scholarships.index') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama beasiswa atau penyelenggara..." 
                           class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>
                <select name="coverage_type" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition">
                    <option value="">Semua Cakupan</option>
                    <option value="full" {{ request('coverage_type') == 'full' ? 'selected' : '' }}>Beasiswa Penuh (Full)</option>
                    <option value="partial" {{ request('coverage_type') == 'partial' ? 'selected' : '' }}>Sebagian (Partial)</option>
                    <option value="living_allowance" {{ request('coverage_type') == 'living_allowance' ? 'selected' : '' }}>Tunjangan Hidup</option>
                </select>
            </div>
            <span class="text-[11px] font-medium text-slate-400">Total: {{ $scholarships->total() }} Beasiswa</span>
        </form>

        <!-- Table Grid -->
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">POSTER</th>
                        <th class="py-3 px-4">PROGRAM BEASISWA</th>
                        <th class="py-3 px-4">PENYELENGGARA</th>
                        <th class="py-3 px-4">CAKUPAN</th>
                        <th class="py-3 px-4">BATAS AKHIR</th>
                        <th class="py-3 px-4">STATUS</th>
                        <th class="py-3 px-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($scholarships as $item)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3 px-4">
                            <div class="w-14 h-10 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                <img src="{{ $item->image_url }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <h4 class="font-bold text-slate-800 text-xs">{{ $item->title }}</h4>
                            <p class="text-[10px] text-slate-400 line-clamp-1 mt-0.5">{{ $item->description }}</p>
                        </td>
                        <td class="py-3 px-4 text-slate-700 font-medium">
                            {{ $item->provider ?? 'Huxley University Foundation' }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold {{ $item->coverage_type === 'full' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                                {{ $item->coverage_type_label }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-600">
                            @if($item->deadline)
                                <span class="{{ $item->deadline->isPast() ? 'text-red-500 font-semibold' : 'text-slate-600' }}">
                                    {{ $item->deadline->format('d M Y') }}
                                </span>
                            @else
                                <span class="text-slate-400">Sepanjang Tahun</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if($item->is_active)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-700">Dibuka</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-slate-100 text-slate-500">Ditutup</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.scholarships.edit', $item->id) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-blue-600 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('admin.scholarships.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus program beasiswa ini?');">
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
                                <i class="fa-solid fa-graduation-cap text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Belum Ada Program Beasiswa</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($scholarships->hasPages())
        <div class="mt-4">
            {{ $scholarships->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

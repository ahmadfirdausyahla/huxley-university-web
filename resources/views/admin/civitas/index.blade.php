@extends('layouts.admin')

@section('title', 'Manajemen Civitas & Mahasiswa')
@section('page_title', 'MANAJEMEN MAHASISWA & STAFF')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Data Mahasiswa, Dosen & Staff</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola data induk civitas akademika untuk validasi registrasi event dan kemahasiswaan.</p>
        </div>
        <a href="{{ route('admin.civitas.create') }}" 
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="fa-solid fa-user-plus"></i>
            <span>Tambah Data Baru</span>
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        
        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('admin.civitas.index') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, NIP, atau prodi..." 
                           class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none placeholder-slate-400 transition">
                </div>
                <select name="type" onchange="this.form.submit()" 
                        class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:border-blue-500 outline-none transition">
                    <option value="">Semua Kategori</option>
                    <option value="mahasiswa" {{ request('type') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="dosen" {{ request('type') == 'dosen' ? 'selected' : '' }}>Dosen Pengajar</option>
                    <option value="tendik" {{ request('type') == 'tendik' ? 'selected' : '' }}>Tenaga Kependidikan</option>
                    <option value="pimpinan" {{ request('type') == 'pimpinan' ? 'selected' : '' }}>Pimpinan Kampus</option>
                </select>
            </div>
            <span class="text-[11px] font-medium text-slate-400">Total: {{ $civitas->total() }} Anggota</span>
        </form>

        <!-- Table Grid -->
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">PROFIL</th>
                        <th class="py-3 px-4">NAMA LENGKAP</th>
                        <th class="py-3 px-4">NIM / NIP</th>
                        <th class="py-3 px-4">KATEGORI</th>
                        <th class="py-3 px-4">PRODI / FAKULTAS</th>
                        <th class="py-3 px-4">KONTAK</th>
                        <th class="py-3 px-4">STATUS</th>
                        <th class="py-3 px-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($civitas as $c)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3 px-4">
                            <div class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                <img src="{{ $c->image_url }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <h4 class="font-bold text-slate-800 text-xs">{{ $c->name }}</h4>
                            <p class="text-[10px] text-slate-400 mt-0.5">{{ $c->role }}</p>
                        </td>
                        <td class="py-3 px-4 font-mono font-semibold text-slate-700">
                            {{ $c->nip ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $c->type === 'mahasiswa' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-purple-50 text-purple-700 border border-purple-100' }}">
                                {{ $c->type_label }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-600">
                            <div class="font-medium text-slate-800">{{ $c->department ?? '-' }}</div>
                            <div class="text-[10px] text-slate-400">{{ $c->faculty ?? '-' }}</div>
                        </td>
                        <td class="py-3 px-4 text-slate-500">
                            <div>{{ $c->email ?? '-' }}</div>
                            <div class="text-[10px] text-slate-400">{{ $c->phone ?? '' }}</div>
                        </td>
                        <td class="py-3 px-4">
                            @if($c->is_active)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-700">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-slate-100 text-slate-500">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.civitas.edit', $c->id) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-blue-600 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('admin.civitas.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data civitas ini?');">
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
                        <td colspan="8" class="py-16 text-center text-slate-400">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-users text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Belum Ada Data Civitas / Mahasiswa</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($civitas->hasPages())
        <div class="mt-4">
            {{ $civitas->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

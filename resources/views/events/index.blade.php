@extends('layouts.admin')

@section('title', 'Daftar Berita')
@section('page_title', 'KELOLA BERITA KAMPUS')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Daftar Artikel & Berita</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola seluruh berita yang tampil pada portal utama kampus.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" 
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Berita Baru</span>
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden p-6">
        
        <!-- Search & Info Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
            <div class="relative w-full sm:w-80">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                <input type="text" placeholder="Cari berita..." 
                       class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:border-blue-500 outline-none placeholder-slate-400 transition">
            </div>
            <span class="text-[11px] font-medium text-slate-400">Menampilkan berita terbaru</span>
        </div>

        <!-- Table Grid -->
        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">GAMBAR HEADER</th>
                        <th class="py-3 px-4">JUDUL & LABEL</th>
                        <th class="py-3 px-4">TANGGAL RILIS</th>
                        <th class="py-3 px-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($news as $item)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3 px-4">
                            <div class="w-16 h-10 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                @if(!empty($item->image))
                                    <img src="{{ filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : asset('storage/' . $item->image) }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4 max-w-xs">
                            <h4 class="font-bold text-slate-800 text-xs line-clamp-1">{{ $item->title }}</h4>
                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-[9px] font-bold uppercase bg-blue-50 text-blue-600 border border-blue-100">
                                {{ $item->label ?? 'General' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap text-slate-500">
                            {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-blue-600 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?');">
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
                        <td colspan="4" class="py-20 text-center text-slate-400">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-regular fa-folder-open text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-xs">Belum Ada Berita Terdaftar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($news, 'links') && $news->hasPages())
        <div class="mt-4">
            {{ $news->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
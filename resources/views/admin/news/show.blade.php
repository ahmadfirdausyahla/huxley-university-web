@extends('layouts.admin')

@section('title', 'Detail Berita')
@section('page_title', 'Preview Berita Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('admin.news.index') }}" class="text-xs text-gray-400 hover:text-white transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Berita
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.news.edit', $news->id) }}" 
               class="px-4 py-2.5 bg-brand-blue hover:bg-blue-600 text-white rounded-xl text-xs font-bold transition flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i> Edit Artikel
            </a>
            <a href="{{ route('news.show', $news->id) }}" target="_blank" 
               class="px-4 py-2.5 bg-gray-900 hover:bg-gray-800 border border-gray-700 text-gray-300 rounded-xl text-xs font-bold transition flex items-center gap-2">
                <i class="fa-solid fa-globe"></i> Lihat Publik
            </a>
        </div>
    </div>

    <div class="bg-card-bg border border-border-dark rounded-2xl p-6 md:p-8 shadow-xl space-y-6">
        <div>
            <span class="px-3 py-1 bg-brand-blue/10 border border-brand-blue/20 text-brand-blue text-[10px] font-bold uppercase tracking-wider rounded-full">
                {{ $news->label ?? 'General' }}
            </span>
            <h1 class="text-2xl md:text-4xl font-serif font-bold text-white mt-3 leading-tight">{{ $news->title }}</h1>
            <p class="text-xs text-gray-500 mt-2 flex items-center gap-4">
                <span><i class="fa-regular fa-calendar text-brand-blue mr-1"></i> {{ $news->created_at ? $news->created_at->format('d F Y') : '-' }}</span>
                <span><i class="fa-regular fa-user text-brand-blue mr-1"></i> {{ $news->author ?? 'Admin' }}</span>
            </p>
        </div>

        @if($news->image)
            <div class="rounded-2xl overflow-hidden border border-border-dark max-h-96">
                <img src="{{ filter_var($news->image, FILTER_VALIDATE_URL) ? $news->image : asset('storage/' . $news->image) }}" class="w-full h-full object-cover">
            </div>
        @endif

        @if($news->description)
            <div class="p-4 rounded-xl bg-black border border-border-dark text-xs text-gray-300 italic">
                "{{ $news->description }}"
            </div>
        @endif

        <div class="prose prose-invert max-w-none text-xs leading-relaxed text-gray-300 border-t border-border-dark pt-6">
            {!! $news->content ?? $news->description ?? 'Tidak ada konten' !!}
        </div>
    </div>
</div>
@endsection
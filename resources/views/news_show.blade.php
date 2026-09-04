@extends('layouts.app')

@section('content')
@php
    $imageUrl = filter_var($news->image, FILTER_VALIDATE_URL)
        ? $news->image
        : asset('storage/' . $news->image);
@endphp

<main class="min-h-screen bg-black text-white pt-24">
    <section class="relative bg-gray-900 border-b border-gray-800">
        <div class="max-w-6xl mx-auto px-6 pt-8 md:pt-12">
            <a href="{{ route('news.index') }}"
                class="inline-flex items-center gap-2 text-xs font-bold tracking-wider text-gray-400 hover:text-brand-blue transition">
                <i class="fa-solid fa-arrow-left"></i>
                BACK TO NEWS
            </a>
        </div>

        <div class="max-w-6xl mx-auto px-6 pt-8 pb-12 md:pb-16">
            <div class="max-w-4xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 text-[10px] font-bold tracking-[0.22em] text-brand-blue uppercase mb-5">
                    <span class="w-2 h-2 rounded-full bg-brand-blue"></span>
                    {{ $news->label ?? 'University News' }}
                </div>

                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight">{{ $news->title }}</h1>

                <div class="mt-6 flex flex-wrap items-center gap-5 text-xs text-gray-400">
                    @if(!empty($news->created_at))
                        <span class="inline-flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-brand-blue"></i>
                            {{ $news->created_at->format('d F Y') }}
                        </span>
                    @endif
                    @if(!empty($news->author))
                        <span class="inline-flex items-center gap-2">
                            <i class="fa-regular fa-user text-brand-blue"></i>
                            {{ $news->author }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-10 md:py-14">
        <div class="rounded-3xl overflow-hidden bg-gray-800 border border-gray-800 shadow-xl" data-aos="zoom-in">
            @if($news->image)
                <img src="{{ $imageUrl }}" alt="{{ $news->title }}" class="w-full h-[300px] md:h-[520px] object-cover">
            @else
                <div class="w-full h-[300px] md:h-[520px] flex items-center justify-center bg-gray-800">
                    <i class="fa-regular fa-newspaper text-6xl text-gray-600"></i>
                </div>
            @endif
        </div>
    </section>

    <section class="pb-20 md:pb-28">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-gray-900 rounded-3xl border border-gray-800 shadow-xl p-7 md:p-12" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-1 rounded-full bg-brand-blue"></span>
                    <span class="text-[10px] font-bold tracking-[0.22em] uppercase text-brand-blue">Huxley University Communication Center</span>
                </div>

                <article class="prose prose-invert prose-lg max-w-none prose-headings:font-serif prose-headings:text-white prose-p:text-gray-300 prose-p:leading-8 prose-a:text-brand-blue">
                    {!! $news->content ?? $news->description ?? '' !!}
                </article>

                <div class="mt-12 pt-8 border-t border-gray-800 flex flex-wrap gap-3">
                    <a href="{{ route('news.index') }}"
                        class="inline-flex items-center gap-2 bg-brand-blue text-white text-xs px-5 py-3 rounded-full font-bold hover:bg-blue-600 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                        MORE NEWS
                    </a>
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center gap-2 bg-black border border-gray-700 text-gray-300 text-xs px-5 py-3 rounded-full font-bold hover:bg-gray-800 transition">
                        <i class="fa-solid fa-house"></i>
                        HOME
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
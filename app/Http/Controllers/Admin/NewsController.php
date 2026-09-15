<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\StoreNewsRequest;
use App\Http\Requests\Admin\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('news', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        unset($data['image_file'], $data['image_url']);

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('news', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        unset($data['image_file'], $data['image_url']);

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
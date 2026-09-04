<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'label' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'col_span' => 'nullable|string',
            'row_span' => 'nullable|string',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('news', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        unset($data['image_file'], $data['image_url']);

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'label' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'col_span' => 'nullable|string',
            'row_span' => 'nullable|string',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('news', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        unset($data['image_file'], $data['image_url']);

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
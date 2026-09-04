<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\News;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua fasilitas / fitur
        $features = Feature::all();

        // Ambil 3 berita terbaru
        $news = News::latest()
            ->take(3)
            ->get();

        // Ambil 3 event terbaru
        $events = Event::latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'features',
            'news',
            'events'
        ));
    }
}
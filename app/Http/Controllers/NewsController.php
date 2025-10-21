<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::where('status', 'published')->with('user')->latest()->paginate(12);
        return view('news', [
            'news' => $news,
        ]);
    }

    public function news_detail($slug)
    {
        $berita_lainnya = News::where('status', 'published')->latest()->take(5)->get();
        $berita = News::where('slug', $slug)->where('status', 'published')->with('user')->firstOrFail();
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        return view('news_detail', [
            'berita' => $berita,
            'berita_lainnya' => $berita_lainnya,
            'berita_semua' => $berita_semua,
        ]);
    }
}

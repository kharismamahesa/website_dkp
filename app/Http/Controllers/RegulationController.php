<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Regulation;
use App\Models\RegulationCategory;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
    public function index()
    {
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        $regulation_categories = RegulationCategory::with('regulations')->get();

        return view('regulation', [
            'berita_semua' => $berita_semua,
            'regulation_categories' => $regulation_categories,
        ]);
    }
}

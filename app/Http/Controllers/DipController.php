<?php

namespace App\Http\Controllers;

use App\Models\DipCategory;
use App\Models\News;
use App\Models\RegulationCategory;
use Illuminate\Http\Request;

class DipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        $dip_categories = DipCategory::with('dip_documents')->get();

        return view('dip', [
            'berita_semua' => $berita_semua,
            'dip_categories' => $dip_categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

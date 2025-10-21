<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Department;
use App\Models\Gallery;
use App\Models\HeadOfficeSetting;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Slider;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $berita_terakhir = News::where('status', 'published')->latest()->first();
        $berita_lainnya = News::where('status', 'published')->latest()->skip(1)->take(4)->get();
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        $slider_terakhir = Slider::where('status', 1)->latest()->take(5)->get();
        $data_bidang = Department::all();
        $galeri = Gallery::all();
        $pimpinan = HeadOfficeSetting::first();
        $agenda = Agenda::where('status', true)
            ->whereBetween('date', [$today, $tomorrow])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('dashboard', [
            'berita_terakhir' => $berita_terakhir,
            'berita_lainnya' => $berita_lainnya,
            'berita_semua' => $berita_semua,
            'slider_terakhir' => $slider_terakhir,
            'data_bidang' => $data_bidang,
            'galeri' => $galeri,
            'agenda' => $agenda,
            'pimpinan' => $pimpinan,
        ]);
    }

    public function sekapursirih()
    {
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        return view('sekapursirih', [
            'berita_semua' => $berita_semua,
        ]);
    }

    public function visimisi()
    {
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        return view('visimisi', [
            'berita_semua' => $berita_semua,
        ]);
    }

    public function sejarah()
    {
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        return view('sejarah', [
            'berita_semua' => $berita_semua,
        ]);
    }

    public function tugasdanfungsi()
    {
        $berita_semua = News::where('status', 'published')->latest()->take(5)->get();
        return view('tugasfungsi', [
            'berita_semua' => $berita_semua,
        ]);
    }

    public function strukturorganisasi()
    {
        $data_bidang = Department::with('subDepartments')->orderBy('id')->get();
        $pimpinan = HeadOfficeSetting::first();
        return view('struktur_organisasi', [
            'data_bidang' => $data_bidang,
            'pimpinan' => $pimpinan,
        ]);
    }
}

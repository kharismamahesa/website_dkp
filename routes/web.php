<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DipController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegulationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/sekapursirih', [DashboardController::class, 'sekapursirih'])->name('sekapursirih');
Route::get('/visimisi', [DashboardController::class, 'visimisi'])->name('visimisi');
Route::get('/sejarah', [DashboardController::class, 'sejarah'])->name('sejarah');
Route::get('/tugasdanfungsi', [DashboardController::class, 'tugasdanfungsi'])->name('tugasdanfungsi');
Route::get('/strukturorganisasi', [DashboardController::class, 'strukturorganisasi'])->name('strukturorganisasi');

Route::get('/berita', [NewsController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [NewsController::class, 'news_detail'])->name('berita.detail');

Route::get('/regulasi', [RegulationController::class, 'index'])->name('regulasi');
Route::get('/dip', [DipController::class, 'index'])->name('dip');
Route::get('/pengaduan', [ComplaintController::class, 'index'])->name('pengaduan');
Route::post('/api/complaints', [ComplaintController::class, 'store'])->name('api.complaints.store');

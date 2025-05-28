<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomepageBannerController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\Admin\BeritaController;
    use App\Http\Controllers\NewsController;

Route::get('/', [UtamaController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    // Homepage Banner Routes - Semua menggunakan prefix 'admin'
    Route::get('homepage_banners', [HomepageBannerController::class, 'index'])->name('admin.homepage_banners.index');
    Route::get('homepage_banners/create', [HomepageBannerController::class, 'create'])->name('admin.homepage_banners.create');
    Route::post('homepage_banners', [HomepageBannerController::class, 'store'])->name('admin.homepage_banners.store');
    Route::get('homepage_banners/{id}/edit', [HomepageBannerController::class, 'edit'])->name('admin.homepage_banners.edit');
    Route::put('homepage_banners/{id}', [HomepageBannerController::class, 'update'])->name('admin.homepage_banners.update');
    Route::delete('homepage_banners/{id}', [HomepageBannerController::class, 'destroy'])->name('admin.homepage_banners.destroy');




Route::get('admin/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
Route::get('admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
Route::post('admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
Route::get('admin/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
Route::put('admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
Route::delete('admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');








});

// Route to display berita on the homepage
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');
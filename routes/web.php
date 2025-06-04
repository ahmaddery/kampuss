<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomepageBannerController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;

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




Route::get('/admin/settings/pmb', [SettingController::class, 'showPMBSettings'])->name('admin.settings.pmb')->middleware('auth');
Route::post('/admin/settings/toggle-pmb-status', [SettingController::class, 'togglePMBStatus'])->name('admin.settings.toggle.pmb.status')->middleware('auth');

Route::get('/admin', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile')->middleware('auth');
Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit')->middleware('auth');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update')->middleware('auth');
// Mengelola pengguna
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users')->middleware('auth');
Route::post('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create')->middleware('auth');
Route::post('/admin/users/deactivate/{id}', [AdminController::class, 'deactivateUser'])->name('admin.users.deactivate')->middleware('auth');
Route::post('/admin/users/reactivate/{id}', [AdminController::class, 'reactivateUser'])->name('admin.users.reactivate')->middleware('auth');
Route::post('/admin/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.updatePassword')->middleware('auth');





Route::get('admin/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
Route::get('admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
Route::post('admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
Route::get('admin/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
Route::put('admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
Route::delete('admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');



// Menampilkan daftar jurusan
Route::get('admin/jurusan', [JurusanController::class, 'index'])->name('admin.jurusan.index');
Route::get('admin/jurusan/create', [JurusanController::class, 'create'])->name('admin.jurusan.create');
Route::post('admin/jurusan', [JurusanController::class, 'store'])->name('admin.jurusan.store');
Route::get('admin/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('admin.jurusan.edit');
Route::put('admin/jurusan/{id}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
Route::delete('admin/jurusan/{id}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
Route::get('admin/jurusan/{id}', [JurusanController::class, 'show'])->name('admin.jurusan.show');






});

// Route to display berita on the homepage
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');


//Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomepageBannerController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SambutanRektorController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;

Route::get('/', [UtamaController::class, 'index']);

// Newsletter Routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{email}/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');


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
    
    // Newsletter Routes
    Route::get('admin/newsletter', [AdminNewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('admin/newsletter/create', [AdminNewsletterController::class, 'create'])->name('admin.newsletter.create');
    Route::post('admin/newsletter', [AdminNewsletterController::class, 'store'])->name('admin.newsletter.store');
    Route::get('admin/newsletter/{id}/edit', [AdminNewsletterController::class, 'edit'])->name('admin.newsletter.edit');
    Route::put('admin/newsletter/{id}', [AdminNewsletterController::class, 'update'])->name('admin.newsletter.update');
    Route::delete('admin/newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::patch('admin/newsletter/{id}/toggle-active', [AdminNewsletterController::class, 'toggleActive'])->name('admin.newsletter.toggle-active');




Route::get('admin/sambutan_rektor', [SambutanRektorController::class, 'index'])->name('admin.sambutan_rektor.index');
Route::get('admin/sambutan_rektor/create', [SambutanRektorController::class, 'create'])->name('admin.sambutan_rektor.create');
Route::post('admin/sambutan_rektor', [SambutanRektorController::class, 'store'])->name('admin.sambutan_rektor.store');
Route::get('admin/sambutan_rektor/{id}/edit', [SambutanRektorController::class, 'edit'])->name('admin.sambutan_rektor.edit');
Route::put('admin/sambutan_rektor/{id}', [SambutanRektorController::class, 'update'])->name('admin.sambutan_rektor.update');
Route::delete('admin/sambutan_rektor/{id}', [SambutanRektorController::class, 'destroy'])->name('admin.sambutan_rektor.destroy');




Route::get('admin/sejarah', [SejarahController::class, 'index'])->name('admin.sejarah.index');
Route::get('admin/sejarah/create', [SejarahController::class, 'create'])->name('admin.sejarah.create');
Route::post('admin/sejarah', [SejarahController::class, 'store'])->name('admin.sejarah.store');
Route::get('admin/sejarah/{id}/edit', [SejarahController::class, 'edit'])->name('admin.sejarah.edit');
Route::put('admin/sejarah/{id}', [SejarahController::class, 'update'])->name('admin.sejarah.update');
Route::delete('admin/sejarah/{id}', [SejarahController::class, 'destroy'])->name('admin.sejarah.destroy');



Route::get('/admin/settings/pmb', [SettingController::class, 'showPMBSettings'])->name('admin.settings.pmb')->middleware('auth');
Route::post('/admin/settings/toggle-pmb-status', [SettingController::class, 'togglePMBStatus'])->name('admin.settings.toggle.pmb.status')->middleware('auth');
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings.index')->middleware('auth');

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


Route::get('admin/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
Route::get('admin/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
Route::post('admin/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
Route::get('admin/pengumuman/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
Route::put('admin/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
Route::delete('admin/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');


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

Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('pengumuman.show');


// Route untuk halaman index (menampilkan view sambutan-rektor)
Route::get('/sambutan-rektor', [SambutanController::class, 'index'])->name('sambutan-rektor.index');
Route::get('/sejarah', [SambutanController::class, 'sejarah'])->name('sejarah.index');


//Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');
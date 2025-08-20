<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomepageBannerController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\SambutanRektorController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\Admin\OrganizationStructureController as AdminOrganizationStructureController;
use App\Http\Controllers\Admin\InformasiProgramController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\ContactController as PublicContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\FasilitasController;

Route::get('/', [UtamaController::class, 'index']);

// Test route to check ViewServiceProvider
Route::get('/test-page-settings', function () {
    return view('test-page-settings');
});

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

        // Informasi Program Admin Routes
    Route::get('admin/informasi-program', [InformasiProgramController::class, 'index'])->name('admin.informasi-program.index');
    Route::get('admin/informasi-program/create', [InformasiProgramController::class, 'create'])->name('admin.informasi-program.create');
    Route::post('admin/informasi-program', [InformasiProgramController::class, 'store'])->name('admin.informasi-program.store');
    Route::get('admin/informasi-program/{informasiProgram}', [InformasiProgramController::class, 'show'])->name('admin.informasi-program.show');
    Route::get('admin/informasi-program/{informasiProgram}/edit', [InformasiProgramController::class, 'edit'])->name('admin.informasi-program.edit');
    Route::put('admin/informasi-program/{informasiProgram}', [InformasiProgramController::class, 'update'])->name('admin.informasi-program.update');
    Route::delete('admin/informasi-program/{informasiProgram}', [InformasiProgramController::class, 'destroy'])->name('admin.informasi-program.destroy');

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
        
    // Newsletter Routes
    Route::get('admin/newsletter', [AdminNewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('admin/newsletter/create', [AdminNewsletterController::class, 'create'])->name('admin.newsletter.create');
    Route::post('admin/newsletter', [AdminNewsletterController::class, 'store'])->name('admin.newsletter.store');
    Route::get('admin/newsletter/{id}/edit', [AdminNewsletterController::class, 'edit'])->name('admin.newsletter.edit');
    Route::put('admin/newsletter/{id}', [AdminNewsletterController::class, 'update'])->name('admin.newsletter.update');
    Route::delete('admin/newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::patch('admin/newsletter/{id}/toggle-active', [AdminNewsletterController::class, 'toggleActive'])->name('admin.newsletter.toggle-active');

    // Visi Misi Routes
    Route::get('admin/visi-misi', [VisiMisiController::class, 'index'])->name('admin.visi-misi.index');
    Route::get('admin/visi-misi/create', [VisiMisiController::class, 'create'])->name('admin.visi-misi.create');
    Route::post('admin/visi-misi', [VisiMisiController::class, 'store'])->name('admin.visi-misi.store');
    Route::get('admin/visi-misi/{visionMission}/edit', [VisiMisiController::class, 'edit'])->name('admin.visi-misi.edit');
    Route::put('admin/visi-misi/{visionMission}', [VisiMisiController::class, 'update'])->name('admin.visi-misi.update');
    Route::delete('admin/visi-misi/{visionMission}', [VisiMisiController::class, 'destroy'])->name('admin.visi-misi.destroy');
    Route::get('admin/visi-misi/{visionMission}', [VisiMisiController::class, 'show'])->name('admin.visi-misi.show');
    Route::get('admin/visi-misi/type/{type}', [VisiMisiController::class, 'getByType'])->name('admin.visi-misi.by-type');
    Route::post('admin/visi-misi/reorder-missions', [VisiMisiController::class, 'reorderMissions'])->name('admin.visi-misi.reorder-missions');

    // Organization Structure Admin Routes
    Route::get('admin/organization-structure', [AdminOrganizationStructureController::class, 'index'])->name('admin.organization-structure.index');
    Route::get('admin/organization-structure/create', [AdminOrganizationStructureController::class, 'create'])->name('admin.organization-structure.create');
    Route::post('admin/organization-structure', [AdminOrganizationStructureController::class, 'store'])->name('admin.organization-structure.store');
    Route::get('admin/organization-structure/{organizationStructure}/edit', [AdminOrganizationStructureController::class, 'edit'])->name('admin.organization-structure.edit');
    Route::put('admin/organization-structure/{organizationStructure}', [AdminOrganizationStructureController::class, 'update'])->name('admin.organization-structure.update');
    Route::delete('admin/organization-structure/{organizationStructure}', [AdminOrganizationStructureController::class, 'destroy'])->name('admin.organization-structure.destroy');
    Route::get('admin/organization-structure/{organizationStructure}', [AdminOrganizationStructureController::class, 'show'])->name('admin.organization-structure.show');
    Route::post('admin/organization-structure/update-order', [AdminOrganizationStructureController::class, 'updateOrder'])->name('admin.organization-structure.update-order');



Route::get('/admin/settings/pmb', [SettingController::class, 'showPMBSettings'])->name('admin.settings.pmb')->middleware('auth');
Route::post('/admin/settings/toggle-pmb-status', [SettingController::class, 'togglePMBStatus'])->name('admin.settings.toggle.pmb.status')->middleware('auth');
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings.index')->middleware('auth');
Route::get('/admin/settings/pages', [SettingController::class, 'pages'])->name('admin.settings.pages')->middleware('auth');
Route::patch('/admin/settings/toggle-page-status/{pageName}', [SettingController::class, 'togglePageStatus'])->name('admin.settings.toggle-page-status')->middleware('auth');
Route::post('/admin/settings/bulk-activate', [SettingController::class, 'bulkActivate'])->name('admin.settings.bulk-activate')->middleware('auth');
Route::post('/admin/settings/bulk-deactivate', [SettingController::class, 'bulkDeactivate'])->name('admin.settings.bulk-deactivate')->middleware('auth');

// General Settings Routes
Route::get('/admin/settings/general', [App\Http\Controllers\Admin\GeneralSettingController::class, 'index'])->name('admin.settings.general')->middleware('auth');
Route::put('/admin/settings/general/update', [App\Http\Controllers\Admin\GeneralSettingController::class, 'updateGeneral'])->name('admin.settings.general.update')->middleware('auth');
Route::put('/admin/settings/social/update', [App\Http\Controllers\Admin\GeneralSettingController::class, 'updateSocial'])->name('admin.settings.social.update')->middleware('auth');
Route::put('/admin/settings/system/update', [App\Http\Controllers\Admin\GeneralSettingController::class, 'updateSystem'])->name('admin.settings.system.update')->middleware('auth');

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

    // Contact Messages Routes
    Route::get('admin/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages.index');
    Route::get('admin/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('admin.contact-messages.show');
    Route::post('admin/contact-messages/{contactMessage}/reply', [ContactMessageController::class, 'reply'])->name('admin.contact-messages.reply');
    Route::patch('admin/contact-messages/{contactMessage}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('admin.contact-messages.toggle-read');
    Route::patch('admin/contact-messages/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])->name('admin.contact-messages.update-status');
    Route::delete('admin/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
    Route::post('admin/contact-messages/bulk-action', [ContactMessageController::class, 'bulkAction'])->name('admin.contact-messages.bulk-action');

    // Fasilitas Admin Routes
    Route::get('admin/fasilitas', [AdminFasilitasController::class, 'index'])->name('admin.fasilitas.index');
    Route::get('admin/fasilitas/create', [AdminFasilitasController::class, 'create'])->name('admin.fasilitas.create');
    Route::post('admin/fasilitas', [AdminFasilitasController::class, 'store'])->name('admin.fasilitas.store');
    Route::get('admin/fasilitas/{fasilitas}', [AdminFasilitasController::class, 'show'])->name('admin.fasilitas.show');
    Route::get('admin/fasilitas/{fasilitas}/edit', [AdminFasilitasController::class, 'edit'])->name('admin.fasilitas.edit');
    Route::put('admin/fasilitas/{fasilitas}', [AdminFasilitasController::class, 'update'])->name('admin.fasilitas.update');
    Route::delete('admin/fasilitas/{fasilitas}', [AdminFasilitasController::class, 'destroy'])->name('admin.fasilitas.destroy');
    Route::patch('admin/fasilitas/{fasilitas}/toggle-status', [AdminFasilitasController::class, 'toggleStatus'])->name('admin.fasilitas.toggle-status');

    // Biro Admin Routes
    Route::get('admin/biro', [App\Http\Controllers\Admin\BiroController::class, 'index'])->name('admin.biro.index');
    Route::get('admin/biro/create', [App\Http\Controllers\Admin\BiroController::class, 'create'])->name('admin.biro.create');
    Route::post('admin/biro', [App\Http\Controllers\Admin\BiroController::class, 'store'])->name('admin.biro.store');
    Route::get('admin/biro/{biro}', [App\Http\Controllers\Admin\BiroController::class, 'show'])->name('admin.biro.show');
    Route::get('admin/biro/{biro}/edit', [App\Http\Controllers\Admin\BiroController::class, 'edit'])->name('admin.biro.edit');
    Route::put('admin/biro/{biro}', [App\Http\Controllers\Admin\BiroController::class, 'update'])->name('admin.biro.update');
    Route::delete('admin/biro/{biro}', [App\Http\Controllers\Admin\BiroController::class, 'destroy'])->name('admin.biro.destroy');

    // Activity Logs Routes
    Route::get('admin/activity-logs', [App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('admin.activity-logs.index');
    Route::get('admin/activity-logs/{activityLog}', [App\Http\Controllers\Admin\ActivityLogController::class, 'show'])->name('admin.activity-logs.show');
    Route::get('admin/activity-logs/export/csv', [App\Http\Controllers\Admin\ActivityLogController::class, 'export'])->name('admin.activity-logs.export');
    Route::post('admin/activity-logs/clear', [App\Http\Controllers\Admin\ActivityLogController::class, 'clear'])->name('admin.activity-logs.clear');
    Route::get('admin/activity-logs/chart/data', [App\Http\Controllers\Admin\ActivityLogController::class, 'chartData'])->name('admin.activity-logs.chart-data');

















});

// Route to display berita on the homepage
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index')->middleware('check.page.status:berita');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show')->middleware('check.page.status:berita');

Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index')->middleware('check.page.status:pengumuman');
Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('pengumuman.show')->middleware('check.page.status:pengumuman');

// Route for jurusan detail page
Route::get('/jurusan', [App\Http\Controllers\JurusanController::class, 'index'])->name('jurusan.index')->middleware('check.page.status:jurusan');
Route::get('/jurusan/{slug}', [App\Http\Controllers\JurusanController::class, 'show'])->name('jurusan.show')->middleware('check.page.status:jurusan');


// Route untuk halaman index (menampilkan view sambutan-rektor)
Route::get('/sambutan-rektor', [SambutanController::class, 'index'])->name('sambutan-rektor.index')->middleware('check.page.status:sambutan-rektor');
Route::get('/sejarah', [SambutanController::class, 'sejarah'])->name('sejarah.index')->middleware('check.page.status:sejarah');
Route::get('/visi-misi', [App\Http\Controllers\VisiMisiController::class, 'index'])->name('visi-misi.index')->middleware('check.page.status:visi-misi');

// Organization Structure Public Routes
Route::get('/struktur-organisasi', [OrganizationStructureController::class, 'index'])->name('organization-structure.index')->middleware('check.page.status:struktur-organisasi');
Route::get('/struktur-organisasi/{id}', [OrganizationStructureController::class, 'show'])->name('organization-structure.show')->middleware('check.page.status:struktur-organisasi');
Route::get('/struktur-organisasi/tree/data', [OrganizationStructureController::class, 'tree'])->name('organization-structure.tree')->middleware('check.page.status:struktur-organisasi');

// Contact Public Route
Route::get('/contact', [PublicContactController::class, 'index'])->name('contact.index')->middleware('check.page.status:contact');
Route::post('/contact', [PublicContactController::class, 'store'])->name('contact.store')->middleware('contact.rate.limit');

// Fasilitas Public Routes
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index')->middleware('check.page.status:fasilitas');
Route::get('/fasilitas/{slug}', [FasilitasController::class, 'show'])->name('fasilitas.show')->middleware('check.page.status:fasilitas');

// Biro Public Routes
Route::get('/biro', [App\Http\Controllers\BiroController::class, 'index'])->name('biro.index')->middleware('check.page.status:biro');
Route::get('/biro/{biro}', [App\Http\Controllers\BiroController::class, 'show'])->name('biro.show')->middleware('check.page.status:biro');


//Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');
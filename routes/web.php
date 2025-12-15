<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembayaranCotroller;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/gallery/detail/{gallery}', [HomeController::class, "galleryDetail"])->name("home.gallery");
Route::get('/pekerjaan', [CmsController::class, 'showAll'])->name('pekerjaan.index');
Route::get('/pekerjaan/{cms}', [CmsController::class, 'showById'])->name('pekerjaan.detail');
Route::prefix('profiles')->name('profiles.')->group(function () {
    Route::get('/', [ProfilesController::class, 'index'])->name('index');
    Route::get('/legalitas', [ProfilesController::class, 'legalitas'])->name('legalitas');
    Route::get('/portofolio', [ProfilesController::class, 'portofolio'])->name('portofolio');
     Route::get('/legalitas/{cms}', [CmsController::class, 'showById'])->name('legalitas.detail');
    Route::get('/portofolio/{portofolio}', [PortofolioController::class, 'showById'])->name('portofolio.detail');
});

Route::middleware('auth')->group(function () {
    Route::get('/pesanan/{id}', [PesananController::class, "index"])->name("pesanan.index");
    Route::get('/pesanan/detail/{id}', [PesananController::class, "detail"])->name("pesanan.detail");
     Route::post('/pesanan/confirm/{order}', [PesananController::class, "finish"])->name("pesanan.selesai");
    Route::delete('/pesanan/{order}', [PesananController::class, "destroy"])->name("pesanan.destroy");
    Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['verified',"role:admin"])->name('dashboard');

    Route::get('/pembayaran/{id}', [PembayaranCotroller::class, "create"])->name("pembayaran.index");
    Route::post('/pembayaran/{id}', [PembayaranCotroller::class, "store"])->name("pembayaran.store");
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
require __DIR__.'/product.php';
require __DIR__.'/cart.php';
require __DIR__.'/order.php';
require __DIR__.'/gallery.php';
// require __DIR__.'/cms.php';
require __DIR__.'/site.php';
require __DIR__.'/user.php';
require __DIR__.'/bank.php';
require __DIR__.'/payment.php';
require __DIR__.'/portofolio.php';
require __DIR__.'/legalitas.php';

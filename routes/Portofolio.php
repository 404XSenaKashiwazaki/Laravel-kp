<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortofolioController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio.index');

    Route::get('/portofolio/add', [PortofolioController::class, 'create'])->name('portofolio.create');
    Route::get('/portofolio/edit/{portofolio}', [PortofolioController::class, 'edit'])->name('portofolio.edit');
    Route::post('/portofolio', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::put('/portofolio/{portofolio}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/{portofolio}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');
});


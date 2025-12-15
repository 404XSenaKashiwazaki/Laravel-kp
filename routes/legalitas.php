<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/legalitas', [CmsController::class, 'index'])->name('cms.index');
    Route::get('/legalitas/add', [CmsController::class, 'create'])->name('cms.create');
    Route::get('/legalitas/edit/{cms}', [CmsController::class, 'edit'])->name('cms.edit');
    Route::post('/legalitas', [CmsController::class, 'store'])->name('cms.store');
    Route::put('/legalitas/{cms}', [CmsController::class, 'update'])->name('cms.update');
    Route::delete('/legalitas/{cms}', [CmsController::class, 'destroy'])->name('cms.destroy');
});


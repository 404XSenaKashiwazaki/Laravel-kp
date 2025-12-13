
<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/situs', [SiteController::class, 'index'])->name('site.index');
    Route::put('/situs/{site}', [SiteController::class, 'update'])->name('site.update');
});


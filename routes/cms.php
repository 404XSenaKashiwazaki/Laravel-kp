
<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/cms', [CmsController::class, 'index'])->name('cms.index');
   
    Route::get('/cms/add', [CmsController::class, 'create'])->name('cms.create');
    Route::get('/cms/edit/{cms}', [CmsController::class, 'edit'])->name('cms.edit');
    Route::post('/cms', [CmsController::class, 'store'])->name('cms.store');
    Route::put('/cms/{cms}', [CmsController::class, 'update'])->name('cms.update');
    Route::delete('/cms/{cms}', [CmsController::class, 'destroy'])->name('cms.destroy');
});


<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/produk/add', [ProductController::class, 'create'])->name('product.create');
    Route::get('/produk/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

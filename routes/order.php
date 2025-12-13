<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
      Route::get('/orders/detail/{order}', [OrderController::class, 'detail'])->name('orders.detail');
});

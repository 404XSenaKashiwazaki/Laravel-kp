<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/detail/{payment}', [PaymentController::class, 'show'])->name('payment.detail');
     Route::put('/payment/confirm/{order}', [PaymentController::class, 'confirm'])->name('payment.confirm');
});

<?php

use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/bank', [BankController::class, 'index'])->name('bank.index');
    Route::get('/bank/add', [BankController::class, 'create'])->name('bank.create');
    Route::get('/bank/edit/{bank}', [BankController::class, 'edit'])->name('bank.edit');
    Route::post('/bank', [BankController::class, 'store'])->name('bank.store');
    Route::put('/bank/{bank}', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/bank/{bank}', [BankController::class, 'destroy'])->name('bank.destroy');
});

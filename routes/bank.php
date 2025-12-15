<?php

use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/kontak', [BankController::class, 'index'])->name('bank.index');
    Route::get('/kontak/add', [BankController::class, 'create'])->name('bank.create');
    Route::get('/kontak/edit/{bank}', [BankController::class, 'edit'])->name('bank.edit');
    Route::post('/kontak', [BankController::class, 'store'])->name('bank.store');
    Route::put('/kontak/{bank}', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/kontak/{bank}', [BankController::class, 'destroy'])->name('bank.destroy');
});

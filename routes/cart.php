
<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;


Route::middleware('auth')->group(function () {
   Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


Route::post('/checkout', [CartController::class, 'checkout'])
    ->name('cart.checkout');

});


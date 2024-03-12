<?php

use App\Http\Controllers\CartItemsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest.authenticate'])->group(function (){
    Route::get('{userId}/cart-items', [CartItemsController::class, 'index'])->name('cart-items');
    Route::post('add-to-cart', [CartItemsController::class, 'store'])->name('add-to-cart');
    Route::put('cart-quantity-change', [CartItemsController::class, 'update'])->name('change-cart-item-quantity');
    Route::post('remove-from-cart', [CartItemsController::class, 'destroy'])->name('remove-from-cart');
});

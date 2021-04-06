<?php

use App\Http\Controllers\HistoryController;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('show/{barang:slug}', [ShopController::class, 'show'])->name('shop.show');
Route::middleware('auth')->group(function () {
    Route::post('show/{barang:slug}', [ShopController::class, 'store'])->name('shop.store');
    Route::get('cart', [ShopController::class, 'cart'])->name('cart');
    Route::DELETE('cart/{id}', [ShopController::class, 'delete'])->name('cart.delete');
    Route::get('confirmation', [ShopController::class, 'confirmation'])->name('cart.corfirmation');
    Route::get('profile', [ProfileController::class, 'index']);
    Route::post('profile', [ProfileController::class, 'update']);
    Route::get('history/', [HistoryController::class, 'index']);
    Route::get('history/{id}', [HistoryController::class, 'detail']);
});

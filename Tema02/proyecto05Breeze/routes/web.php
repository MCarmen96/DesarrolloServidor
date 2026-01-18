<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/', [ProductController::class, 'home'])->name('home');


Route::middleware('auth')->group(function(){

    Route::post('/cart/add/{id}',[CartController::class,'add'])->name('cart.add');//agrega productos al carrito y añade cantidad
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');//ver el carrito
    Route::delete('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');//eliminar producto
    Route::delete('/cart',[CartController::class,'clear'])->name('cart.clear');//vaciar carrito
    Route::put('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::put('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/order', [CartController::class, 'order'])->name('cart.order');
    Route::get('/pedidos', [CartController::class, 'orders'])->name('cart.orders');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

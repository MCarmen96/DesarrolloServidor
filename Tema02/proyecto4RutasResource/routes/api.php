<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// PROTEGEMOS LAS RUTAS EN CONJUNTO
//pero no es necesario lo teneemos en los apuntes de las dos maneras
Route::post('/login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){

    Route::apiResource('products',ProductController::class);

    Route::get('/user',[AuthController::class,'user']);
    
    Route::get('/logout',[AuthController::class,'logout']);

});

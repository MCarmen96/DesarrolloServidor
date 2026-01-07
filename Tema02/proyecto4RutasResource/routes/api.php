<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
// PROTEGEMOS LAS RUTAS EN CONJUNTO
//pero no es necesario lo teneemos en los apuntes de las dos maneras
Route::middleware(['auth:sanctum'])->group(function(){

    Route::apiResource('products',ProductController::class);
    Route::get('/user',[AuthController::class,'user']);
    Route::post('/logout',[AuthController::class,'logout']);

});

<?php
use App\Http\Controllers\MiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios',[MiController::class,'index'])->name('usuarios.index');

Route::get('/create',[MiController::class,'create']);

Route::post('/store',[MiController::class,'store']);

Route::get('/usuarios/{id}',[MiController::class,'show'])->name('usuarios.show');

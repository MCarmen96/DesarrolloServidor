<?php

use App\Http\Controllers\DepartController;
use App\Http\Controllers\EmpleController;
use App\Http\Controllers\MiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo/{nombre?}',[MiController::class,'saludar']);

// EL CONTROLADOR TIENE QUE SER EL CONTROLLER DEL DEPARTAMENTO
// QUE ES LE QUE VA ACCEDER A LOS DATOS DE ESA TABLA PARA MOSTRAR SU CONTENIDO
Route::get('/departamento/{depart_no}',[MiController::class,'mostrar']);
Route::get('/Form',[MiController::class,'mostrarForm']);
Route::post('/procesarForm',[MiController::class,'procesarForm']);

Route::resource('departs',DepartController::class);
Route::resource('emples',EmpleController::class);




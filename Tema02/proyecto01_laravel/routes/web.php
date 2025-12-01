<?php

use App\Http\Controllers\MiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estatico', function () {
    $archivo='fichero.html';
    $contenido=file_get_contents(public_path($archivo));
    error_log($contenido);
    echo $contenido;
    //return response()->file(public_path('static.html'));
});

Route::get('/prueba', function () {
    //           CARPETA.ARCHIVO
    return view('prueba.prueba',['contenido'=>'hola desde un array asociativo pasado a la vista']);
});

Route::get('/redirecion', function () {
    return redirect('estatico.html');
});
// LLAMO AL CONTROLARDOR INDICANDO QUE METODO QUIERO Y SU RUTA
Route::get('/mostar-datos',[MiController::class,'mostrar']);


Route::get('/hola',function(){
    return "<h1>Holaaa desde el router devolviendo una cadena directa con un H1</h1>";
});





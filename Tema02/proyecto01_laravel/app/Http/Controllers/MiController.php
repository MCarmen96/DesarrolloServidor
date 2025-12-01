<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiController extends Controller
{
    function mostrar(){
        $contenido=file_get_contents(storage_path('app/fichero2.txt'));
        return view('prueba.archivo',['contenido'=>$contenido]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MiController extends Controller
{
    //
    function index(){
        //array asociativo
        $json=file_get_contents(storage_path('app/private/usuarios.json'));

        $contenido=json_decode($json,true);
        error_log($json);
        return view('listaUser',['contenido'=> $contenido]);
    }

    function create(){
        return view('formulario');
    }

    function store(Request $request){

        $jsonData=file_get_contents(storage_path('app/private/usuarios.json'));
        $arrayData=json_decode($jsonData,true);

        //$ultimo=count($arrayData)-1;
        //$countDatos=count($arrayData);
        //error_log($countDatos);
        error_log(json_encode($arrayData));
        //error_log(json_encode($data2));

        //$datosNuevos=json_encode($arrayData);//lo codifico
        $datos["name"]=$request->get('name');
        $datos["email"]=$request->get('email');
        $ultimo=$arrayData[count($arrayData)-1]['id'];
        $datos["id"]=$ultimo+1;

        array_push($arrayData,$datos);
        error_log(json_encode($arrayData));
        $archivoConNuevosDatos=file_put_contents(storage_path('app/private/usuarios.json'),$datos);
        //$ultimo=count($data);//
        return redirect('/usuarios');
    }

    function show($id){

        $json=file_get_contents(storage_path('app/private/usuarios.json'));
        $contenido=json_decode($json,true);
        $name=$contenido["name"];

    }


}

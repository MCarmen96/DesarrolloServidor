<?php

namespace App\Http\Controllers;

use app\Models\Depart;
use Illuminate\Http\Request;

class MiController extends Controller
{
    //

    public function saludar($nombre="invitado"){
        return 'Hola '. $nombre;
    }
    // esta funcion iria en el cotrolador del departamento para mostrar su contenido
    public function mostrar( Depart $dpto){
        // NO ME FUNCIONA TENGO QUE MIRAR PO RQUE NO FUNCIONA
        if($dpto){
            return "Departamento, ".$dpto->dnombre;
        }
        return "Departamento, NULL";
    }

    public function mostrarForm(){
        return view('formFallos');
    }

    public function procesarForm(Request $request){

        $request->validate([
            'name'=>'required|string|max:10',
            'image'=>'required|image|mimes:jpg,jpeg,png|max:2049'
        ]);

        $file=$request->file('image');
        $file->store('uploads','public');
        $nombre=$request->name;

        return redirect('/Form')->with('success','Datos introducidos correctamente');
    }
    
}

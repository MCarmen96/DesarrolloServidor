<?php

namespace app\Model;

use Illuminate\Database\Capsule\Manager as Capsule;
use app\Model\Depart;

class Database{

    public function __construct()
    {
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'database' => 'depart',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            error_log("conectado a base de datos");
        } catch (\Exception $e) {
            die("Error al conectar a la base d e datos" . $e->getMessage());
        }
    }

    public function listDepart(){
        $depart=Depart::all();
        return $depart;
    }

    public function deleteDepart($id){

        
        $depart=Depart::find($id);
        error_log(json_encode($depart));

        if($depart){
            
            $depart->delete();
            error_log("Departamento eliminado $id");
        }else{
            error_log("Departamento no encontrado");
        }
    }

    public function findDepart($id){

        $depar=Depart::find($id);
        return $depar;


    }


}

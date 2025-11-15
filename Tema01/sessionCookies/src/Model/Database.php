<?php

namespace app\Model;

use Illuminate\Database\Capsule\Manager as Capsule;
use app\Model\User;

class Database{

    public function __construct()
    {
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'database' => 'users',
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
            die("Error al conectar a la base de datos" . $e->getMessage());
        }
    }

    public function saveUser($name,$pin){
            $user=new User();
            $user->nombre=$name;
            $user->password=$pin;
            return $user->save();
    }

    public function saveShop($dataShop,$name){

        $user=User::where('nombre',$name)->first();

        if($user){
            $user->compra=$dataShop;
            $user->save();
        }

    }

    public function searchUser($name){

        $user=User::where('nombre',$name)->first();
        
        return $user;
    }
}
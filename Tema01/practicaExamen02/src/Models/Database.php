<?php

namespace app\Models;
use Illuminate\Database\Capsule\Manager as Capsule;
use app\Models\Users;
use app\Models\Users as ModelsUsers;
use Twig\Node\Expression\ReturnNumberInterface;

class Database{

    public function __construct()
    {
        try{
            $capsule=new Capsule();
            $capsule->addConnection([
                'driver'=>'mysql',
                'host'=>'127.0.0.1',
                'database'=>'users',
                'username'=>'root',
                'password'=>'',
                'charset'=>'utf8',
                'collation'=>'utf8_unicode_ci',
                'prefix'=>''
            ]);
        }catch(\Exception $e){
            die('ERROR AL CONECTAR A LA BBDD'.$e->getMessage());
        }
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function searchUser($name){
        $user=Users::where('nombre',$name)->first();
        return $user;
    }

    public function register($name,$pin){

        $user=new Users();
        $user->nombre=$name;
        $user->password=$pin;
        return $user->save();
    }
    public function saveShop($shop,$name){
        $user=$this->searchUser($name);
        $user->compra=$shop;
        return $user->save();
    } 
}
<?php

namespace app\Model;

use Illuminate\Database\Capsule\Manager as Capsule;
use app\Model\Users;
use Twig\Node\Expression\ReturnNumberInterface;

class Database
{
    public function __construct()
    {
        try {
            $capsule = new Capsule();
            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => "127.0.0.1",
                'database' => 'users',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);
        } catch (\Exception $e) {
            die("ERROR AL CONCECTAR A LA BBDD" . $e->getMessage());
        }

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function saveUser($name,$pin){
        $users=new Users();
        $users->nombre=$name;
        $users->password=$pin;
        return $users->save();
    }

    public function searchUser($name){
        $user=Users::where('nombre',$name)->first();
        return $user;
    }

    public function saveShop($shop,$name){
        $user=$this->searchUser($name);
        $user->compra=$shop;
        return $user->save();
    } 

}

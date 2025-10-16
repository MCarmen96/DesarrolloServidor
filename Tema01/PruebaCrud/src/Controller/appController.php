<?php

namespace carmen\pruebaexamen\Controller;
use carmen\pruebaexamen\Models\UserModel;


class appController{

    private $userModel;

    public function __construct()
    {
        $this->userModel=new UserModel();
    }


    public function viewIndex(){
        error_log("entrando al metodo viewindex");
        $names=$this->userModel->getUser();
        require __DIR__ ."/../View/form.php";
    }

    public function addUser($data){
        $name=$data["name"];
        $namelimpio=trim(htmlspecialchars($name));
        $this->userModel->writeUser($namelimpio);

        require __DIR__ ."/../View/Bienvenido.php";
    }
}
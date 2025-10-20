<?php

namespace carmen\pruebamysql\Controller;

use carmen\pruebamysql\Model\database;


class appController
{
    private $myModel;
    public function __construct()
    {
        $this->myModel=new database();
    }

    public function viewIndex(){

            require __DIR__ ."/../Views/home.php";
    }

    public function listarDepartamentos(){

        $departamentos=$this->myModel->lisDepart();
        require __DIR__ ."/../Views/listaDepart.php";
    }

    public function delDepart($data){

        $numDepart=$data["id"];
        $this->myModel->delDepart($numDepart);

        header("Location: /listDepart.php");

    }

   
}
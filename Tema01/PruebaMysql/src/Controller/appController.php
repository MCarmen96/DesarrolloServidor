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

        header("Location: /listDepart");

    }
    public function formUpdate($data){

        $id=(int)$data["id"];
        $nombre="";
        $localidad="";
        $datos=$this->myModel->filterDepart($id);
        for ($i=0; $i < count($datos); $i++) { 
            $nombre=$datos[$i]["dnombre"];
            $localidad=$datos[$i]["loc"];
        }
        require __DIR__."/../Views/formEditDepart.php";
    }


    public function formDepart(){
        require __DIR__."/../Views/formAddDepart.php";

    }
    public function addDepart($data){
        $nombre=$data['nameDepart'];
        $numero=$data['numberDepart'];
        $localidad=$data['locaDepart'];

        $this->myModel->addDepart($nombre,$numero,$localidad);
        header("Location: /listDepart");
    }

}
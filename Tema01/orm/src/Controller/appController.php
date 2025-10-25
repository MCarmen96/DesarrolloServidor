<?php

namespace app\Controller;

use app\Model\Database;

class appController{

    private $myModel;
    public function __construct()
    {
        $this->myModel=new Database();
    }

    public function viewIndex($id){

        $lista=$this->myModel->listDepart();
        require __DIR__ ."/../View/home.php";
    }

    public function deleteDepart($id){

        $dato=$id["id"];
        error_log(json_encode($id));
        $delete=$this->myModel->deleteDepart($dato);

        header("Location: /");
    }

    public function findDepart($data){

        $id=$data["id"];
        $edit=$this->myModel->findDepart($id);
        $nombre = $edit->dnombre; // Acceso como propiedad de objeto
        $loc = $edit->loc;

        require __DIR__ ."/../View/editForm.php";
    }

    public function saveEdit($data){
        //deberia satinizar la entrada del usuario
        $id=$data['id'];
        $nombre=$data['newname'];
        $loc=$data['newloc'];

        $isFind=$this->myModel->saveEdit($id,$nombre,$loc);

        if($isFind){

            require __DIR__ . "/../View/actualizado.php";

        }else{
            require __DIR__ . "/../View/fallo.php";
        }
        
    }

    public function create($data){
        $name=$data['name'];
        $loc=$data['loc'];
        $id=$data['id'];

        $this->myModel->create($name,$loc,$id);

        header("Location: /");
    }

    

}
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
        $nombre=$edit["dnombre"];
        $loc=$edit["loc"];

        require __DIR__ ."/../View/editForm.php";
    }



    

}
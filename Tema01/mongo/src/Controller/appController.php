<?php

namespace app\Controller;

use app\Model\Database;

class appController{

    private $myModel;
    public function __construct()
    {
        $this->myModel=new Database();
    }

    public function viewIndex(){

        $lista=$this->myModel->listDepart();
        $nav="nav.php";
        $contenido="indexMongo.php";
        $footer="footer.php";
        require __DIR__ ."/../View/plantilla.php";
    }

    public function departNew(){
        $nav="nav.php";
        $contenido="formNew.php";
        $footer="footer.php";
        require __DIR__ ."/../View/plantilla.php";

    }

    public function delete($data){

        $dept=(int)$data['id'];
        $this->myModel->delete($dept);
        header("Location: /");
    }

    public function edit($data){
        $dept=(int)$data['id'];
        $depart=$this->myModel->edit($dept);
        $footer="footer.php";
        $nav="nav.php";
        $name=$depart->dnombre;
        $loc=$depart->loc;    
        $contenido="edit.php";
        require __DIR__ . "/../View/plantilla.php";
    }

    public function update($data){
        $name=$data['name'];
        $loc=$data['loc'];
        $id=(int)$data['id'];

        $this->myModel->update($name,$loc,$id);

        header("Location: /");
        exit();
        
    }

    public function create($data){
        $name=$data['name'];
        $id=$data['id'];
        $loc=$data['loc'];

        $this->myModel->create($name,$id,$loc);
        header("Location: /");
        exit();
    }

}
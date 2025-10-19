<?php

namespace carmen\practicaphp\Controller;

use carmen\practicaphp\Model\userEmple;

class appController{

    private $userModel;
    public function __construct()
    {
        $this->userModel=new userEmple();
    }

    public function viewMenu(){

        require __DIR__ . "/../View/menu.php";
    }

    public function viewEmple(){    

        $empleados=$this->userModel->getsEmple();
        require __DIR__ . "/../View/listadoEmpleados.php";
    }

    public function viewDepart(){

        $departamentos=$this->userModel->getsDepart();

        require __DIR__ . "/../View/listadoDepart.php";
    }

}
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
}
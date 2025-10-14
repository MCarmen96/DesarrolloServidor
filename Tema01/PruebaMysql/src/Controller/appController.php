<?php

namespace carmen\pruebamysql\Controller;

use carmen\pruebamysql\Model;


class HomeController
{
    private $myModel;
    public function __construct()
    {
        $this->myModel=new Database();
    }

    public function viewIndex(){
        
        echo "<h1>Primera pagina con MYsql</h1>";
    }
}
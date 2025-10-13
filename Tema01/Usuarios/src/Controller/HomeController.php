<?php

namespace carmen\usuarios\Controller\HomeController;

use carmen\usuarios\Models\UserModel;

class HomeController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel=new UserModel();
    }

    public function viewForm()
    {   
        $usuarios=$this->userModel->getNames();

        $content="<h1>Listas nombres</h1>";

        for ($i=0; $i < count($usuarios); $i++) { 
            
            $content.="<li>{$usuarios[$i]}</li>";
        }

        $content.= " <hr>  <form action='/addNewUser' method='post'>
        <label for=''>Introduce un nombre
            <input type='text' name='nameUser'>
        </label>
        <button type='submit'>Enviar</button>
        </form> ";

        echo $content;
    }

    public function addNewUsers($datos){
        
        $nombreLimpio=htmlspecialchars($datos["nameUser"]);
        $this->userModel->writeFile($nombreLimpio);

        echo "<h1>Bienvenido {$nombreLimpio}</h1>";
        echo "<a href="/">Volver al inicio</a>";

    }

    public function deleteUser(){}



}

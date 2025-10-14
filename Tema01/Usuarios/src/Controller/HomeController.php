<?php

namespace carmen\usuarios\Controller;

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
        error_log("Entrando en viewForm()");

        $usuarios=$this->userModel->getNames();
        
        $content="<h1>Listas nombres</h1>";
        $content.="<ul>";

        for ($i=0; $i < count($usuarios); $i++) { 

            $content.="<li>{$usuarios[$i]}</li><a href='/deleteUser?id={$i}'>Deleted</a>";
        }
        $content.="</ul>";

        $content.= " <hr>  <form action='/addUser' method='post'>
        <label for=''>Introduce un nombre
            <input type='text' name='nameUser'>
        </label>
        <button type='submit'>Enviar</button>
        </form> ";

        echo $content;
    }

    public function addNewUsers($datos){
        
        $nombreLimpio=trim(htmlspecialchars($datos["nameUser"]));
        $this->userModel->writeFile($nombreLimpio);
        error_log($nombreLimpio);
        echo "<h1>Bienvenido {$nombreLimpio}</h1>";
        echo "<a href='/'>Volver al inicio</a>";

    }

    public function deleteUser($datos){

        $this->userModel->deleteUserById();

    }



}

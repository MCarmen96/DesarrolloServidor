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
        require  __DIR__."/../Views/listaUsers.php";
    }

    public function addNewUsers($datos){
        
        $nombreLimpio=trim(htmlspecialchars($datos["nameUser"]));
        $this->userModel->writeFile($nombreLimpio);

        require __DIR__."/../Views/Bienvenido.php";
    }

    public function deleteUser($datos){

        $deleteName=$this->userModel->deleteUserById($datos["id"]);

        require __DIR__ ."/../Views/Despedida.php";

    }

    public function modifyUser($data){
        $id=(int)$data["id"];
        $user=$this->userModel->getUser($id);
        require __DIR__ . "/../Views/modifyUser.php";

    }

    public function updateUser($data){
        $id=(int)$data["id"];
        $user=trim(htmlspecialchars($data["nameUser"]));
        
        $userUpdate=$this->userModel->modifyFileUpdateName($id,$user);

        require __DIR__ . "/../Views/viewUpdateUser.php";
    }



}

<?php
namespace app\Controller;
use app\Model\Database;

class appController{

    private $modelPizzas;

    public function __construct()
    {
        $this->modelPizzas=new Database();
    }

    public function viewIndex(){
        $lista=$this->modelPizzas->listPizzas();
        
        require __DIR__ ."/../View/homePizzas.php";
    }

    public function delete($data){
        $id=$data['id'];
        $this->modelPizzas->delete($id);
        header("Location: /");
    }

    public function edit($data){
        $id=$data['id'];
        $datos=$this->modelPizzas->giveForEdit($id);
        $nombre=$datos['nombre'];
        $ingred=$datos['ingredientes'];
        $alerg=$datos['alergenos'];
        $precio=$datos['precio'];
        require __DIR__ . "/../View/formEdit.php";
    }

    public function saveEdit($data){

        $name=$data['newName'];
        $ingred=$data['newIngre'];
        $alerg=$data['newAlerg'];
        $id=$data['id'];
        $precio=$data['newPrecio'];

        $encontrada=$this->modelPizzas->saveEdit($name,$ingred,$alerg,$id,$precio);

        if($encontrada){
            require __DIR__ . "/../View/actualizada.php";
        }else{
            require __DIR__ . "/../View/fallo.php";
        }
    }

    public function create($data){

        $name=$data['name'];
        $id=$data['id'];
        $ingred=$data['ingredientes'];
        $alerg=$data['alergenos'];
        $precio=$data['precio'];
        $this->modelPizzas->saveCreate($name,$id,$ingred,$alerg,$precio);
        header("Location: /");
    }

}
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
    
        $this->render("indexMongo",['lista'=>$lista]);
        
    }

    public function departNew(){
        
        $this->render("formNew");

    }

    public function delete($data){

        $dept=(int)$data['id'];
        $this->myModel->delete($dept);
        
        $this->render("indexMongo");
    }

    public function edit($data){
        $dept=(int)$data['id'];
        $depart=$this->myModel->edit($dept);
        $name=$depart->dnombre;
        $loc=$depart->loc;    
        
        $this->render("edit",['name'=>$name,'loc'=>$loc ,'id'=>$dept],);
    
    }

    public function update($data){
        $name=$data['name'];
        $loc=$data['loc'];
        $id=(int)$data['id'];

        $this->myModel->update($name,$loc,$id);

        $this->render("indexMongo");

        
    }

    public function create($data){
        $name=$data['name'];
        $id=$data['id'];
        $loc=$data['loc'];

        $this->myModel->create($name,$id,$loc);
        $this->render("indexMongo");
    }


    protected function render($view,$data=[]){

        extract($data);

        $viewPath=__DIR__."/../View/$view.php";
        
        if(file_exists($viewPath)){
            error_log("sale....".$viewPath);
            ob_start();
            require $viewPath;
            $contenido=ob_get_clean();
        }else{
            $contenido="<h2>VISTA NO ENCONTRADA 404</h2>";
        }

        require __DIR__ ."/../View/plantilla.php";
    }

}
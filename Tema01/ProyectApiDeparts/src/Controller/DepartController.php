<?php

namespace app\Controller;
use app\Model\Database;

class DepartController{
    
    private $database;

    public function __construct(){
        $this->database=new Database();
    }

    public function getAll(){
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Listado de todos los departementos']);
    }

    public function getId($id){
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Mostrando departemnto con ID: $id']);
    }

    public function create(){
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento creado existosamente']);
    }

    public function update(){
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento con ID $id actualizado correctamente']);
    }

    public function delete($id){
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento con ID $id eliminado correctamente']);
    }


}
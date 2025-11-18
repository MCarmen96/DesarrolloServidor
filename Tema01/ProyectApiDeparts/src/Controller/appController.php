<?php
namespace app\Controller;
use app\Model\Database;
use Dotenv\Dotenv;


class appController{
    
    private $database;

    public function __construct(){

        $dotenv=Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();
        $host=$_ENV['DB_HOST'];
        $name=$_ENV['DB_DATABASE'];
        $root=$_ENV['DB_USERNAME'];
        $pin=$_ENV['DB_PASSWORD'];
        error_log($name);
        $this->database=new Database($host,$name,$root,$pin);
    }

    public function viewIndex(){
        require __DIR__ ."/../Views/cliente.html";
    }
    public function getAll(){
        http_response_code(200);
        $departs=$this->database->getAll();
        echo json_encode($departs);
    }

    public function getId($id){
        http_response_code(200);
        $departs=$this->database->getId($id);
        echo json_encode($departs);
        echo json_encode(['mensaje'=> 'Mostrando departemnto con ID: $id']);
    }

    public function create($depart_no,$dnombre,$loc){
        $departs=$this->database->create($depart_no,$dnombre,$loc);
        echo json_encode($departs);
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento creado existosamente']);
    }

    public function update($depart_no,$dnombre,$loc){
        $departs=$this->database->update($depart_no,$dnombre,$loc);
        echo json_encode($departs);
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento con ID $id actualizado correctamente']);
    }

    public function delete($id){
        $departs=$this->database->delete($id);
        echo json_encode($departs);
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento con ID $id eliminado correctamente']);
    }


}
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
        $nameData=$_ENV['DB_DATABASE'];
        $root=$_ENV['DB_USERNAME'];
        $pin=$_ENV['DB_PASSWORD'];
        error_log($nameData);
        $this->database=new Database($host,$nameData,$root,$pin);
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
        //echo json_encode(['mensaje'=> `Mostrando departemnto con ID: $id`]);
    }

    public function create($userData){
        //Leer el cuerpo de la petición HTTP (que contiene el JSON)
        $json=file_get_contents("php://input");
        $datos=json_decode($json,true);

        $this->database->create($datos["depart_no"], $datos["dnombre"], $datos["loc"]);
        
        echo json_encode($datos);
        echo json_encode(['MENSAJE'=>'Deapartamento creado exitosamente','Created by'=>$userData['user_id']]);
        http_response_code(200);
        
    }

    public function update($id,$userData){
        //Leer el cuerpo de la petición HTTP (que contiene el JSON)
        $datos = json_decode(file_get_contents("php://input"), true);
        $this->database->update($id, $datos["dnombre"], $datos["loc"]);
        echo json_encode(['MENSAJE'=>'Deapartamento modificacion exitosa','Created by'=>$userData['user_id']]);
        echo json_encode($datos);
        http_response_code(200);
        
    }

    public function delete($id,$userData){
        $departs=$this->database->delete($id);
        echo json_encode($departs);
        http_response_code(200);
        echo json_encode(['mensaje'=> 'Departemento con ID $id eliminado correctamente','Created by'=>$userData['user_id']]);
    }


}
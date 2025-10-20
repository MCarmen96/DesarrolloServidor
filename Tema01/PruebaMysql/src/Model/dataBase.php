<?php
namespace carmen\pruebamysql\Model;
use PDO;
use PDOException;

class Database{

    private $host="127.0.0.1";
    private $dbname="depart";
    private $username="root";
    private $port="3306";
    private $password="";
    private $pdo;


    public function __construct()
    {
        try{
            $this->pdo=new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8",$this->username,$this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Error al conectar a la base de datps".$e->getMessage());
        }
    }

    public function consulta($instrSql,$params=[]){
        try{
            $sentencia=$this->pdo->prepare($instrSql);//pre
            $sentencia->execute($params);
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);//devuelve el array aosc
        }catch(PDOException $e){
            die("error".$e->getMessage());
        }
    }

    public function execute($sql,$params=[]){
        try{
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();// devuelve la cantidad de filas afectadas

        }catch(PDOException $e){
            die("Error en la ejecucion ".$e->getMessage());
        }
    }
    public function filterDepart($num){

        $sql="SELECT dnombre,loc FROM depart WHERE depart_no=:id";
        $para=[':id'=>$num];
        $depart=$this->consulta($sql,$para);
        return $depart;

    }
    public function lisDepart(){

        $sentencia="SELECT * FROM depart";
        $departamentos=$this->consulta($sentencia);

        return $departamentos;
    }

    public function delDepart($num){

        $sql="DELETE FROM depart WHERE depart_no=:id";
        $this->execute($sql,[':id'=>$num]);

    }

    public function addDepart($nombre,$numero,$localidad){

        $sentencia="INSERT INTO depart (depart_no,dnombre,loc) VALUES (:numero,:nombre,:localidad)";
        $this->execute($sentencia,[':nombre'=>$nombre,':numero'=>$numero,':localidad'=>$localidad]);

    }

}
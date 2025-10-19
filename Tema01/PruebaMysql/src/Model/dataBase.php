<?php
namespace carmen\pruebamysql\Model;
use PDO;
use PDOException;

class Database{

    private $host="127.0.0.1";
    private $dbname="mysql";
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

}
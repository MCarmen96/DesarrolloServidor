<?php
namespace app\Model;
use PDO;
use PDOException;


class Database{

    private $pdo;

    public function __construct($host,$name,$root,$pin)
    {
        try{
            
            $this->pdo=new PDO("mysql:host={$host};dbname={$name};charset=utf8",$root,$pin);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die("Error al conectar a la base de datos: ".$e->getMessage());
        }
    }

    public function query($instrSql,$params=[]){
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

    public function getAll(){
        $sql="SELECT * FROM depart";
        $sentencia=$this->query($sql);
        return $sentencia;
    }

    public function getId($id){
        $depart=$this->query("SELECT * FROM depart WHERE depart_no=:id",["id"=>$id]);
        return $depart;
    }

    public function create($depart_no, $dnombre, $loc){
        //return $this->execute("INSERT INTO depart(depart_no, dnombre, loc) VALUES(:depart_no, :dnombre, :loc)", 
                            //["depart_no" => $depart_no, "dnombre" => $dnombre, "loc" => $loc ]);

        $sql="INSERT INTO depart (depart_no, dnombre, loc) VALUES (:depart_no, :dnombre, :loc)";
        
        return $this->execute($sql,["depart_no"=>$depart_no,"dnombre"=>$dnombre,"loc"=>$loc
        ]);
    }

    public function update($depart_no,$dnombre,$loc){
        return $this->execute("UPDATE depart SET dnombre = :dnombre, loc=:loc WHERE depart_no=:depart_no" ,
        ["depart_no" => $depart_no, "dnombre" => $dnombre, "loc" => $loc]);
    }

    public function delete($id){
        return $this->execute("DELETE FROM depart WHERE depart_no=:id",["id"=>$id]);
    }
}
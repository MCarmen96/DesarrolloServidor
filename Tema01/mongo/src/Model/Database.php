<?php
namespace app\Model;

use Error;
use MongoDB\Client;

class Database{

    private $dataBase;

    public function __construct()
    {
        try{
            $client=new Client("mongodb://localhost:27017");
            $this->dataBase=$client->empledepart;
            error_log("conexion exitosa");
        }catch(\Exception $e){
            error_log("Error al conectar a  mongo".$e->getMessage());
        }
    }

    public function listDepart(){

        $colecction=$this->dataBase->depart;
        $allDeparts=$colecction->find();

        error_log(json_encode($allDeparts));
        $arrayDepart=$allDeparts->toArray();
        return $arrayDepart;
    }

    public function delete($id){

        $colecction=$this->dataBase->depart;
        $colecction->deleteOne(['depart_no'=>$id]);

    }

    public function edit($id){

        $colecction=$this->dataBase->depart;
        // find devuelve un cursor
        // pero findOne devulve directamente el documento unico
        $depart=$colecction->findOne(['depart_no'=>$id]);//depart es un objeto bsonDocument
        //$arrayDepart=json_encode(json_decode($depart),true);
        //error_log(json_encode($arrayDepart));
        return $depart;

    }

    public function update($name,$loc,$id){
        $colecction=$this->dataBase->depart;

        $colecction->updateOne(['depart_no'=>$id],['$set'=>['dnombre'=>$name,'loc'=>$loc]]);

    }

    public function create($name,$id,$loc){
        $collection=$this->dataBase->depart;
        $result=$collection->insertOne([
            'depart_no'=>$id,
            'dnombre'=>$name,
            'loc'=>$loc
        ]);
        echo "Documento insertado con ID: ". $result->getInsertedId();
    }
}
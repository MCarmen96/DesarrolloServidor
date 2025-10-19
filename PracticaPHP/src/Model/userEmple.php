<?php

namespace carmen\practicaphp\Model;

use ReturnTypeWillChange;

class userEmple{

    private  $filePathEmple;
    private  $filePathDepart;

    public function __construct(){

        $this->filePathEmple=__DIR__."/emple.json";
        $this->filePathDepart=__DIR__."/depart.txt";
    }

    public function getsEmple(){
        $archivo=json_decode(file_get_contents($this->filePathEmple),true ?? []);
        return $archivo;
        //array values??? mirar lo 
    }

    public function getsDepart(){

        $archivo=file($this->filePathDepart);
        return $archivo;

    }

    public function deleteEmple($data){

        $empleados=$this->getsEmple();
        $nombre=$empleados[$data]["nombre"];

        unset($empleados[$data]);

        $empleados=array_values($empleados);
        file_put_contents($this->filePathEmple,json_encode($empleados, JSON_PRETTY_PRINT));

        return $nombre;
    }

}
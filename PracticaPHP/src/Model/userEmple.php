<?php

namespace carmen\practicaphp\Model;

class userEmple{

    private  $filePathEmple;
    private  $filePathDepart;

    public function __construct(){

        $this->filePathEmple=__DIR__."/Model/emple.json";
        $this->filePathDepart=__DIR__."/Model/depart.txt";
    }

    public function getsEmple(){
        $archivo=json_code(file_get_contents($this->filePathEmple),true ?? []);
        return $archivo;
        //array values??? mirar lo 
    }

    public function getsDepart(){

        $archivo=file($this->filePathDepart);
        
        return $archivo;

    }

}
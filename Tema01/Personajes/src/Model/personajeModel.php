<?php

namespace app\Model;


class personajeModel{

    private $filePath;

    public function __construct()
    {
        $this->filePath= __DIR__ ."/../../Data/HeroesYVillanos.json";
    }

    public function listData(){
        $file=$this->filePath;
        $arrayDatos=json_decode($file);
        error_log(json_encode($arrayDatos));
        return $arrayDatos;

    }

    
}
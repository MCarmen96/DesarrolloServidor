<?php

namespace app\Model;


class personajeModel{

    private $filePath;

    public function __construct()
    {
        $this->filePath= __DIR__ ."/../../Data/HeroesYVillanos.json";
    }

    public function listData(){
        $contentJson=file_get_contents($this->filePath);
        $arrayDatos=json_decode($contentJson,true);
        error_log("esto es el null....".json_encode($arrayDatos));
        return $arrayDatos;

    }

    
}
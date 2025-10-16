<?php
namespace carmen\pruebaexamen\Models;

class UserModel{

    private $filePath;

    public function __construct()
    {
        $this->filePath= __DIR__ ."/../Archivos/listUser.txt";
    }
    public function getUser(){

        $namesArray=[];

        if(file_exists($this->filePath)){

            $routeFile=$this->filePath;
            $save=file($this->filePath,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

            if($save!==false){
                $namesArray=$save;
            }

            return $namesArray;
        }

    }

    public function writeUser($name){
        file_put_contents($this->filePath,$name."\n",FILE_APPEND);
    }
}
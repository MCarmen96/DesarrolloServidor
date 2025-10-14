<?php

namespace carmen\usuarios\Models;

class UserModel{

    private $filePath;

    public function __construct()
    {
        $this->filePath=__DIR__."/../Database/listUser.txt";
    }

    public function saveName(){

    }
    public function writeFile($name){

        file_put_contents($this->filePath,$name."\n",FILE_APPEND);
    }
    public function getNames(){

            $fileUsers =[];

            if (file_exists($this->filePath)) {

                $file=$this->filePath;

                $fileOpen=fopen($file,"r");

                while (($line = fgets($fileOpen)) !== false) {
                    array_push($fileUsers,trim($line));
                }

                fclose($fileOpen);

            } else {
                http_response_code(404);
                echo "ARCHIVO NO ENCONTRADO ".$this->filePath;
            }

            return $fileUsers;
    }

    public function deleteUserById(){
        $user=$this->getNames();
    }
}
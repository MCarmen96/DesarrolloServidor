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

        file_put_contents("listUser.txt",$name,FILE_APPEND);
    }
    public function getNames(){

            $fileUsers =[];

            if (file_exists($this->filePath)) {

                $file=$this->filePath;

                $fileOpen=fopen($file,"r");

                while (($line = fgets($fileOpen)) !== false) {
                    $fileUsers .=$line."\n";
                }

                fclose($fileOpen);

            } else {
                http_response_code(404);
                echo "NOT FOUND FILE 404";
            }

            return $fileUsers;
    }

    public function deleteName(){

    }
}
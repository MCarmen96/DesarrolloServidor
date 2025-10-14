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

    public function deleteUserById(int $id){
        $users=$this->getNames();

        
        
        if(isset($users[$id])){
            $nombreBorrado=$users[$id];
            unset($users[$id]);

            $contentSave=implode("\n",$users);

            if(!empty($contentSave)){
                $contentSave.="\n";
            }
            file_put_contents($this->filePath,$contentSave);

        }
        return $nombreBorrado;
    }

    public function getUser($id){
        $users=$this->getNames();
        $id=(int)$id;
        return $users[$id];
    }

    public function modifyFileUpdateName($id,$user){

        $entrada=trim(htmlspecialchars($user));

        $fileArray=$this->getNames();
        $id=(int)$id;

        if (isset($fileArray[$id])) {
            $fileArray[$id] = $entrada;
        }else{
            error_log("el id no esta");
        }
    

        $contentSave=implode("\n",$fileArray);

        if(!empty($contentSave)){
            $contentSave.="\n";
        }
        file_put_contents($this->filePath,$contentSave);
        
        
        return $entrada;

    }
}
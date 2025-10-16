<?php

namespace carmen\usuarios\Models;

class UserModel
{

    private $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . "/../Database/listUser.txt";
    }

    public function getNames()
    {

        $fileUsers = [];
        //comprobar si el archivo existe
        if (file_exists($this->filePath)) {

            $file = $this->filePath;

            $fileOpen = fopen($file, "r");
            //leer linea a linea
            //mientras no sea el final del archivo
            // propar file() y fgets() y file_get_contents()
            while (($line = fgets($fileOpen)) !== false) {
                array_push($fileUsers, trim($line));
            }

            fclose($fileOpen);
        } else {
            http_response_code(404);
            echo "ARCHIVO NO ENCONTRADO " . $this->filePath;
        }

        return $fileUsers;
    }
    public function writeFile($name)
    {   // file append para añadir al final del archivo y asi evitar sobreescribir
        file_put_contents($this->filePath, $name."\n" ,FILE_APPEND);
    }


    public function deleteUserById(int $id)
    {   //coger todos los usuarios
        $users = $this->getNames();

        if (isset($users[$id])) {
            $nombreBorrado = $users[$id];
            unset($users[$id]);
            //reindexar el array para que no queden huecos
            $contentSave = implode("\n", $users);

            if (!empty($contentSave)) {
                $contentSave .= "\n";
            }
            file_put_contents($this->filePath, $contentSave);
        }
        return $nombreBorrado;
    }

    public function getUser($id)
    {
        $users = $this->getNames();
        $id = (int)$id;
        return $users[$id];
    }

    public function modifyFileUpdateName($id, $user)
    {

        $entrada = trim(htmlspecialchars($user));

        $fileArray = $this->getNames();
        $id = (int)$id;

        if (isset($fileArray[$id])) {
            $fileArray[$id] = $entrada;
        } else {
            error_log("el id no esta");
        }


        $contentSave = implode("\n", $fileArray);

        if (!empty($contentSave)) {
            $contentSave .= "\n";
        }
        file_put_contents($this->filePath, $contentSave);


        return $entrada;
    }
}

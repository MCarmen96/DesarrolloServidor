<?php

$carpeta = "imagenes/";

$tiposValidos = ["jpg", "jpeg", "png", "gif"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["fileImagen"])) {

    $nombreTemp = $_FILES["fileImagen"]["tmp_name"];
    $nombreArchi = $_FILES["fileImagen"]["name"];
    $tipo = $_FILES["fileImagen"]["type"];
    $tamanio = $_FILES["fileImagen"]["size"];
    $error=$_FILES["fileImagen"]["error"];

    $carpetaSave = $carpeta . basename($nombreArchi);

    if (!file_exists($carpeta)) {
        mkdir("imagenes/");
    }

    
    $badSize=1024*1024*2;

    if ($tamanio>$badSize) {

        echo "--ERROR EL ARCHIVO ES MAYOR A 2 MEGABYTE--";

    }else{
        // guardo la extension del archivo
        $extensionArchiSubido=strtolower(pathinfo($nombreArchi,PATHINFO_EXTENSION));

        if(in_array($extensionArchiSubido,$tiposValidos)){

            echo $_FILES["fileImagen"]["type"]."--TIPO VALIDO--\n";
            
            if(move_uploaded_file($nombreTemp, $carpetaSave)){
                echo "SUBO Y GUARDO ARCHIVO";
            }else{

                echo "ERROR EN LA SUBIDA $error";
            }
        }else{
            
            echo $_FILES["fileImagen"]["type"]."error de tipos de archivos que no coinciden";
        }
    }

    
}else{
    echo "erro no he recibido nada!! ";
}

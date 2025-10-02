<?php

$carpeta = "imagenes";

$tiposValidos = ["jpg", "jpeg", "png", "gif"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["fileImagen"])) {

    $nombreTemp = $_FILES["fileImagen"]["tmp_name"];
    $nombreArchi = $_FILES["fileImagen"]["name"];
    $tipo = $_FILES["fileImagen"]["type"];
    $tamanio = $_FILES["fileImagen"]["size"];

    $carpetaSave = $carpeta . basename($nombreArchi);

    if (!file_exists($carpeta)) {
        mkdir("imagenes");
    }

    
    $badSize=1024*1024*6;

    if ($tamanio>$badSize) {

        echo "--ERROR EL ARCHIVO ES MAYOR A 2 MEGABYTE--";

    }else{

        

        if(in_array($tipo,$tiposValidos)){
            echo "--TIPO VALIDO--";
            echo "SUBO Y GUARDO ARCHIVO";
            move_uploaded_file($nombreTemp, $carpetaSave);
        }else{
            
            echo $_FILES["fileImagen"][""]."error de tipos";
        }
    }

    
}else{
    echo "error ";
}

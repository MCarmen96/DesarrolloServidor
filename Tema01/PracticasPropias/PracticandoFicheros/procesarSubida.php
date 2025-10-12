<?php
if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_FILES["fileImage"])){
   
    $nombreTemp=$_FILES["fileImage"]["tmp_name"];
    $nombreFile=$_FILES["fileImage"]["name"];
    $tipo=$_FILES["fileImage"]["type"];
    $size=$_FILES["fileImage"]["size"];
    $carpeta="uploads/";

    if(!file_exists($carpeta)){
        mkdir($carpeta);

    }

    $ruta=$carpeta.basename($nombreFile);
    if($size>1024*1024){
        echo "archivo demasiado grande";
    }else{

        $extension=strtolower(pathinfo($nombreFile,PATHINFO_EXTENSION));

        if($extension=="jpeg"||$extension=="png"){
            echo "TIPO VALIDO";
        }else{
            echo "error tipo de archivo no valido";
        }

        if(move_uploaded_file($nombreTemp,$ruta)){
            echo "archivo subido y guardado con exito ".$nombreFile;

        }else{
            echo "error en la subida";
        }
    }

}else{
    echo "NO SE HA SUBIDO NADA";
}
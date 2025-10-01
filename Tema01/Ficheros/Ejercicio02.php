<?php

if(is_readable("frutas.txt")){

    
    $file=fopen("frutas.txt","r");

    if($file){

        echo "--EL ARCHIVO ESTA ABIERTO Y SE LEE CON FREAD--\n";
        $conten=fread($file,filesize("frutas.txt"));
        echo $conten;

        //cierro el archivo
        fclose($file);
    }else{
        echo"--ERROR AL ABRIR EL ARCHIVO--\n";
    }

    $file=fopen("frutas.txt","r");
    if($file){
        echo "--EL ARCHIVO ESTA ABIERTO Y SE LEE CON GETS--\n";
        $linea=fgets($file);
        echo $linea . "\n";
    }


}else{
    echo "EL ARCHIVO NO ES LEGIBLE";
}
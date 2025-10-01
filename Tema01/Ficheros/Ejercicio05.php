<?php
$file=fopen("archivo_grande.txt","s");
if($file){
    echo "--ARCHIVO ABIERTO--";
    
    for ($i=0; $i < 1000; $i++) { 
        
        fwrite($file,"Hola\n");
    }

    $contenLeer=fread($file,1024);
    
}


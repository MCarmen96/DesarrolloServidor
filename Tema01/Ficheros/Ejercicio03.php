<?php
/*
    *Crea un archivo colores.txt vacio: 
    *Con fwrite añade tres colores diferentes, una linea por color, usando bloque con flock para evitar conflictos si hay varios procesos escribiendo
    *Muestra el contenido del fichero por pantalla
    *Con file_put_contents sobreescribe el archivo con un nuevo color
    *Muestra su contenido por pantalla
*/



if(is_writable(("colores.txt"))){

    echo "--EL ARCHIVO SE PUEDE ESCRIBIR--\n";
    $file=fopen("colores.txt","w");
    if($file){
        flock($file,LOCK_EX);
        fwrite($file,"rojo");
        fseek($file,0);
        fwrite($file,"AZUL");
        fseek($file,0);
        fwrite($file,"VERDE");

        $content=fread($file,filesize("colores.txt"));
        echo $content;
    }else{
        echo "EL ARCHIVO NO SE PUEDE ABRIR";
    }
    
}else{
    echo "EN EL ARCHIVO NO SE PUEDE ESCRIBIR";
}


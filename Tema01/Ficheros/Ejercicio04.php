<?php
/**
Ejercicio 4
Crear un archivo seguro.
Intenta crear un archivo nuevo usuario.txt con fopen en modo x.
Si el archivo ya existe. ábrelo en modo lectura y escritura (r+)
pero antes de abrirlo, verifica permisos con is_writable
Añade una nueva linea con un nombre de usuario
Finalmente, renombra o mueve el archivo a otra carpeta usando rename. */


if(!file_exists("usuarios.txt")){

    echo "CREANDO EL ARCHIVO....\n";

    $file=fopen("usuarios.txt","x");

    if(is_writable("usuarios.txt")){
        
        echo "SE PUEDE ESCRIBIR\n";
        fwrite($file,"-MARI CARMEN-");
    }



}else{
    $file=fopen("usuarios.txt","r+");
    if(is_writable("usuarios.txt")){
        
        echo "SE PUEDE ESCRIBIR\n";
        fwrite($file,"-MARI CARMEN-");

    }
}

echo "CAMBIADO EL NOMBRE";
rename("usuarios.txt","nuevoNombreUsuarios");
echo "NOMBRE CAMBIADO";



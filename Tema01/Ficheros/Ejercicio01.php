<?php
$carpeta="carpetaEjer04";
$archivo1="archivo1.txt";
$archivo2="archivo2.txt";


if (mkdir($carpeta)) {


    echo "carpeta creada \n";

} else {

    echo "ERROR NO SE HA CREADO EL DIRECTORIO YA ESTA CREADO \n";
}

$uno = fopen($carpeta . DIRECTORY_SEPARATOR . "archivo1.txt", "w+");
$dos = fopen("carpetaEjer04/archivo2.txt", "w+");

$carpetaConten = scandir("carpetaEjer04");

foreach ($carpetaConten as $archivos) {
    echo $archivos."\n";
}

//unlink("archivo1.txt");

//echo "ARCHIVO ELIMINADO\n";

//echo "el archivo no se ha encontrado\n";

fwrite($dos, "Hola estoy escribiendo en un archivo con php....");

//unlink("archivo2.txt");
//echo "elimnando archivo2\n";
//rmdir("carpetaEjer04");
//echo "carpeta eliminada";

<?php

$titulo="Hello php!! today is Friday";
$encabezado="Friday 10 October 2025";
$content="Entrenar y estudiar";


ob_start();

require __DIR__ ."/index.php";

$contenidoModificado=ob_get_clean();

$contenidoModificado=str_replace("Friday","VOLVER A VER KIMETSU NO YAIBA",$contenidoModificado);


$redirigir=true;

if($redirigir){
    header("Location: /redirecion");
}else{
    echo $contenidoModificado;
}

print_r($_SERVER);


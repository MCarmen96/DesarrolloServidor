<?php

$contador=0;

function incrementar(){
    global $contador;
    return ++$contador;
}

function incrementarDos(){

    return $GLOBALS["contador"]++;


}

function incrementarTres($cont){
    
    return ++$cont;
}


// 1 funcion
echo incrementar();

// 2 funcion
echo incrementarDos();

// 3 funcion
echo incrementarTres(5);








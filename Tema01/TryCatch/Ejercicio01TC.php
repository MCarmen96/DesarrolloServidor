<?php

function dividir($n1, $n2) {
    
    comprobacion($n2);

    return $n1 / $n2;
}

function comprobacion($n2){
    if ($n2 == 0) {

        throw new Exception("--EL DIVISOR NO PUEDE SER 0--");
    }
}

try{

    dividir(12,0);


}catch(Exception $e){
    
    echo "EXCEPTION CAPTURADA: " . $e->getMessage();

}finally{

    echo "EL CODIGO SE HA EJECUTADO";

}
?>
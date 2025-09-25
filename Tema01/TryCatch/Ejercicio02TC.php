<?php

    class EdadInvalidaException Extends Exception{};

    
    function verificarEdad($edad){

        if($edad<0||$edad<18){

            throw new EdadInvalidaException("LA EDAD NO PUEDE SER MENO DE 0 NI MENOR DE 18");

        }else{
            echo "EDAD VALIDA";
        }
    }

    
    try{

        verificarEdad(12);

    }catch(EdadInvalidaException $e){

        echo "excepcion personalizada: " .$e->getMessage();
        
    }
?>
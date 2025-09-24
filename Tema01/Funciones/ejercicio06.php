<?php
    function suma($n1,$n2){return $n1+$n2;};

    $resta=function()use($n1,$n2){return $n1-$n2;};

    $multi= fn($n1,$n2)=> $n1*$n2;

    function dividir($n1,$n2){return $n1/$n2;};

    
    do{
        echo "--CALCULADORA--\n";
        echo "1.SUMAR\n";
        echo "2.RESTAR\n";
        echo "3.MULTIPLICAR\n";
        echo "4.DIVISION\n";
        echo "0.EXIT\n";
        $opcion=fgets(STDIN);

        if($opcion>=1 && $opcion<=4){

            echo "Introduce un numero: ";
            $entrada1=fgets(STDIN);

            if(!is_numeric($entrada1)){
                echo "----HAS INTRODUCIDO UN VALOR ERRONEO----";
                break;
            }else{
                $entrada1=floatval($entrada1);
            }
            
            echo "Introduce otro numero: ";
            $entrada2=fgets(STDIN);

            if(!is_numeric($entrada2)){
                echo "----HAS INTRODUCIDO UN VALOR ERRONEO----";
                break;
            }else{
                $entrada2=floatval($entrada2);
            }

        }


        switch($opcion){

            case "1":

                echo "--SUMAR--\n";
                echo "La suma de los numeros introducidos es: ".suma($entrada1,$entrada2);
                break;

            case "2":

                echo "--RESTAR--\n";
                echo "La resta de los numeros introducidos es: ". $resta($entrada1,$entrada2);
                break;

            case "3":

                echo "--MULTIPLICAR--\n";
                echo "La multiplicacion de los numeros introducidos es: ". $multi($entrada1,$entrada2);
                break;
            
            case "4":
                echo "--DIVIDIR--\n";
                echo "La division de los numeros introducidos es: ". dividir($entrada1,$entrada2);
                break;

            case "0":
                echo "\n--SALIENDO DE CALCULADORA.............";
                break;
            default:
                echo "\n-- WARNING !! OPCION NO VALIDA ---";
                break;
            
        }


    }while(!$opcion===0);
?>
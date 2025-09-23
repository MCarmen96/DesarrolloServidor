<?php

$numero_secreto = rand(1, 100);
$adivinanza = 0;
$intentos=0;
echo "Adivina el número secreto entre 1 y 100.";

do {
    
    echo "Introduce un numero: ";
    $adivinanza = (int) trim(fgets(STDIN));

    $intentos++;

    if ($adivinanza < $numero_secreto) {

        echo "EL NUMERO ES MAYOR.";

    } elseif ($adivinanza > $numero_secreto) {
        
        echo "EL NUMERO ES MENOR.";
    }

} while ($adivinanza != $numero_secreto);

echo "¡Felicidades! Adivinaste el número $numero_secreto lo has adivinado en $intentos intentos!!";
?>
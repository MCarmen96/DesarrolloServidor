<?php
echo "Introduce una serie de números separados por espacios (por ejemplo: 10 20 30 40): ";

// Lee la línea de números desde la consola
$entrada = trim(fgets(STDIN));

// Convierte la cadena en un array de números
$numeros_str = explode(" ", $entrada);

// Convierte cada elemento del array a un número entero
$numeros = array_map('intval', $numeros_str);

// Suma todos los números del array
$suma = array_sum($numeros);

// Cuenta cuántos números hay en el array
$cantidad = count($numeros);

if ($cantidad > 0) {
    // Calcula el promedio
    $promedio = $suma / $cantidad;
    echo "El promedio de los números es: " . $promedio;
} else {
    echo "No se introdujeron números válidos.";
}
?>
<?php
$hora = date('H'); // Obtiene la hora actual (formato 24 horas)

if ($hora >= 5 && $hora < 12) {
    echo "¡Buenos días!";
} elseif ($hora >= 12 && $hora < 18) {
    echo "¡Buenas tardes!";
} else {
    echo "¡Buenas noches!";
}
?>
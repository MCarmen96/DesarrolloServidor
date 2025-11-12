<?php
ini_set('session.cookie_lifetime',10);
ini_set('session.gc_maxlifetime',10);

session_start();

if(isset($_SESSION['usuario'])){

    echo "<h1>SESION ESTA ACTIVA</h1>";
    echo "<p>Usuario: {$_SESSION['usuario']}</p>";
    echo "<p>Hora: {$_SESSION['hora']}</p>";

}else{
    echo "<h1>SESION NO  ACTIVADA</h1>";
}

echo "<p> <a href='inicio.php'>inicio</a> </p>";
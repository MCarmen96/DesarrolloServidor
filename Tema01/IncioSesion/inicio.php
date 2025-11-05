<?php

ini_set("session.cookie_secure", false);
ini_set("session.cookie_httponly", true);// nos permite visualizar el id en la consola si esta en false
ini_set("session.gc_maxlifetime", 10);//tiempo cookie en servidor
ini_set("session.cookie_lifetime", 10);//tiempo cookie cliente
ini_set("session.cookie_strictmode", true);

session_start();

// * guardar datos sesion
$_SESSION['usuario']='admin';
$_SESSION['hora']=date('H:i:s');

echo "<h1>Sesion iniciada</h1>";
echo "<p>Usuario: {$_SESSION['usuario']}</p>";
echo "<p>Hora: {$_SESSION['hora']}</p>";

echo "<p> <a href='ver.php'> pagina ver</a> </p>";
echo "<p> <a href='logout.php'> salir </a> </p>";

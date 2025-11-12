<?php
ini_set('session.cookie_lifetime',10);
ini_set('session.gc_maxlifetime',10);
session_start();
session_unset();
session_destroy();
echo "<h1>Session cerrada</h1>";

echo "<p> <a href='inicio.php'>inicio</a> </p>";
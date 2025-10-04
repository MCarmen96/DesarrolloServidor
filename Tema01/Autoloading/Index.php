<?php
require 'autoload.php';

$usuario=new \Clases\Usuario();
$usuario->saludar();

$producto=new \Clases\Producto();
$producto->mostrar();
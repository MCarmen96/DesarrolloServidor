<?php

namespace carmen\proyectoweb07\Controllers;

class HomeController
{

    public function index()
    {
        $filePath = __DIR__ . "/../Views/home.html";
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "NOT FOUND 404";
        }
    }

    public function formulario()
    {
        $filePath = __DIR__ . "/../Views/formulario.html";
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "NOT FOUND 404";
        }
    }

    public function procesar($data)
    {
        if (isset($data["nombre"]) && !empty($data["nombre"])) {
            $nombre = htmlspecialchars($data["nombre"]);
            echo "<h1> Hola {$nombre}! Bienvenido a primera pagina.</h1>";
        } else {
            "<h1>Por favor introduce un nombre valido</h1>";
        }
    }

    public function plantas(){
        $filePath=__DIR__."/../Views/plantas.html";
        if(file_exists($filePath)){
            echo file_get_contents($filePath);
        }else {
            http_response_code(404);
            echo "404 not Found";
        }
    }

    public function sobreNosotros()
    {

        $filePath = __DIR__ . "/../Views/sobreNosotros.html";
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "404 not Found";
        }
    }
}

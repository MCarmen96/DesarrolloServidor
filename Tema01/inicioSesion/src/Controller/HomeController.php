<?php

namespace carmen\iniciosesion\Controller;

class HomeController{

    public function mostrarForm(){

        $rutaFichero=__DIR__."/../Views/Formulario.html";
        if(file_exists($rutaFichero)){
            echo file_get_contents($rutaFichero);
        }else{
            http_response_code(404);
            echo "NOT FOUND 404 :(";
        }
    }

    public function procesar($datos){
        $patronNombre='/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s-]+$/';
        
        if(isset($datos["name"])&&!empty($datos["name"])&&preg_match($patronNombre,$datos["name"])){

        }

        if(isset($datos["name"])&&isset($datos["pin"])&&isset($datos["email"])){
            if(empty($datos["name"])){
                echo "<h2>EL nombre no puede estar vacio!!</h2>";
            }else if(empty($datos["pin"])){
                echo "<h2>EL pin no puede estar vacio!!</h2>";
            }else if(empty($datos["email"])){
                echo "<h2>El email no puede estar vacio</h2>";
            }else{

            }
        }
    }

    
}
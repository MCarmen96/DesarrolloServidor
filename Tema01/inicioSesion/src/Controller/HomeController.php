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
        $patronPin='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d\s]).{8,}$/';
        $nombreOk=false;
        $pinOk=false;
        $emailOk=false;
        $errores=[];
        
        if(isset($datos["name"])&&!empty($datos["name"])&&preg_match($patronNombre,$datos["name"])){
            $nombreOk=true;
            
        }else{
            $nombreError="<li>Nombre NO valido</li>";
            array_push($errores,$nombreError);
        }

        if(isset($datos["pin"])&&!empty($datos["pin"])&&preg_match($patronPin,$datos["pin"])){
            $pinOk=true;
    
        }else{
            $pinError="<li>Pin NO valido</li>";
            array_push($errores,$pinError);
        }

        if(isset($datos["email"])&&!empty($datos["email"])&&filter_var($datos["email"],FILTER_VALIDATE_EMAIL)){
            $emailOk=true;
        }else{
            $emailError="<li>Email NO valido!!</li>";
            array_push($errores,$emailError);
        }

        if($nombreOk&&$emailOk&&$pinOk){
            $filePath=__DIR__."/../Views/exitoInicio.html";
            if(file_exists($filePath)){
                echo file_get_contents($filePath);
            }else {
            http_response_code(404);
            echo "404 not Found plantas";
            }
        }else{
            foreach($errores as $error){
                echo "<ul>$error</ul> <br>";
            }
            
        }

    }

    
}
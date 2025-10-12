<?php

namespace carme\practicacomposer\Controller;

class appController{

    public function viewForm(){

        $route=__DIR__ . "/../Views/formulario.html";
        error_log("ruta formualrio ".$route);
        if(file_exists($route)){
            echo file_get_contents($route);
        }else{
            
            http_response_code(404);
            echo "NOT FOUND FORMULARIO 404";
        }

    }

    public function processData($data){

        $patronName='/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s-]+$/';
        $patronPhone = '/^(?:(?:\\+34|0034|34)?[\\s.-]*)?(?:[6789]\\d{2})[\\s.-]?(\\d{3})[\\s.-]?(\\d{3})$/';
        $errors=[];

        if(empty($data["nameUser"])||empty($data["LastNameUser"])){
            $errors[]="<li>El nombre y el apellido son obligatorio</li>";
        }else if(!preg_match($patronName,$data["nameUser"])||!preg_match($patronName,$data["LastNameUser"])){
            $errors[]="<li>El nombre y el apellido solo puede contener letras, espacios y guiones.</li>";
        }


        if(empty($data["phoneNumber"])){
            $errors[]="<li>El telefono es obligatorio</li>";
        }elseif(!preg_match($patronPhone,$data["phoneNumber"])){

            $errors[]="<li>El telefono no cumple el patron</li>";
        }

        if(empty($data["email"])){
            $errors[]="<li>El emial es obligatorio</li>";
        }elseif(!filter_var($data["email"],FILTER_VALIDATE_EMAIL)){
            $errors[]="<li>El email es incorrecto</li>";
        }

        if(isset($_FILES["letter"]) && $_FILES["letter"]["error"]===UPLOAD_ERR_OK){
            
        }

        if(!empty($errors)){
            print_r($errors);
        }

    }
}
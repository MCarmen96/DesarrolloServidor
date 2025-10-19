<?php

namespace carmen\practicaphp\Router;


class Router{

     private $routes=[];

     public function __construct()
     {
        $this->loadRoutes();
     }


     public function loadRoutes(){

        $this->routes["/"]=["controller"=>"appController","action"=>"viewMenu"];
        $this->routes["/listadoEmple"]=["controller"=>"appController","action"=>"viewEmple"];
        $this->routes["/listadoDepartamentos"]=["controller"=>"appController","action"=>"viewDepart"];

     }


     public function gestorPeticion(){

        $url=parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
        error_log("url de la riaz ".$url);
        
        if(isset($this->routes[$url])){

            $path=$this->routes[$url];
            
            $controller="carmen\\practicaphp\\Controller\\". $path["controller"];
            
            error_log("controlador : ".$controller);
            $action=$path["action"];

            error_log($action);

            if(class_exists($controller)&&method_exists($controller,$action)){

                $classController=new $controller();
                $classController->$action($_REQUEST);
            }else{

                http_response_code(404);
                echo "clase o metodo no encontrado";
            }
            
        }else{

            http_response_code(404);
            echo "ruta no encontrada";
        }


     }
}

$router=new Router();

$router->gestorPeticion();

<?php

namespace carmen\pruebaexamen\Router;

class Router{

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes["/"]=["controller"=>"appController","action"=>"viewIndex"];
        $this->routes["/newUser"]=["controller"=>"appController","action"=>"addUser"];
    }

    public function gestorPeticion(){
        error_log("entrando en gestor peticion");
        $path=parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);

        if(isset($this->routes[$path])){
            error_log($path);
            $savePath=$this->routes[$path];

            $controllerClass="carmen\\pruebaexamen\\Controller\\". $savePath["controller"];
            $action=$savePath["action"];
            error_log("clase ".$controllerClass);
            error_log("metodo ".$action);

            if(class_exists($controllerClass)&& method_exists($controllerClass,$action)){
                error_log($controllerClass);
                $clase=new $controllerClass();
                $clase->$action($_REQUEST);
            }else{
                http_response_code(404);
                echo "clase y metodo no encotrado";
            }
        }else{
            http_response_code(404);
            echo "ruta no encontrada en el array".$path;
        }

    }
}

$routes=new Router();
$routes->gestorPeticion();


<?php

namespace carme\practicacomposer\Router;

class Router{

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes["/"]= ["controller"=>"appController", "action"=>"viewForm"];
        $this->routes["/dataProcess"]=["controller"=>"appController","action"=>"processData"];
    }


    public function requestManager(){

        $path=$_SERVER["REQUEST_URI"];
        ERROR_LOG("path:" . $path);

        if(isset($this->routes[$path])){

            $route=$this->routes[$path];

            $controllerClass="\\carme\\practicacomposer\\Controller\\".$route["controller"];

            $actionController=$route["action"];

            error_log("ruta: ".$controllerClass. "---action: ".$actionController);

            if(class_exists($controllerClass)&& method_exists($controllerClass,$actionController)){

                $appController=new $controllerClass();

                if($_SERVER["REQUEST_METHOD"]==="POST"){
                    $appController->$actionController($_POST);
                }else{
                    $appController->$actionController();
                }

            }else{
                http_response_code(404);
                echo "clase y metodo no encontrado";
            }

        }else{
            http_response_code(404);
                echo "ruta no encontrada";
        }

    }

}

$peticionRouter=new Router();

$peticionRouter->requestManager();

<?php

namespace app\Router;

class Router{

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes["/"]=["controller"=>"appController","action"=>"index"];
        $this->routes["/productos"]=["controller"=>"appController","action"=>"productos"];
        $this->routes["/about"]=["controller"=>"appController","action"=>"about"];
        
    }

    public function requestUsers(){

        $method=$_SERVER["REQUEST_METHOD"];
        $pathCompleto=$_SERVER["REQUEST_URI"];
        $parteUri=parse_url($pathCompleto);
        $path=$parteUri['path'] ?? "/";

        error_log($path);

        if(isset($this->routes[$path])){

            $saveRoute=$this->routes[$path];
            $saveRouteController="app\\Controller\\".$saveRoute["controller"];
            $action=$saveRoute["action"];
            error_log("ruta:".$saveRouteController);
            error_log("metodo: ".$action);
            
            if(class_exists($saveRouteController) && method_exists($saveRouteController,$action)){

                error_log("ruta:".$saveRouteController);
                error_log("metodo: ".$action);
                error_log("Creando controlador...");

                $controller=new $saveRouteController();

                if($method==="GET"){
                    $controller->$action($_GET);
                    error_log("entro el metodo GET...");
                    
                }else if($method==="POST"){
                    $controller->$action($_POST);
                }else{
                    $controller->$action();
            
                }
            }else{
                http_response_code(404);
                echo "NOT FOUND 404 RUTA NO ENCONTRADA";
            }

        }

    }
}
$route=new Router();
$route->requestUsers();

<?php

namespace app\Router;

class Router{

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes["/"]=["controller"=>"appController","action"=>"viewIndex"];
        $this->routes["/delete"]=["controller"=>"appController","action"=>"deleteDepart"];
        $this->routes["/edit"]=["controller"=>"appController","action"=>"findDepart"];
        
    }

    public function requestUsers(){

        $method=$_SERVER["REQUEST_METHOD"];//GUARDO EL METODO HTTP
        $pathCompleto=$_SERVER["REQUEST_URI"];//GUARDO LA URI COMPLETA QUE SE UTILIZA PRA ACCEDER A LA PAGINA
        $parteUri=parse_url($pathCompleto);// GUARDO Y DIVIDO LA URL Y LA DESCOMPONE EN UN ARRAY ASOCIATIVO
        $path=$parteUri['path'] ?? "/";// ACEDEMOS A LA PARTE LIMPIA DE LA URL LA RUTA LIMPIA

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

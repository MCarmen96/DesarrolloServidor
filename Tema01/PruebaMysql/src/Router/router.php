<?php

namespace carmen\pruebamysql\Router;

class Router{

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes["/"]=["controller"=>"appController","action"=>"viewIndex"];
        $this->routes["/listDepart"]=["controller"=>"appController","action"=>"listarDepartamentos"];
        $this->routes["/delDepart"]=["controller"=>"appController","action"=>"delDepart"];
        $this->routes["/form"]=["controller"=>"appController","action"=>"formDepart"];
        $this->routes["/addDepartForm"]=["controller"=>"appController","action"=>"addDepart"];
        $this->routes["/formUpdate"]=["controller"=>"appController","action"=>"formUpdate"];
        $this->routes["/updateDepart"]=["controller"=>"appController","action"=>"updateDepart"];
    }

    public function requestUsers(){

        $method=$_SERVER["REQUEST_METHOD"];
        $pathCompleto=$_SERVER["REQUEST_URI"];
        $parteUri=parse_url($pathCompleto);
        $path=$parteUri['path'] ?? "/";

        error_log($path);

        if(isset($this->routes[$path])){

            $saveRoute=$this->routes[$path];
            $saveRouteController="carmen\\pruebamysql\\Controller\\".$saveRoute["controller"];
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

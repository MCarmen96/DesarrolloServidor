<?php

namespace carmen\usuarios\Router;

class Router{

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){
        $this->routes["/"]=["controller"=>"HomeController","action"=>"viewForm"];
        $this->routes["/addUser"]=["controller"=>"HomeController","action"=>"addNewUser"];
        $this->routes["/deleteUser"]=["controller"=>"HomeController","action"=>"deleteUser"];
    }

    public function requestUsers(){
        $method=$_SERVER["REQUEST_METHOD"];
        $path=$_SERVER["REQUEST_URI"];
        error_log($path);
        if(isset($this->routes[$path])){

            $saveRoute=$this->routes[$path];
            $saveRouteController="carmen\\usuarios\\Controller\\".$saveRoute["controller"];
            $action=$saveRoute["action"];
            error_log("ruta:".$saveRouteController);
            error_log("metodo: ".$action);
            
            if(class_exists($saveRouteController) && method_exists($saveRouteController,$action)){

                $controller=new $saveRouteController();

                if($method==="POST"){
                    $controller->$action($_POST);
                }else if($method==="GET"){
                    //$controller->$action($_GET['id']);
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

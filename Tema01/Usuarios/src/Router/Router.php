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
        //$this->routes["/addUser"]=["controller"=>"HomeController","action"=>"addNewUser"];
    }

    public function requestUsers(){

        $path=$_SERVER["REQUEST_URI"];
        if(isset($this->routes[$path])){
            $saveRoute=$this->routes[$path];
            $saveRouteController="carmen\\Usuarios\\Controller\\".$saveRoute["controller"];
            $action=$saveRoute["action"];

            if(class_exists($saveRouteController)&&method_exists($saveRouteController,$action)){
                $controller=new $saveRouteController();
                if($_SERVER["REQUEST_METHOD"]=="POST"){
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

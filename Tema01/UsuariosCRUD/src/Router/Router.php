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
        $this->routes["/addUser"]=["controller"=>"HomeController","action"=>"addNewUsers"];
        $this->routes["/deleteUser"]=["controller"=>"HomeController","action"=>"deleteUser"];
        $this->routes["/modifyUser"]=["controller"=>"HomeController","action"=>"modifyUser"];
        $this->routes["/viewUpdateUser"]=["controller"=>"HomeController","action"=>"updateUser"];
    }

    public function requestUsers(){
        $path=parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
        error_log($path);
        if(isset($this->routes[$path])){

            $saveRoute=$this->routes[$path];
            $controllerClass="carmen\\usuarios\\Controller\\".$saveRoute["controller"];
            $action=$saveRoute["action"];
            error_log("ruta:".$controllerClass);
            error_log("metodo: ".$action);
            
            if(class_exists($controllerClass) && method_exists($controllerClass,$action)){

                $controller=new $controllerClass();
                $controller->$action($_REQUEST);
            }else{
                http_response_code(404);
                echo "NOT FOUND 404 RUTA NO ENCONTRADA";
            }

        }

    }
}
$route=new Router();
$route->requestUsers();

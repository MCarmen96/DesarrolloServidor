<?php

namespace carmen\proyectoweb02\Routers;



class Router
{
    private $routes = [];
    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $this->routes["/"] = ["controller" => "HomeController", "action" => "index"];
        $this->routes["/sobreNosotros"] = ["controller" => "HomeController", "action" => "sobreNosotros"];
        $this->routes["/formulario"]=["controller" => "HomeController", "action" => "mostrarForm"];
    }

    public function gestorPeticion()
    {
        $path = $_SERVER["REQUEST_URI"];
        ERROR_LOG("path:" . $path);

        if (isset($this->routes[$path])) {
            $route = $this->routes[$path];
            $controllerClass = "\\carmen\\proyectoweb02\\Controllers\\" . $route["controller"];
            $action = $route["action"];

            error_log("ruta: ".$controllerClass. "       action: ".$action);

            if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                $controller = new $controllerClass();
                $controller->$action();
            } else {
                http_response_code(404);
                echo "NOT FOUND 40 dshfsd";
            }

        } else {
            http_response_code(404);
            echo "NOT FOUND 404 ghjg";
        }
    }
}
$router=new Router();
$router->gestorPeticion();

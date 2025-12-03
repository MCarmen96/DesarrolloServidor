<?php

namespace app\Router;

use app\Middleware\AuthMiddleware;

class Router
{

    private $routes = [];

    public function __construct(){
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes['GET']["/index"] = ["controller" => "appController", "action" => "viewIndex"];
        $this->routes['GET']["/api/depart"] = ["controller" => "appController", "action" => "getAll"];
        $this->routes['GET']["/api/depart/{id}"] = ["controller" => "appController", "action" => "getId"];

        $this->routes['POST']["/api/depart/create"] = ["controller" => "appController", "action" => "create", "auth" => true];
        $this->routes['PUT']["/api/depart/{id}"] = ["controller" => "appController", "action" => "update", "auth" => true];
        $this->routes['DELETE']["/api/depart/{id}"] = ["controller" => "appController", "action" => "delete", "auth" => true];


        /*
            $this->routes['GET']=['/departs'=>["controller"=>"appController","action"=>"getAll"],
                                '/api/departs/{id}'=>["controller"=>"appController","action"=>"getId"]]
        */
    }

    public function requestUsers()
    {

        $method = $_SERVER["REQUEST_METHOD"]; //GUARDO EL METODO HTTP
        $parseUrl = parse_url($_SERVER["REQUEST_URI"]);

        $path = rtrim($parseUrl['path'], '/'); // quitamos la barra final para dar uniformidad
        error_log("path:  " . $path);
        $originalPath = $path;

        $parts = explode('/', trim($path, '/'));

        $paramValue = null;

        if (is_numeric(end($parts))) {
            $paramValue = array_pop($parts);
            $path = '/' . implode('/', $parts) . '/{id}';
        }

        error_log($path);

        if (isset($this->routes[$method][$path])) {

            $saveRoute = $this->routes[$method][$path];
            $saveRouteController = "\\app\\Controller\\" . $saveRoute["controller"];
            $action = $saveRoute["action"];
            error_log("ruta:" . $saveRouteController);
            error_log("metodo: " . $action);

            if (isset($saveRoute['auth']) && $saveRoute['auth'] === true) {
                $authMiddleware = new AuthMiddleware();
                $headers = getallheaders();
                $userData = $authMiddleware->handle($headers);
            }

            if (class_exists($saveRouteController) && method_exists($saveRouteController, $action)) {

                error_log("Entra en el if de class exists??");
                $controller = new $saveRouteController();

                if (isset($userData)) {
                    if ($paramValue !== null) {
                        $controller->$action($paramValue,$userData);
                    } else {
                        $controller->$action($userData);
                    }
                }else{
                    if ($paramValue !== null) {
                        $controller->$action($paramValue);
                    } else {
                        $controller->$action();
                    }
                }


                error_log("ruta:" . $saveRouteController);
                error_log("metodo: " . $action);
                error_log("Creando controlador...");
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Recurso no encontrado']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado']);
        }
    }
}
$route = new Router();
$route->requestUsers();

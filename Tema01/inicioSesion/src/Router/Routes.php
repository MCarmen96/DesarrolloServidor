<?php

namespace carmen\iniciosesion\Router;

class gestorRutas
{
    private $rutas = [];

    public function __construct()
    {
        $this->cargarRutas();
    }

    public function cargarRutas()
    {

        $this->rutas["/"] = ["controller" => "HomeController", "action" => "mostrarForm"];
        $this->rutas["/procesar"]=["controller"=>"HomeController","action"=>"procesar"];
    }

    public function gestorPeticion()
    {
        $path = $_SERVER["REQUEST_URI"];
        ERROR_LOG("path:" . $path);

        if (isset($this->rutas[$path])) {
            $ruta = $this->rutas[$path];
            $controllerClass = "\\carmen\\iniciosesion\\Controller\\" . $ruta["controller"];
            $action = $ruta["action"];

            error_log("ruta: " . $controllerClass . "       action: " . $action);

            if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                $controller = new $controllerClass();
                if($_SERVER["REQUEST_METHOD"]==="POST"){
                    $controller->$action($_POST);
                }else{
                    $controller->$action();
                }
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


$ruta = new gestorRutas();
$ruta->gestorPeticion();

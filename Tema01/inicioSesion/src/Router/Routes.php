<?php

namespace carmen\iniciosesion\Router;

class gestorRutas
{   //VARAIBLE PARA GAURDAR RUTAS QUE PUEDO USAR
    private $rutas = [];

    public function __construct()//CONSTRUCTOR LLAMA A CARGAR RUTAS PARA QUE SE INCIEN NADA MAS INSTANCIAR LA CLASE
    {
        $this->cargarRutas();
    }

    public function cargarRutas()
    {   //guardo las rutas en el array de mi clase con sus respectivos metodos o acciones
        $this->rutas["/"] = ["controller" => "HomeController", "action" => "mostrarForm"];
        $this->rutas["/procesar"]=["controller"=>"HomeController","action"=>"procesar"];
    }

    public function gestorPeticion()
    {
        $path = $_SERVER["REQUEST_URI"];//cojo de la url lo que hay a partir de la ? para haberiguar que suta tengo que gestionar

        ERROR_LOG("path:" . $path);

        if (isset($this->rutas[$path])) {//si la ruta esta en el array

            $ruta = $this->rutas[$path];// la guardo

            //monto la ruta del path al controller ya que esa clase es quien tiene las acciones a realizar
            $controllerClass = "\\carmen\\iniciosesion\\Controller\\" . $ruta["controller"];

            //guardo la accion que es el metodo de la clase
            $action = $ruta["action"];

            error_log("ruta: " . $controllerClass . "action: " . $action);
            
            //si la clase existe y el metodo de la clase
            if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {

                //instancio la clase para poder llamar a su metodo
                $controller = new $controllerClass();

                if($_SERVER["REQUEST_METHOD"]==="POST"){//si hay un metodo post llamo al metodo y le paso la variable
                    $controller->$action($_POST);
                }else{
                    //si no hay un post hace el metodo que corresponda
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

// importante instanciar la clase y llamar al metodo para que se pueda inicializar
$ruta = new gestorRutas();
$ruta->gestorPeticion();

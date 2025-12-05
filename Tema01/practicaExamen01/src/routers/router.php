<?php

namespace app\router;

use Illuminate\Support\Facades\Route;

class Router{
    
    private $routes;

    public function __construct(){
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes['/']=['controller'=>'appController','action'=>'index'];
        $this->routes['/formLogin']=['controller'=>'appController','action'=>'formLogin'];
        $this->routes['/formRegister']=['controller'=>'appController','action'=>'formRegister'];
        $this->routes['/registerUser']=['controller'=>'appController','action'=>'registerUser'];
        $this->routes['/addUser']=['controller'=>'appController','action'=>'addUser'];
        $this->routes['/loginUser']=['controller'=>'appController','action'=>'loginUser'];
        $this->routes['/logOut']=['controller'=>'appController','action'=>'logOut'];
        $this->routes['/shop']=['controller'=>'appController','action'=>'formShop'];
        $this->routes['/saveShop']=['controller'=>'appcontroller','action'=>'saveShop'];
        
    }


    public function handleRequest(){

        // 1.guardar el metodo
        $method=$_SERVER["REQUEST_METHOD"];
        // 2.GUARDAR LA URL COMPLETA QUE SE PIDDE
        $pathCompleto=$_SERVER["REQUEST_URI"];
        // 3.Dividimos la ruta
        $parteUri=parse_url($pathCompleto);
        // 4. SI EXITE EL PATH LO USA SI NO POR DEFECTO USA LA RAIZ
        $path=$parteUri['path']??'/';
        // 5. compruebo que la ruta existe
        if(isset($this->routes[$path])){
            // 6.si existe la ruta la guardo
            $savePath=$this->routes[$path];
            // 7.Guardar el controlador y la accion asociada
            $controller="app\\Controller\\".$savePath['controller'];
            $action=$savePath['action'];
            error_log($controller);
            error_log($action);
            // 8. comprobar si existe la clase del controlador y que el metodo existe dentro de esa clase
            if(class_exists($controller)&& method_exists($controller,$action)){
                // 9. INTANCIAR EL CONTROLADOR
                $classController=new $controller();
                // 10. llamar al metodo del controlador segun el http method
                if($method==="GET"){
                    $classController->$action($_GET);
                }elseif($method==="POST"){
                    $classController->$action($_POST);
                }else{
                    $classController->$action();
                }
            }else{
                http_response_code(404);
                echo "CLASE O METODO NO ENCONTRADOS";
            }
        }else{
            http_response_code(404);
            echo "NOT FOUND 404";
        }

    }
}
$route=new Router();
$route->handleRequest();
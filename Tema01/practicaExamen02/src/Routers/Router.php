<?php

class Router{

    private $routes;

    public function __construct()
    {
        $this->loadRoutes();
    }


    public function loadRoutes(){
        $this->routes['/']=['controller'=>'appController','action'=>'index'];
        $this->routes['/formLogin']=['controller'=>'appController','action'=>'formLogin'];
        $this->routes['/login']=['controller'=>'appController','action'=>'login'];
        $this->routes['/formRegister']=['controller'=>'appController','action'=>'formRegister'];
        $this->routes['/register']=['controller'=>'appController','action'=>'register'];

    }


    public function handleRequest(){

        $method=$_SERVER['REQUEST_METHOD'];
        $pathCompleto=$_SERVER['REQUEST_URI'];
        $parteUri=parse_url($pathCompleto);
        $path=$parteUri['path']??'/';

        if(isset($this->routes[$path])){
            $savePath=$this->routes[$path];
            $controller="app\\Controller\\".$savePath['controller'];
            $action=$savePath['action'];
            if(class_exists($controller)&&method_exists($controller,$action)){
                $classController=new $controller();

                if($method==='GET'){
                    $classController->$action($_GET);
                }elseif($method==='POST'){
                    $classController->$action($_POST);
                }else{
                    $classController->$action();
                }
            }else{
                http_response_code(404);
                echo 'ERROR CLASE O CONTROLADOR NO ENCONTRADOS';
            }
        }else{
            http_response_code(404);
                echo 'ERROR RUTA NO ENOCNTRADA';
        }

    }

}

$route=new Router();
$route->handleRequest();
<?php

namespace app\Router;

class Router {

    private $routes=[];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes(){

        $this->routes["/"]=["controller"=>"appController","action"=>"viewIndex"];

    }
    public function request(){

        

    }
}
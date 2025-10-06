<?php
    namespace carmen\proyectoweb07\Routers;
    use carmen\proyectoweb07\Controllers\HomeController;

    $requestUri=$_SERVER["REQUEST_URI"];
    $method=$_SERVER["REQUEST_METHOD"];

    $controllerHome=new HomeController();

    switch($requestUri){
        case "/":
            echo $controllerHome->index();
            break;
        case "/formulario":
            echo $controllerHome->formulario();
            break;
        case "/sobreNosotros":
            echo $controllerHome->sobreNosotros();
            break;
        default:
            http_response_code(404);
            echo "ERROR NO ENCONTRADO 404";
    }
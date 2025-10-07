<?php

    require "vendor/autoload.php";

    use carmen\Composer\Models\Usuario;
    use carmen\Composer\Controllers\UsuarioController;


    $controller=new UsuarioController();
    $controller->index();

    $usuario=new Usuario();
    $usuario->saludar();
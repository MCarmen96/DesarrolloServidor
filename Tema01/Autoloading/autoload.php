<?php
spl_autoload_register(function($className){
        echo $className."\n";
        
        $rutaBuena=str_replace("\\",DIRECTORY_SEPARATOR,$className);

        $filePath = __DIR__ . "/". $rutaBuena . ".php";

        echo $filePath;
        if(file_exists($filePath)){
            require $filePath;
        }
    });

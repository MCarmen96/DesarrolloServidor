<?php

namespace carmen\usuarios\Controller;

class HomeController
{

    public function viewForm()
    {
        $filePath = __DIR__ . "/../Views/Users.php";
        if (file_exists($filePath)) {
            $fileUsers = "";
            
            $file = __DIR__."/../Database/listUser.txt";

            if (file_exists($file)) {

                $fileOpen=fopen($file,"r");

                while (($line = fgets($fileOpen)) !== false) {

                    $fileUsers .="<li>$line</li>";
                
                }

                fclose($fileOpen);

                ob_start();

                require $filePath;
                echo ob_get_clean();


            } else {
                http_response_code(404);
                echo "NOT FOUND FILE 404";
            }

        } else {
            http_response_code(404);
            echo "NOT FOUND 404";
        }
    }

}

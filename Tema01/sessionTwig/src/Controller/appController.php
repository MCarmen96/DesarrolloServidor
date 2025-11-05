<?php

    namespace app\Controller;
    use Twig\Loader\FilesystemLoader;

    use Twig\Environment;

    class appController{

        private $twig;

        public function __construct()
        {
            $loader=new FilesystemLoader(__DIR__."/../View");
            $this->twig=new Environment($loader);
        }

        public function index(){
            echo $this->twig->render("home.html.twig");
        }

        public function loginForm(){
            echo $this->twig->render("form.html.twig");
        }

       


        public function login($data){

            // limpio lo introducido por el usuario
            $nameLimpio=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
            $pinLimpio=filter_input(INPUT_POST,'pin',FILTER_SANITIZE_SPECIAL_CHARS);

            $hashedPin=password_hash('admin',PASSWORD_BCRYPT);
            // * VALIDO LA CONTRASEÑA CON LA QUE YO QUIERO
            //password_verify($hashedPin,$pinLimpio);
            error_log("antes del  if.....");
            // VERIFICAR QUE LLEGUEN BIEN LOS DATOS POR LA CONSOLA
            if(password_verify($hashedPin,$pinLimpio)&&$nameLimpio=='admin'){
                error_log("entro en el if.....");
                session_start();

                echo $this->twig->render("activo.html.twig",['activo'=>true]);

            }else{
                echo $this->twig->render("fallo.html.twig",['activo'=>false]);

            }



        }



    }

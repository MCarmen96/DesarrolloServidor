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

        public function productos(){


            echo $this->twig->render("productos.html.twig",[
                'title'=>"Mi sitio web con twig",
                'productos'=>[
                    ["nombre"=>"chocolate","precio"=>100],
                    ["nombre"=>"aceitunas","precio"=>200]
                ]
                ]);
        }

        public function index(){
            echo $this->twig->render("home.html.twig");
        }

        public function about(){

            echo $this->twig->render("about.html.twig");
        }


    }

<?php

    namespace app\Controller;

    use app\Model\personajeModel;

    use Twig\Loader\FilesystemLoader;

    use Twig\Environment;

    class appController{

        private $twig;
        private $myModel;

        public function __construct(){

            
            $loader=new FilesystemLoader(__DIR__."/../View");
            $this->twig=new Environment($loader);
            $this->myModel= new personajeModel();
        }

        

        public function index(){
            $datos=$this->myModel->listData();
            echo $this->twig->render("personajes.html.twig",['personajes'=>$datos]);
        }



    }

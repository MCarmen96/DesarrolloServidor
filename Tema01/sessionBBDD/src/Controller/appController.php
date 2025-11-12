<?php

namespace app\Controller;
use app\Model\Database;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class appController{

    private $twig;
    private $modelUser;

    public function __construct()
    {
        $this->modelUser=new Database();
        $loader=new FilesystemLoader(__DIR__ . "/../View");
        $this->twig=new Environment($loader);

        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }

        $this->twig->addGlobal('state_active', isset($_SESSION['name']));
        $this->twig->addGlobal('name', $_SESSION['name'] ?? null);
    }

    public function index(){
        echo $this->twig->render("home.html.twig");
    }

    public function form(){
        echo $this->twig->render("registro.html.twig");
    }

    public function saveUser(){
        error_log("entra en el function de save user");
        $nameLimpio=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
        $pinLimpio=filter_input(INPUT_POST,'pin',FILTER_SANITIZE_SPECIAL_CHARS);

        $hashedPin=password_hash($pinLimpio,PASSWORD_BCRYPT);

        $validSave=$this->modelUser->saveUSer($nameLimpio,$hashedPin);
        
        if($validSave){
            
            $_SESSION['name'] = $nameLimpio;
            $this->twig->addGlobal('state_active', true);
            $this->twig->addGlobal('name', $nameLimpio);
            echo $this->twig->render('bienvenido.html.twig', [
                'name' => $nameLimpio
            ]);
        }else{
            echo $this->twig->render('fallo.html.twig');
        }

    }

    public function login(){

        $nameLimpio=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
        $pinLimpio=filter_input(INPUT_POST,'pin',FILTER_SANITIZE_SPECIAL_CHARS);

        $hashedPin=password_hash($pinLimpio,PASSWORD_BCRYPT);

        $validPassword=password_verify($pinLimpio,$hashedPin);
        $this->modelUser->searchUser($nameLimpio);
        
        // UNA VEZ QUE HAGA EL LOGIN Y FILTRE POR EL NOMBRE DEL USUARIO
        // funcion buscar usuario devuelve nombre y el pin compara su has guardao en la base de datos
        // DEVUELVO LOS DATOS DEL CAMPO COMPRA Y LO MUESTRO EN EL INPUT TEXT

        // hay que establecer en el inicio de sesion de la cookiee y el name del usaurio en el session 
    }

    public function exit(){
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }

    public function shop(){

        echo $this->twig->render('shop.html.twig');
    }

    public function saveShop(){

        $name=$_SESSION['name'];
        $dataShop=filter_input(INPUT_POST,'dataShop',FILTER_SANITIZE_SPECIAL_CHARS);
        $this->modelUser->saveShop($dataShop,$name);

        header("Location: /");
        exit;

    }


}